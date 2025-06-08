@extends('admin.layouts.app')

@section('title', 'Contacts')
@section('description', 'View and respond to contact submissions.')

@section('content')
    <section class="content">
        <div class="content-header">
            <h1 class="page-title">Contact Management</h1>
            <p class="page-subtitle">Manage user-submitted contact forms.</p>
        </div>
        <div class="table-container">
            <table class="contacts-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contacts as $contact)
                        <tr>
                            <td>{{ $contact->id }}</td>
                            <td>{{ $contact->name }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($contact->message, 30) }}</td>
                            <td>
                                <a href="{{ route('admin.contacts.show', $contact) }}" class="action-btn">View</a>
                                <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST"
                                    style="display: inline;" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn error">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $contacts->links() }}
        </div>
    </section>
@endsection