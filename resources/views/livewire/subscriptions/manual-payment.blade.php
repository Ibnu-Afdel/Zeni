@php
    $fullWidth = true;
@endphp

<div class="min-h-screen bg-white dark:bg-gray-900 transition-colors duration-300">
    <div class="px-4 py-8 md:py-12">
        <div class="max-w-2xl mx-auto">
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl shadow-lg p-6 md:p-8 space-y-6">
                <!-- Back Link -->
                <div>
                    <a href="{{ route('subscribe.index') }}"
                        class="inline-flex items-center text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-primary-600 dark:hover:text-primary-500 transition-colors">
                        <i class="mr-2 fa-solid fa-arrow-left"></i>
                        Back to Subscription Options
                    </a>
                </div>

                <!-- Header -->
                <div class="flex items-center gap-3">
                    <div class="flex items-center justify-center w-12 h-12 bg-primary-50 dark:bg-primary-900/20 rounded-lg">
                        <i class="fa-solid fa-hand-holding-dollar text-primary-600 dark:text-primary-500 text-xl"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white">
                            @if ($isProUser)
                                @if ($showExtendOption)
                                    Extend Pro Manually
                                @else
                                    Your Pro Subscription
                                @endif
                            @else
                                Manual Subscription Request
                            @endif
                        </h2>
                    </div>
                </div>

                <!-- Success Message -->
                @if (session()->has('success'))
                    <div class="p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg flex items-start gap-3">
                        <i class="fa-solid fa-circle-check text-green-600 dark:text-green-400 mt-0.5"></i>
                        <span class="text-sm text-green-700 dark:text-green-300">{{ session('success') }}</span>
                    </div>
                @endif

                <!-- Error Message -->
                @if (session()->has('error'))
                    <div class="p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg flex items-start gap-3">
                        <i class="fa-solid fa-exclamation-circle text-red-600 dark:text-red-400 mt-0.5"></i>
                        <span class="text-sm text-red-700 dark:text-red-300">{{ session('error') }}</span>
                    </div>
                @endif

                <!-- Info Message -->
                @if (session()->has('info'))
                    <div class="p-4 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg flex items-start gap-3">
                        <i class="fa-solid fa-info-circle text-blue-600 dark:text-blue-400 mt-0.5"></i>
                        <span class="text-sm text-blue-700 dark:text-blue-300">{{ session('info') }}</span>
                    </div>
                @endif

                <!-- Pro User Status -->
                @if ($isProUser)
                    <div class="p-5 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg">
                        <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                            <div class="flex items-center justify-center w-12 h-12 bg-green-100 dark:bg-green-900/30 rounded-full flex-shrink-0">
                                <i class="fa-solid fa-shield-halved text-green-600 dark:text-green-400 text-xl"></i>
                            </div>
                            <div class="flex-grow text-center sm:text-left">
                                <p class="text-lg font-semibold text-green-900 dark:text-green-200">You are a Pro Member!</p>
                                <p class="text-sm text-green-700 dark:text-green-300 mt-1">
                                    <i class="fa-solid fa-calendar-check mr-1"></i>
                                    Expires on: <span class="font-medium">{{ $formattedExpiryDate }}</span>
                                    (<span class="font-medium">{{ $daysRemaining }}</span> days remaining)
                                </p>
                            </div>
                        </div>
                        @if ($showExtendOption)
                            <p class="mt-3 text-sm text-center text-green-700 dark:text-green-300 sm:text-left">
                                You can extend your subscription manually below.
                            </p>
                        @endif
                    </div>
                @endif

                <!-- Pending Subscription Warning -->
                @if ($hasPendingSubscription && (!$isProUser || $showExtendOption))
                    <div class="p-4 bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800 rounded-lg">
                        <div class="flex items-start gap-3">
                            <div class="flex items-center justify-center w-10 h-10 bg-amber-100 dark:bg-amber-900/30 rounded-lg flex-shrink-0">
                                <i class="fa-solid fa-exclamation-triangle text-amber-600 dark:text-amber-400"></i>
                            </div>
                            <div class="flex-1">
                                <p class="font-semibold text-amber-900 dark:text-amber-200">
                                    You have {{ $pendingSubscriptionCount }} pending manual
                                    payment{{ $pendingSubscriptionCount > 1 ? 's' : '' }}.
                                </p>
                                @if ($isProUser)
                                    <p class="mt-2 text-sm text-amber-800 dark:text-amber-300">
                                        These might be from previous attempts. Since you're Pro, you can safely remove them or
                                        proceed to submit a new extension request. Submitting a new request will <span
                                            class="font-semibold">not</span> automatically cancel these older pending manual
                                        ones unless your admin cleans them up.
                                    </p>
                                    <button wire:click="cleanupPendingSubscriptions" wire:loading.attr="disabled"
                                        wire:target="cleanupPendingSubscriptions"
                                        class="inline-flex items-center gap-2 px-4 py-2 mt-3 text-sm font-semibold text-amber-900 dark:text-amber-200 bg-amber-100 dark:bg-amber-900/30 hover:bg-amber-200 dark:hover:bg-amber-900/50 border border-amber-300 dark:border-amber-700 rounded-lg transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                                        <span wire:loading.remove wire:target="cleanupPendingSubscriptions">
                                            <i class="fa-solid fa-broom"></i> Clean up Pending
                                        </span>
                                        <span wire:loading wire:target="cleanupPendingSubscriptions">
                                            <i class="fa-solid fa-spinner fa-spin"></i> Cleaning...
                                        </span>
                                    </button>
                                @else
                                    <p class="mt-2 text-sm text-amber-800 dark:text-amber-300">
                                        Continuing will create a new manual submission request. Your previous pending manual
                                        payment{{ $pendingSubscriptionCount > 1 ? 's' : '' }} will remain until reviewed or
                                        cleaned up by an administrator.
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                @if (!$isProUser || $showExtendOption)
                    <!-- Instructions Section -->
                    <div class="p-5 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg">
                        <div class="flex items-center gap-2 mb-4">
                            <i class="fa-solid fa-info-circle text-blue-600 dark:text-blue-400"></i>
                            <h3 class="font-semibold text-gray-900 dark:text-white">
                                How to
                                @if ($isProUser && $showExtendOption)
                                    Extend Manually:
                                @else
                                    Subscribe Manually:
                                @endif
                            </h3>
                        </div>
                        <ol class="space-y-2 text-sm text-gray-700 dark:text-gray-300 list-decimal list-inside">
                            <li>Choose the plan you want below.</li>
                            <li>
                                Make a payment of the corresponding amount to:
                                <div class="p-3 mt-2 font-medium text-blue-900 dark:text-blue-200 bg-blue-100 dark:bg-blue-900/30 border border-blue-200 dark:border-blue-800 rounded-lg">
                                    Bank Name: []<br>
                                    Account Name: []<br>
                                    Account Number: []<br>
                                    Telebirr: []
                                </div>
                            </li>
                            <li>Take a clear screenshot of the payment confirmation.</li>
                            <li>Upload the screenshot using the form below.</li>
                            <li>Optionally add any notes (like the transaction ID).</li>
                            <li>Submit your request. We will verify the payment and activate/extend your subscription (usually
                                within 24 hours).</li>
                        </ol>
                    </div>

                    <!-- Form -->
                    <form wire:submit.prevent="submit" class="pt-6 space-y-6 border-t border-gray-200 dark:border-gray-700">
                        <!-- Plan Selection -->
                        <div>
                            <label for="plan" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                <i class="fa-solid fa-list mr-2 text-primary-600 dark:text-primary-500"></i>
                                Choose Your Plan:
                            </label>
                            <select wire:model.defer="plan" id="plan" required
                                class="w-full px-4 py-3 text-sm text-gray-900 dark:text-white bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-500 focus:border-transparent transition-colors">
                                <option value="" disabled>Select a plan</option>
                                @foreach ($plans as $key => $planOption)
                                    <option value="{{ $key }}">{{ $planOption['label'] }}
                                        {{ $planOption['price'] ?? '' }}
                                    </option>
                                @endforeach
                            </select>
                            @error('plan')
                                <p class="flex items-center mt-1.5 text-xs text-red-600 dark:text-red-400">
                                    <i class="fa-solid fa-exclamation-circle mr-1"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Screenshot Upload -->
                        <div>
                            <label for="screenshot" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                <i class="fa-solid fa-camera mr-2 text-primary-600 dark:text-primary-500"></i>
                                Upload Payment Screenshot (optional):
                            </label>
                            <div class="flex items-center justify-center w-full">
                                <label for="screenshot"
                                    class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg cursor-pointer bg-gray-50 dark:bg-gray-700/50 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <i class="fa-solid fa-cloud-arrow-up text-3xl text-gray-400 dark:text-gray-500 mb-2"></i>
                                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                                            <span class="font-semibold">Click to upload</span> or drag and drop
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, GIF up to 2MB</p>
                                    </div>
                                    <input id="screenshot" type="file" wire:model="screenshot" class="hidden" accept="image/*" />
                                </label>
                            </div>

                            <div wire:loading wire:target="screenshot" class="mt-2 text-sm text-primary-600 dark:text-primary-400">
                                <i class="fa-solid fa-spinner fa-spin mr-1"></i> Uploading screenshot...
                            </div>

                            @if ($screenshot && !$errors->has('screenshot'))
                                <div class="mt-3">
                                    <p class="mb-2 text-xs font-medium text-gray-700 dark:text-gray-300">Screenshot preview:</p>
                                    <div class="relative inline-block">
                                        <img src="{{ $screenshot->temporaryUrl() }}" alt="Screenshot Preview"
                                            class="max-h-48 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm">
                                    </div>
                                </div>
                            @endif

                            @error('screenshot')
                                <p class="flex items-center mt-1.5 text-xs text-red-600 dark:text-red-400">
                                    <i class="fa-solid fa-exclamation-circle mr-1"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Notes -->
                        <div>
                            <label for="notes" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                <i class="fa-solid fa-pencil mr-2 text-primary-600 dark:text-primary-500"></i>
                                Note (Optional - e.g., Transaction ID):
                            </label>
                            <textarea wire:model.defer="notes" id="notes" rows="3"
                                placeholder="Add any relevant details like transaction ID, sender name, etc."
                                class="w-full px-4 py-3 text-sm text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-500 focus:border-transparent transition-colors"></textarea>
                            @error('notes')
                                <p class="flex items-center mt-1.5 text-xs text-red-600 dark:text-red-400">
                                    <i class="fa-solid fa-exclamation-circle mr-1"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div>
                            <button type="submit" wire:loading.attr="disabled" wire:target="submit"
                                class="w-full px-6 py-3 text-sm font-semibold text-white bg-primary-600 hover:bg-primary-700 dark:bg-primary-600 dark:hover:bg-primary-700 rounded-lg transition-colors flex items-center justify-center disabled:opacity-50 disabled:cursor-not-allowed">
                                <span wire:loading.remove wire:target="submit">
                                    <i class="fa-solid fa-paper-plane mr-2"></i>
                                    @if ($isProUser && $showExtendOption)
                                        Submit Manual Extension Request
                                    @else
                                        Submit Manual Payment Request
                                    @endif
                                </span>
                                <span wire:loading wire:target="submit">
                                    <i class="fa-solid fa-spinner fa-spin mr-2"></i>
                                    Submitting Request...
                                </span>
                            </button>
                        </div>
                    </form>
                @else
                    <!-- Active Subscription Message -->
                    <div class="p-6 text-center bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg">
                        <div class="flex items-center justify-center w-16 h-16 bg-blue-100 dark:bg-blue-900/30 rounded-full mx-auto mb-4">
                            <i class="fa-solid fa-party-horn text-3xl text-blue-600 dark:text-blue-400"></i>
                        </div>
                        <h3 class="mb-2 text-lg font-semibold text-blue-900 dark:text-blue-200">Your Pro Subscription is Active!</h3>
                        <p class="mb-3 text-sm text-blue-800 dark:text-blue-300">
                            Enjoy your premium access! You currently have <span class="font-medium">{{ $daysRemaining }}</span> days remaining.
                        </p>
                        <p class="text-xs text-blue-700 dark:text-blue-400">
                            You'll be able to extend your plan manually closer to the expiry date, or use the automatic payment
                            option if available.
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
