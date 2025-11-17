@php
    $fullWidth = true;
@endphp

<div class="flex items-center justify-center min-h-screen px-4 py-12 bg-white dark:bg-gray-900 transition-colors duration-300">
    <div class="w-full max-w-md">
        <!-- Logo/Icon -->
        <div class="flex justify-center mb-6">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-primary-50 dark:bg-primary-900/20 rounded-2xl">
                <i class="fa-solid fa-graduation-cap text-3xl text-primary-600 dark:text-primary-500"></i>
            </div>
        </div>

        <!-- Header -->
        <div class="text-center mb-8">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-2">
                Welcome Back
            </h2>
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Don't have an account?
                <a href="{{ route('register') }}" class="font-semibold text-primary-600 dark:text-primary-500 hover:text-primary-700 dark:hover:text-primary-400 transition-colors">
                    Sign up
                </a>
            </p>
        </div>

        <!-- Card -->
        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 md:p-8 space-y-6">


            <!-- Social Login -->
            <div>
                <a href="/auth/google"
                    class="inline-flex items-center justify-center w-full px-4 py-3 text-sm font-semibold text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                    <svg class="w-5 h-5 mr-2" viewBox="0 0 48 48" aria-hidden="true">
                        <path fill="#EA4335"
                            d="M24 9.5c3.48 0 6.48 1.21 8.83 3.49l6.46-6.46C35.01 2.83 29.88 0 24 0 14.88 0 7.04 5.58 2.79 13.5l7.85 6.09C12.09 13.19 17.53 9.5 24 9.5z">
                        </path>
                        <path fill="#4285F4"
                            d="M46.98 24.55c0-1.63-.15-3.2-.43-4.72H24v9.09h12.93c-.56 2.99-2.2 5.54-4.74 7.32l7.85 6.09C43.07 39.27 46.98 32.68 46.98 24.55z">
                        </path>
                        <path fill="#FBBC05"
                            d="M10.64 29.59c-.52-1.57-.82-3.24-.82-4.99s.3-3.42.82-4.99L2.79 13.5C1.03 16.94 0 20.38 0 24.6s1.03 7.66 2.79 11.1l7.85-6.11z">
                        </path>
                        <path fill="#34A853"
                            d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.85-6.09c-2.16 1.45-4.96 2.3-8.04 2.3-6.48 0-11.93-4.31-13.86-10.08l-7.85 6.09C7.04 42.42 14.88 48 24 48z">
                        </path>
                        <path fill="none" d="M0 0h48v48H0z"></path>
                    </svg>
                    Continue with Google
                </a>
            </div>

            <!-- Divider -->
            <div class="relative">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-300 dark:border-gray-600"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-white dark:bg-gray-800 text-gray-500 dark:text-gray-400">
                        Or continue with email
                    </span>
                </div>
            </div>

            <!-- Alert Messages -->
            @if (session('status') || session('error'))
                <div class="{{ session('status') ? 'bg-green-50 dark:bg-green-900/20 border-green-200 dark:border-green-800 text-green-700 dark:text-green-300' : 'bg-red-50 dark:bg-red-900/20 border-red-200 dark:border-red-800 text-red-700 dark:text-red-300' }} p-4 rounded-lg border flex items-start gap-3">
                    <i class="fa-solid {{ session('error') ? 'fa-circle-exclamation' : 'fa-circle-check' }} mt-0.5"></i>
                    <span class="text-sm">{{ session('status') ?? session('error') }}</span>
                </div>
            @endif

            <!-- Login Form -->
            <form wire:submit.prevent="login" class="space-y-5">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Email address
                    </label>
                    <input type="email" wire:model.lazy="email" id="email" name="email" required
                        autocomplete="email" placeholder="you@example.com"
                        class="block w-full px-4 py-3 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-500 focus:border-transparent transition-colors">
                    @error('email')
                        <span class="mt-1.5 text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Password
                    </label>
                    <input type="password" wire:model.lazy="password" id="password" name="password" required
                        autocomplete="current-password" placeholder="••••••••"
                        class="block w-full px-4 py-3 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-500 focus:border-transparent transition-colors">
                    @error('password')
                        <span class="mt-1.5 text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full px-4 py-3 text-sm font-semibold text-white bg-primary-600 hover:bg-primary-700 dark:bg-primary-600 dark:hover:bg-primary-700 rounded-lg transition-colors flex items-center justify-center">
                    <span wire:loading.remove wire:target="login" class="flex items-center">
                        <i class="fa-solid fa-right-to-bracket mr-2"></i>
                        Sign In
                    </span>
                    <span wire:loading wire:target="login" class="flex items-center">
                        <i class="fa-solid fa-spinner fa-spin mr-2"></i>
                        Signing In...
                    </span>
                </button>
            </form>
        </div>

        <!-- Back to Home -->
        <div class="text-center mt-6">
            <a href="{{ route('home') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-primary-600 dark:hover:text-primary-500 transition-colors">
                <i class="fa-solid fa-arrow-left mr-1"></i>
                Back to Home
            </a>
        </div>
    </div>
</div>
