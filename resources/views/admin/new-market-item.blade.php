@component('mail::message')
# New Market Item Added

A new item has been added to the marketplace.

**Name**: {{ $marketItem->name }}
**Category**: {{ $marketItem->category }}
**Price**: ${{ $marketItem->price }} (₦{{ $marketItem->price_ngn }})
**Added At**: {{ $marketItem->created_at->toDateTimeString() }}

@component('mail::button', ['url' => route('market')])
View Marketplace
@endcomponent

Thanks,
{{ config('app.name') }}
@endcomponent