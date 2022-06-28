<div>
    <x-2col>
        <x-slot name="left">
            <h3>{{ __('Change Password') }}</h3>
            <p>{{ __('Ensure your account is using a long, random password to stay secure.') }}</p>
            <p>{{ __('Use a password manager, we recommend using 1Password for creating and storing passwords or') }} <a href="https://passwordsgenerator.net/" target="blank">passwordsgenerator.net</a></p>
        </x-slot>
        <x-slot name="right">

            <div class="card">
                <x-form wire:submit.prevent="update" method="put">

                    <x-form.input wire:model="newPassword" type="password" label="{{ __('New Password') }}" name='newPassword'></x-form.input>
                    <x-form.input wire:model="confirmPassword" type="password" label="{{ __('Confirm Password') }}" name='confirmPassword'></x-form.input>

                    <x-button>{{ __('Change Password') }}</x-button>

                    @include('errors.success')

                </x-form>
            </div>

        </x-slot>
    </x-2col>
</div>