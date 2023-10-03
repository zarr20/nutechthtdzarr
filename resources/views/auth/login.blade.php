<x-guest-layout>

    <div class="flex justify-center items-center h-screen">
        <div class="flex-1  h-full">

        </div>
        <div class="container w-full grid lg:grid-cols-2 items-center justify-center   h-full">
            <div id="login_form" class="p-10">
                <h2 class="text-center flex justify-center items-center gap-3 m-auto mb-2 font-bold">
                    <img src="{{ asset('assets/images/handbag_orange.png') }}" class="">
                    SIMS Web App
                </h2>
                <h2 class="font-bold text-[32px] text-center max-w-[400px] m-auto mb-5 leading-none">
                    Masuk atau Buat akun untuk memulai
                </h2>
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <form method="POST" action="{{ route('login') }}" class="max-w-[400px] m-auto">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <x-label for="email" :value="__('Email')" />

                        <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                            :value="old('email')" required autofocus />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-label for="password" :value="__('Password')" />

                        <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                            autocomplete="current-password" />
                    </div>

                    <!-- Remember Me -->
                    <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox"
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                name="remember">
                            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <div class="flex flex-col-reverse gap-2 items-center justify-end mt-4">
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 hover:text-gray-900"
                                href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif

                        <x-button class="w-full justify-center bg-[#FF1F00]">
                            {{ __('Log in') }}
                        </x-button>
                    </div>

                    <hr class="my-[40px]">

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">
                            <x-button type="button" class=" w-full justify-center">
                                {{ __('Register') }}
                            </x-button>
                        </a>
                    @endif
                </form>


            </div>
            <div class="lg:bg-[#FF1F00] h-full relative">
                <img src="{{ asset('assets/images/Frame 98699.png') }}" class="absolute h-full object-contain">
            </div>

        </div>
        <div class="flex-1 lg:bg-[#FF1F00]  h-full">

        </div>

    </div>


</x-guest-layout>
