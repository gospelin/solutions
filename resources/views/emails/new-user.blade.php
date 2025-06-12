@component('mail::message')
# New User Registered

A new user has registered on the platform.

**Name**: {{ $user->name }}
**Email**: {{ $user->email }}
**Registered At**: {{ $user->created_at->toDateTimeString() }}

@component('mail::button', ['url' => route('admin.user-management')])
View Users
@endcomponent

Thanks,
{{ config('app.name') }}
@endcomponent