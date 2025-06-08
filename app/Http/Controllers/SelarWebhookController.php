<?php

namespace App\Http\Controllers;

use App\Models\MarketItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class SelarWebhookController extends Controller
{
    public function handle(Request $request): JsonResponse
    {
        // Get webhook secret from config
        $webhookSecret = config('services.selar.webhook_secret');

        // Verify signature
        $signature = $request->header('X-Selar-Signature');
        $payload = $request->getContent();
        $computedSignature = hash_hmac('sha512', $payload, $webhookSecret);

        if (!hash_equals($computedSignature, $signature)) {
            Log::warning('Invalid Selar webhook signature', [
                'received_signature' => $signature,
                'computed_signature' => $computedSignature,
            ]);
            return response()->json(['error' => 'Invalid signature'], 400);
        }

        // Process webhook event
        $event = $request->header('X-Selar-Event');
        $data = $request->json()->all();

        if ($event === 'order.completed') {
            $this->processOrderCompleted($data);
        }

        return response()->json(['status' => 'success'], 200);
    }

    protected function processOrderCompleted(array $data): void
    {
        try {
            // Extract order details
            $email = $data['customer']['email'] ?? null;
            $productCode = $data['product']['code'] ?? null;

            if (!$email || !$productCode) {
                Log::error('Missing email or product code in Selar webhook', $data);
                return;
            }

            // Find user by email
            $user = User::where('email', $email)->first();
            if (!$user) {
                Log::warning('User not found for Selar webhook', ['email' => $email]);
                return;
            }

            // Find market item by product code (mapped to external_link or custom field)
            $marketItem = MarketItem::where('external_link', 'like', "%{$productCode}%")->first();
            if (!$marketItem) {
                Log::warning('Market item not found for Selar product code', ['product_code' => $productCode]);
                return;
            }

            // Record purchase in market_item_user pivot table
            if (!$user->purchasedItems()->where('market_item_id', $marketItem->id)->exists()) {
                $user->purchasedItems()->attach($marketItem->id, ['purchased_at' => now()]);
                $marketItem->increment('purchases_count');

                Log::info('Purchase recorded successfully', [
                    'user_id' => $user->id,
                    'market_item_id' => $marketItem->id,
                    'product_code' => $productCode,
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Error processing Selar webhook', [
                'error' => $e->getMessage(),
                'data' => $data,
            ]);
        }
    }
}
?>