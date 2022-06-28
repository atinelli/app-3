@component('mail::message')

<h1>{{ __('Hello') }} {{ $user->name }}</h1>

<p>{{ $user->invite->name }} {{ __('has invited you to join') }} {{ config('admin.name') }}</p>

@component('mail::button', ['url' => url("join/$user->invite_token")])
{{ __('Join') }} {{ config('admin.name') }}
@endcomponent

<p>{{ __('Thanks') }}, {{ config('admin.name') }}</p>

@endcomponent
