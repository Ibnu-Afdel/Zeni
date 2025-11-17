<div class="flex flex-col items-center justify-center min-h-[500px] py-16 text-center">
    <div class="max-w-md mx-auto">
        <div class="flex justify-center mb-6">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-primary-50 dark:bg-primary-900/20 rounded-2xl">
                <i class="fa-solid fa-hand-pointer text-4xl text-primary-600 dark:text-primary-500"></i>
            </div>
        </div>
        
        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">
            @if ($sections->isEmpty())
                No Content Available Yet
            @else
                Ready to Start Learning?
            @endif
        </h3>
        
        <p class="text-base text-gray-600 dark:text-gray-400 mb-6">
            @if ($sections->isEmpty())
                This course doesn't have any lessons yet. Please check back later.
            @else
                Select a lesson from the sidebar to begin your learning journey.
            @endif
        </p>

        @if (!$sections->isEmpty())
            <button 
                class="lg:hidden inline-flex items-center px-6 py-3 text-sm font-semibold text-white bg-primary-600 hover:bg-primary-700 dark:bg-primary-600 dark:hover:bg-primary-700 rounded-lg transition-colors"
                x-on:click="$dispatch('open-contents')">
                <i class="fa-solid fa-list mr-2"></i>
                View Lessons
            </button>
        @endif
    </div>
</div>
