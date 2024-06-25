<div class="wrapper">
    <div class="inner">
        <img src="images/image-1.png" alt="" class="image-1">
        <x-guest-layout>
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <h3>New Account?</h3>

                <!-- Username -->
                <div class="form-holder">
                    <span class="lnr lnr-user"></span>
                    <x-text-input id="username" class="form-control" type="text" name="username" :value="old('username')" required autofocus placeholder="Username" />
                    <x-input-error :messages="$errors->get('username')" class="mt-2" />
                </div>

                <!-- Phone Number -->
                <div class="form-holder">
                    <span class="lnr lnr-phone-handset"></span>
                    <x-text-input id="phone" class="form-control" type="text" name="phone" :value="old('phone')" required placeholder="Phone Number" />
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="form-holder">
                    <span class="lnr lnr-envelope"></span>
                    <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required placeholder="Mail" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="form-holder">
                    <span class="lnr lnr-lock"></span>
                    <x-text-input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" placeholder="Password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="form-holder">
                    <span class="lnr lnr-lock"></span>
                    <x-text-input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <button class="mt-4">
                    <span>Register</span>
                </button>

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>
                </div>
            </form>
        </x-guest-layout>
        <img src="images/image-2.png" alt="" class="image-2">
    </div>
</div>
