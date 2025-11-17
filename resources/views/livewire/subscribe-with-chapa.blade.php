<div class="min-h-screen px-4 py-8 md:py-12">
    <div class="max-w-3xl mx-auto">
        {{-- Back Navigation --}}
        <div class="mb-6">
            <a href="{{ route('user.profile', ['username' => auth()->user()->username]) }}"
                class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-500 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
                <i class="fa-solid fa-arrow-left mr-2"></i>
                Back to Profile
            </a>
        </div>

        {{-- Page Header --}}
        <div class="text-center mb-8">
            <div class="flex justify-center mb-4">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-yellow-50 dark:bg-yellow-900/20 rounded-2xl">
                    <i class="fa-solid fa-crown text-3xl text-yellow-600 dark:text-yellow-500"></i>
                </div>
            </div>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-2">
                @if ($isProUser)
                    {{ $showExtendOption ? 'Extend Your Pro Subscription' : 'Your Pro Subscription' }}
                @else
                    Become a Pro Member
                @endif
            </h1>
            <p class="text-base text-gray-600 dark:text-gray-400">
                Unlock all premium features and content
            </p>
        </div>

        {{-- Flash Messages --}}
        @if (session()->has('error'))
            <div class="mb-6 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl flex items-start gap-3">
                <i class="fa-solid fa-exclamation-circle text-red-600 dark:text-red-400 mt-0.5"></i>
                <span class="text-sm text-red-700 dark:text-red-300">{{ session('error') }}</span>
            </div>
        @endif

        @if (session()->has('info'))
            <div class="mb-6 p-4 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl flex items-start gap-3">
                <i class="fa-solid fa-info-circle text-blue-600 dark:text-blue-400 mt-0.5"></i>
                <span class="text-sm text-blue-700 dark:text-blue-300">{{ session('info') }}</span>
            </div>
        @endif

        @if (session()->has('success'))
            <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-xl flex items-start gap-3">
                <i class="fa-solid fa-check-circle text-green-600 dark:text-green-400 mt-0.5"></i>
                <span class="text-sm text-green-700 dark:text-green-300">{{ session('success') }}</span>
            </div>
        @endif

        {{-- Pro Status Display --}}
        @if ($isProUser)
            <div class="mb-6 bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900/20 dark:to-green-800/20 border border-green-200 dark:border-green-800 rounded-xl p-6">
                <div class="flex items-center gap-4">
                    <div class="flex items-center justify-center w-14 h-14 bg-gradient-to-tr from-green-500 to-green-600 dark:from-green-600 dark:to-green-700 rounded-xl shadow-lg flex-shrink-0">
                        <i class="fa-solid fa-shield-check text-2xl text-white"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-lg font-semibold text-green-900 dark:text-green-100 mb-1">You are a Pro Member!</p>
                        <p class="text-sm text-green-700 dark:text-green-300 flex items-center gap-2">
                            <i class="fa-solid fa-calendar-check"></i>
                            Expires on: <span class="font-medium">{{ $formattedExpiryDate }}</span>
                            <span class="px-2 py-0.5 bg-green-200 dark:bg-green-800 text-green-800 dark:text-green-200 rounded-full text-xs font-semibold">
                                {{ $daysRemaining }} days left
                            </span>
                        </p>
                    </div>
                </div>
                @if ($showExtendOption)
                    <p class="mt-3 text-sm text-green-700 dark:text-green-300 text-center">
                        You can extend your subscription below.
                    </p>
                @endif
            </div>
        @endif

        {{-- Pending Subscriptions Warning --}}
        @if ($hasPendingSubscription)
            <div class="mb-6 p-4 bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-xl">
                <div class="flex items-start gap-3">
                    <i class="fa-solid fa-exclamation-triangle text-yellow-600 dark:text-yellow-400 mt-0.5"></i>
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-yellow-900 dark:text-yellow-100 mb-1">
                            You have {{ $pendingSubscriptionCount }} pending payment{{ $pendingSubscriptionCount > 1 ? 's' : '' }}.
                        </p>
                        
                        @if ($isProUser)
                            <p class="text-sm text-yellow-700 dark:text-yellow-300 mb-2">
                                These might be from previous attempts. You can safely remove them.
                            </p>
                            <button wire:click="cleanupPendingSubscriptions" wire:loading.attr="disabled"
                                class="inline-flex items-center px-4 py-2 text-xs font-semibold text-yellow-900 dark:text-yellow-100 bg-yellow-200 dark:bg-yellow-800 hover:bg-yellow-300 dark:hover:bg-yellow-700 border border-yellow-300 dark:border-yellow-700 rounded-lg transition-colors disabled:opacity-50">
                                <span wire:loading.remove wire:target="cleanupPendingSubscriptions" class="flex items-center">
                                    <i class="fa-solid fa-broom mr-2"></i>
                                    Clean up
                                </span>
                                <span wire:loading wire:target="cleanupPendingSubscriptions" class="flex items-center">
                                    <i class="fa-solid fa-spinner fa-spin mr-2"></i>
                                    Cleaning...
                                </span>
                            </button>
                        @else
                            <p class="text-sm text-yellow-700 dark:text-yellow-300">
                                Continuing will cancel previous pending payments and create a new one.
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        @endif

        {{-- Subscription Form --}}
        @if (!$isProUser || $showExtendOption)
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 md:p-8 space-y-6">
                
                {{-- Plan Selection --}}
                <div>
                    <label for="duration" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 flex items-center gap-2">
                        <i class="fa-solid fa-calendar-alt text-primary-600 dark:text-primary-500"></i>
                        Choose Your Plan
                    </label>
                    <select wire:model.live="duration" id="duration"
                        class="block w-full px-4 py-3 text-gray-900 dark:text-white bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-500 focus:border-transparent transition-colors">
                        <option value="30">Monthly - 199 ETB</option>
                        <option value="365">Yearly - 1999 ETB (Save over 16%)</option>
                    </select>
                </div>

                {{-- Plan Benefits --}}
                <div class="bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 rounded-xl p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                        <i class="fa-solid fa-star text-yellow-500"></i>
                        Pro Benefits
                    </h3>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-sm text-gray-700 dark:text-gray-300">
                            <i class="fa-solid fa-check-circle text-green-500 flex-shrink-0"></i>
                            <span>Access to all premium courses</span>
                        </li>
                        <li class="flex items-center gap-3 text-sm text-gray-700 dark:text-gray-300">
                            <i class="fa-solid fa-check-circle text-green-500 flex-shrink-0"></i>
                            <span>Downloadable resources</span>
                        </li>
                        <li class="flex items-center gap-3 text-sm text-gray-700 dark:text-gray-300">
                            <i class="fa-solid fa-check-circle text-green-500 flex-shrink-0"></i>
                            <span>Priority support queue</span>
                        </li>
                        <li class="flex items-center gap-3 text-sm text-gray-700 dark:text-gray-300">
                            <i class="fa-solid fa-check-circle text-green-500 flex-shrink-0"></i>
                            <span>Ad-free experience</span>
                        </li>
                    </ul>
                </div>

                {{-- Price Display --}}
                <div class="bg-gradient-to-br from-primary-50 to-primary-100 dark:from-primary-900/20 dark:to-primary-800/20 border border-primary-200 dark:border-primary-800 rounded-xl p-6 text-center">
                    <p class="text-sm font-medium text-primary-700 dark:text-primary-300 uppercase tracking-wide mb-2">
                        Total Amount
                    </p>
                    <p class="text-4xl md:text-5xl font-bold text-primary-900 dark:text-primary-100 mb-2">
                        {{ $amount }} <span class="text-2xl">ETB</span>
                    </p>
                    <p class="text-sm text-primary-600 dark:text-primary-400 flex items-center justify-center gap-2">
                        <i class="fa-solid fa-info-circle"></i>
                        {{ $duration == 30 ? 'Billed monthly' : 'Billed annually - Best Value!' }}
                    </p>
                </div>

                {{-- Payment Buttons --}}
                <div class="space-y-3">
                    <button wire:click="pay" wire:loading.attr="disabled" wire:target="pay"
                        class="w-full flex items-center justify-center px-6 py-4 text-base font-semibold text-white bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 dark:from-primary-600 dark:to-primary-700 dark:hover:from-primary-700 dark:hover:to-primary-800 rounded-xl shadow-lg hover:shadow-xl transition-all disabled:opacity-50 disabled:cursor-not-allowed">
                        <span wire:loading.remove wire:target="pay" class="flex items-center">
                            <i class="fa-solid {{ $isProUser && $showExtendOption ? 'fa-calendar-plus' : 'fa-credit-card' }} mr-2"></i>
                            {{ $isProUser && $showExtendOption ? 'Extend with Chapa' : 'Pay with Chapa' }}
                        </span>
                        <span wire:loading wire:target="pay" class="flex items-center">
                            <i class="fa-solid fa-spinner fa-spin mr-2"></i>
                            Processing...
                        </span>
                    </button>

                    <a href="{{ route('subscribe.manual') }}"
                        class="w-full flex items-center justify-center px-6 py-4 text-base font-semibold text-primary-700 dark:text-primary-300 bg-white dark:bg-gray-700 border-2 border-primary-300 dark:border-primary-700 hover:bg-primary-50 dark:hover:bg-gray-600 rounded-xl transition-colors">
                        <i class="fa-solid fa-hand-holding-dollar mr-2"></i>
                        Manual Payment
                    </a>
                </div>

                <p class="text-xs text-center text-gray-500 dark:text-gray-400 flex items-center justify-center gap-2">
                    <i class="fa-solid fa-lock"></i>
                    Secure payment options available
                </p>
            </div>
        @else
            {{-- Active Pro Status --}}
            <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl p-8 text-center">
                <div class="flex justify-center mb-4">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-blue-100 dark:bg-blue-800 rounded-full">
                        <i class="fa-solid fa-party-horn text-4xl text-blue-600 dark:text-blue-400"></i>
                    </div>
                </div>
                <h3 class="text-xl font-semibold text-blue-900 dark:text-blue-100 mb-2">
                    Your Pro Subscription is Active!
                </h3>
                <p class="text-base text-blue-700 dark:text-blue-300 mb-3">
                    Enjoy your premium access! You have <span class="font-semibold">{{ $daysRemaining }}</span> days remaining.
                </p>
                <p class="text-sm text-blue-600 dark:text-blue-400">
                    You'll be able to extend your plan closer to the expiry date.
                </p>
            </div>
        @endif

    </div>
</div>
