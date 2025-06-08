<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::paginate(10);
        return view('admin.contacts.index', compact('contacts'));
    }

    public function show(Contact $contact)
    {
        return view('admin.contacts.show', compact('contact'));
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        Log::info('Contact deleted', ['contact_id' => $contact->id, 'admin_id' => auth()->id()]);
        return redirect()->route('admin.contacts.index')->with('success', 'Contact deleted successfully.');
    }

    public function respond(Request $request, Contact $contact)
    {
        $request->validate([
            'response' => 'required|string',
        ]);

        // Simulate sending email response
        Mail::raw($request->response, function ($message) use ($contact) {
            $message->to($contact->email)
                ->subject('Response to Your Inquiry');
        });

        Log::info('Contact responded to', [
            'contact_id' => $contact->id,
            'admin_id' => auth()->id(),
            'response' => $request->response,
        ]);

        return redirect()->route('admin.contacts.show', $contact)->with('success', 'Response sent successfully.');
    }
}
