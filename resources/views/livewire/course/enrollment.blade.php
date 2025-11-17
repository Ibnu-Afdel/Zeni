<div>
    @if ($enrollment_status)
        @if ($successMessage)
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
                class="p-3 mb-3 text-sm text-green-700 dark:text-green-300 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg">
                {{ $successMessage }}
            </div>
        @endif
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('course-play', ['course' => $course]) }}" 
                class="inline-flex items-center justify-center px-5 py-2.5 text-sm font-semibold text-white bg-primary-600 hover:bg-primary-700 dark:bg-primary-600 dark:hover:bg-primary-700 rounded-lg transition-colors">
                <i class="fa-solid fa-play mr-2"></i>
                Continue Learning
            </a>
            <button wire:click="unenroll" 
                class="inline-flex items-center justify-center px-5 py-2.5 text-sm font-semibold text-gray-700 dark:text-gray-300 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 border border-gray-300 dark:border-gray-600 rounded-lg transition-colors">
                <i class="fa-solid fa-sign-out mr-2"></i>
                Unenroll
            </button>
        </div>
    @else
        @if ($errorMessage)
            <div class="p-3 mb-4 text-sm text-red-700 dark:text-red-300 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg">
                {{ $errorMessage }}
            </div>
        @endif
        
        @if ($course->is_pro && !auth()->user()?->is_pro)
            <div class="space-y-3">
                <div class="p-4 bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg">
                    <div class="flex items-start gap-3">
                        <i class="fa-solid fa-crown text-yellow-600 dark:text-yellow-500 mt-0.5"></i>
                        <div>
                            <p class="text-sm font-medium text-yellow-900 dark:text-yellow-200">Premium Course</p>
                            <p class="text-xs text-yellow-700 dark:text-yellow-400 mt-1">This course requires a Pro subscription to access.</p>
                        </div>
                    </div>
                </div>
                        <a href="{{ route('subscribe.index') }}" 
                            class="inline-flex items-center justify-center px-6 py-3 text-sm font-semibold text-white bg-yellow-600 hover:bg-yellow-700 dark:bg-yellow-600 dark:hover:bg-yellow-700 rounded-lg transition-colors">
                            <i class="fa-solid fa-crown mr-2"></i>
                            Upgrade to Pro
                        </a>
            </div>
        @else
            <button wire:click="enroll" 
                class="inline-flex items-center justify-center px-6 py-3 text-sm font-semibold text-white bg-primary-600 hover:bg-primary-700 dark:bg-primary-600 dark:hover:bg-primary-700 rounded-lg transition-colors">
                <i class="fa-solid fa-graduation-cap mr-2"></i>
                Enroll Now
            </button>
        @endif
    @endif
</div>
