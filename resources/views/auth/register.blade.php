<x-guest-layout>
@section('title', 'Register')
<x-auth-card>

    @include('errors.success')

    <x-form action="{{ route('register') }}">

        <x-form.input type="text" label="{{ __('Name') }}" name="name">{{ old('name') }}</x-form.input>
        <x-form.input type="text" label="{{ __('Email') }}" name="email">{{ old('email') }}</x-form.input>
        <x-form.input type="password" label="{{ __('Password') }}" name='password'></x-form.input>
        <x-form.input type="password" label="{{ __('Confirm Password') }}" name='confirmPassword'></x-form.input>

        <p>{{ __('Already can an account?') }} <a class="text-primary" href="{{ route('login') }}">{{ __('Login') }}</a></p>

        <x-button>{{ __('Save') }}</x-button>

    </x-form>

</x-auth-card>
</x-guest-layout>
