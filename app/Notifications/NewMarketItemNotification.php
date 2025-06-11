<?php

namespace App\Mail;

use App\Models\MarketItem;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewMarketItemNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $marketItem;

    public function __construct(MarketItem $marketItem)
    {
        $this->marketItem = $marketItem;
    }

    public function build()
    {
        return $this->subject('New Market Item Added')
            ->view('emails.new-market-item')
            ->with(['marketItem' => $this->marketItem]);
    }
}