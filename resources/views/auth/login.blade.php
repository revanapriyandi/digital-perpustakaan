<x-guest-layout>
    <x-authentication-card>
        <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
            Sign in to your account
        </h1>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                    autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" />
            </div>

            <div class="block mt-4 flex items-center justify-between">
                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <x-checkbox id="remember_me" name="remember" />
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="remember_me" class="text-gray-500 dark:text-gray-300">Remember me</label>
                    </div>
                </div>
                <a href="{{ route('password.email') }}" wire:navigate
                    class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500">Forgot
                    password?</a>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="w-full text-center font-medium">
                    {{ __('Log in') }}
                </x-button>
            </div>

            <p class="text-sm font-light text-gray-500 dark:text-gray-400 pt-3">
                Don’t have an account yet? <a href="{{ route('register') }}" wire:navigate
                    class="font-bold text-primary-800 hover:underline dark:text-primary-500">Sign up</a>
            </p>
        </form>
    </x-authentication-card>
</x-guest-layout>
