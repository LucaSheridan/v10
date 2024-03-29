<x-guest-layout>
    <x-jet-authentication-card>
        <!-- <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot> -->

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-jet-label value="First Name" />
                <x-jet-input class="block mt-1 w-full" type="text" name="firstName" :value="old('firstName')" required autofocus autocomplete="firstName" />
            </div>

            <div>
                <x-jet-label value="Last Name" />
                <x-jet-input class="block mt-1 w-full" type="text" name="lastName" :value="old('lastName')" required autofocus autocomplete="lastName" />
            </div>

            <div class="mt-4">
                <x-jet-label value="Email" />
                <x-jet-input class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label value="Password" />
                <x-jet-input class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label value="Confirm Password" />
                <x-jet-input class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
