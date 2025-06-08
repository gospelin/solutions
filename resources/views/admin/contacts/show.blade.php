@extends('admin.layouts.app')

@section('title', 'View Contact')
@section('description', 'View and respond to a contact submission page.')

@section('content')
<section class="content">
    <div class="content-header">
        <h1 class="page-title">Contact Details</h1>
        <p class="page-subtitle">Details of the contact inquiry.</p>
    </div>
    <div class="stat-card">
        <p><strong>Name:</strong> {{ $contact->name }}</p>
        <p><strong>Email:</strong> {{ $contact->email }}</p>
        <p><strong>Message:</strong> {{ $contact->message }}</p>
        <p><strong>Submitted:</strong> {{ $contact->created_at->format('Y-m-d H:i:s') }}</p>
    </div>
    <h3 class="section-title">Respond</h3>
    <form action="{{ route('admin.contacts.respond', $contact) }}" method="POST" class="modal-form">
        @csrf
        <div class="form-group">
            <label for="response">Response</label>
            <textarea name="response" id="response" class="form-input" required></textarea>
            @error('response') <span class="error">{{ $message }}</span> @endif
        </div>
        <button type="submit" class="form-submit">Send Response</button>
    </form>
    <a href="{{ route('admin.contacts.index') }}" class="action-btn">Back</a>
</section>
@endsection
