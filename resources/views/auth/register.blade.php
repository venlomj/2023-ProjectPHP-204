<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

{{--        /*--}}
{{--        'first_name' => 'Murrel',--}}
{{--        'last_name' => 'Venlo',//voorlopig--}}
{{--        'phone_number' => '02588489863',--}}
{{--        'email' => 'r0781309@student.thomasmore.be',--}}
{{--        'birth_date' => now(),--}}
{{--        'start_date' => now(),--}}
{{--        'email_verified_at' => now(),--}}
{{--        'password' => Hash::make('mj1724'),--}}
{{--        'is_admin' => true,--}}
{{--        'is_financial_administrator' => false,--}}
{{--        'current_team_id' => 1,--}}
{{--        'coach_id' => 1,--}}
{{--        'sex_id' => 2,--}}
{{--        'location_id' => 1,--}}
{{--        'profile_photo_path' => 'https://trouwen.nl/inspiratie/kleding-bruiloft-gast-man-bruiloft-zonder-dresscode',--}}
{{--        'is_active' => true,--}}
{{--        */--}}

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-label for="first_name" value="{{ __('Voornaam') }}" />
                <x-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required autofocus autocomplete="first_name" />
            </div>
            <div>
                <x-label for="last_name" value="{{ __('Achternaam') }}" />
                <x-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required autofocus autocomplete="last_name" />
            </div>
            <div>
                <x-label for="phone_number" value="{{ __('Telefoonnummer') }}" />
                <x-input id="phone_number" class="block mt-1 w-full" type="text" name="phone_number" :value="old('phone_number')" required autofocus autocomplete="phone_number" />
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('E-mailadres') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>
            <div>
                <x-label for="birth_date" value="{{ __('Geboortedatum') }}" />
                <x-input id="birth_date" class="block mt-1 w-full" type="date" name="birth_date" :value="old('birth_date')" required autofocus autocomplete="birth_date" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Wachtwoord') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>
            <div class="mt-4">
                <x-kmad.form.select name="user_type" :value="old('user_type')" id="user_type">
                <option value="0">Type Gebruiker</option>
                <option value="1">Admin</option>
                <option value="2">Coach</option>
                <option value="3">Financiële beheerder</option>
                </x-kmad.form.select>
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
