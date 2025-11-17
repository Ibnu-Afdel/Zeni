<div class="space-y-6">
    @auth
        @if ($isEnrolled)
            <!-- Review Form -->
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 md:p-8">
                <form wire:submit.prevent="submitReview">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="flex items-center justify-center w-10 h-10 bg-yellow-50 dark:bg-yellow-900/20 rounded-lg">
                            <i class="fa-solid fa-star text-yellow-500 dark:text-yellow-400"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Leave Your Review</h3>
                    </div>

                    <div class="space-y-5">
                        <!-- Rating -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">
                                Your Rating <span class="text-red-500">*</span>
                            </label>
                            <div class="flex gap-2">
                                @for ($i = 1; $i <= 5; $i++)
                                    <button type="button" wire:click="setRating({{ $i }})" 
                                        aria-label="Rate {{ $i }} out of 5"
                                        class="p-2 text-3xl transition-all duration-150 ease-in-out transform hover:scale-110 focus:outline-none focus:ring-2 focus:ring-primary-500 rounded-lg {{ $rating >= $i ? 'text-yellow-400 dark:text-yellow-500' : 'text-gray-300 dark:text-gray-600 hover:text-gray-400 dark:hover:text-gray-500' }}">
                                        <i class="fa-solid fa-star"></i>
                                    </button>
                                @endfor
                            </div>
                            @error('rating')
                                <span class="mt-2 text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Review Text -->
                        <div>
                            <label for="reviewText" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Your Review <span class="text-red-500">*</span>
                            </label>
                            <textarea id="reviewText" wire:model.lazy="reviewText" rows="5" required
                                placeholder="Share your thoughts about the course..."
                                class="block w-full px-4 py-3 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-500 focus:border-transparent transition-colors"></textarea>
                            @error('reviewText')
                                <span class="mt-1.5 text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" wire:loading.attr="disabled" wire:target="submitReview"
                            class="inline-flex items-center justify-center px-6 py-3 text-sm font-semibold text-white bg-primary-600 hover:bg-primary-700 dark:bg-primary-600 dark:hover:bg-primary-700 rounded-lg transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                            <span wire:loading wire:target="submitReview" class="flex items-center">
                                <i class="fa-solid fa-spinner fa-spin mr-2"></i>
                                Submitting...
                            </span>
                            <span wire:loading.remove wire:target="submitReview" class="flex items-center">
                                <i class="fa-solid fa-paper-plane mr-2"></i>
                                Submit Review
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        @else
            <!-- Not Enrolled Message -->
            <div class="p-4 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg flex items-start gap-3">
                <i class="fa-solid fa-info-circle text-blue-600 dark:text-blue-400 mt-0.5"></i>
                <span class="text-sm text-blue-700 dark:text-blue-300">You must be enrolled in the course to submit a review.</span>
            </div>
        @endif
    @else
        <!-- Not Logged In Message -->
        <div class="p-4 bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg flex items-start gap-3">
            <i class="fa-solid fa-sign-in-alt text-yellow-600 dark:text-yellow-400 mt-0.5"></i>
            <div class="flex-1">
                <span class="text-sm text-yellow-700 dark:text-yellow-300">You must be logged in to submit a review.</span>
                <a href="{{ route('login') }}" class="block text-sm font-semibold text-yellow-800 dark:text-yellow-200 hover:text-yellow-900 dark:hover:text-yellow-100 mt-1">
                    Sign in now →
                </a>
            </div>
        </div>
    @endauth

    <!-- Reviews List -->
    <div>
        <h3 class="text-xl md:text-2xl font-semibold text-gray-900 dark:text-white mb-6 flex items-center gap-3">
            <i class="fa-solid fa-comments text-primary-600 dark:text-primary-500"></i>
            Student Reviews 
            <span class="text-sm font-normal text-gray-500 dark:text-gray-400">({{ $reviews->count() }})</span>
        </h3>

        @forelse($reviews as $review)
            <div wire:key="review-{{ $review->id }}" 
                class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 mb-4">
                <div class="flex items-start justify-between gap-4 mb-4">
                    <div class="flex items-center gap-3">
                        <div class="flex items-center justify-center w-10 h-10 bg-primary-100 dark:bg-primary-900/30 rounded-full flex-shrink-0">
                            <i class="fa-solid fa-user text-primary-600 dark:text-primary-500"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900 dark:text-white">{{ $review->user->name }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $review->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>

                <!-- Rating Stars -->
                <div class="flex items-center gap-1 mb-3">
                    @for ($i = 1; $i <= 5; $i++)
                        <i class="fa-solid fa-star text-sm {{ $review->rating >= $i ? 'text-yellow-400 dark:text-yellow-500' : 'text-gray-300 dark:text-gray-600' }}"></i>
                    @endfor
                    <span class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">{{ $review->rating }}.0</span>
                </div>

                <!-- Review Text -->
                <p class="text-sm leading-relaxed text-gray-700 dark:text-gray-300">
                    {!! nl2br(e($review->review)) !!}
                </p>
            </div>
        @empty
            <!-- Empty State -->
            <div class="text-center py-12 bg-gray-50 dark:bg-gray-800/50 border-2 border-dashed border-gray-300 dark:border-gray-700 rounded-xl">
                <i class="fa-solid fa-comment-dots text-5xl text-gray-300 dark:text-gray-600 mb-4"></i>
                <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">No Reviews Yet</h4>
                <p class="text-sm text-gray-600 dark:text-gray-400">Be the first to review this course!</p>
            </div>
        @endforelse
    </div>
</div>
