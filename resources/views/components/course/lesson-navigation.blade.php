<div class="space-y-6 mb-8">
    <!-- Mark Complete/Incomplete Button -->
    <div>
        @if (!in_array($currentLesson->id, $completedLessons))
            <button wire:click="markAsComplete" 
                wire:loading.attr="disabled" 
                wire:target="markAsComplete"
                class="inline-flex items-center justify-center px-6 py-3 text-sm font-semibold text-white bg-green-600 hover:bg-green-700 dark:bg-green-600 dark:hover:bg-green-700 rounded-lg transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                <span wire:loading wire:target="markAsComplete" class="flex items-center">
                    <i class="fa-solid fa-spinner fa-spin mr-2"></i>
                    Marking...
                </span>
                <span wire:loading.remove wire:target="markAsComplete" class="flex items-center">
                    <i class="fa-solid fa-check-circle mr-2"></i>
                    Mark as Complete
                </span>
            </button>
        @else
            <button wire:click="markAsIncomplete" 
                wire:loading.attr="disabled" 
                wire:target="markAsIncomplete"
                class="inline-flex items-center justify-center px-6 py-3 text-sm font-semibold text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600 rounded-lg transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                <span wire:loading wire:target="markAsIncomplete" class="flex items-center">
                    <i class="fa-solid fa-spinner fa-spin mr-2"></i>
                    Processing...
                </span>
                <span wire:loading.remove wire:target="markAsIncomplete" class="flex items-center">
                    <i class="fa-solid fa-undo mr-2"></i>
                    Mark as Incomplete
                </span>
            </button>
        @endif
    </div>

    <!-- Previous/Next Navigation -->
    <div class="flex items-center justify-between pt-6 border-t border-gray-200 dark:border-gray-700">
        <!-- Previous Button -->
        <button wire:click="goToPreviousLesson" 
            wire:loading.attr="disabled" 
            wire:target="goToPreviousLesson, selectLesson"
            @disabled(!$previousLesson)
            class="inline-flex items-center px-5 py-2.5 text-sm font-semibold text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors disabled:opacity-40 disabled:cursor-not-allowed">
            <span wire:loading wire:target="goToPreviousLesson" class="flex items-center">
                <i class="fa-solid fa-spinner fa-spin mr-2"></i>
                Loading...
            </span>
            <span wire:loading.remove wire:target="goToPreviousLesson" class="flex items-center">
                <i class="fa-solid fa-arrow-left mr-2"></i>
                Previous
            </span>
        </button>

        <!-- Next Button -->
        <button wire:click="goToNextLesson" 
            wire:loading.attr="disabled" 
            wire:target="goToNextLesson, selectLesson"
            @disabled(!$nextLesson)
            class="inline-flex items-center px-5 py-2.5 text-sm font-semibold text-white bg-primary-600 hover:bg-primary-700 dark:bg-primary-600 dark:hover:bg-primary-700 rounded-lg transition-colors disabled:opacity-40 disabled:cursor-not-allowed">
            <span wire:loading wire:target="goToNextLesson" class="flex items-center">
                <i class="fa-solid fa-spinner fa-spin mr-2"></i>
                Loading...
            </span>
            <span wire:loading.remove wire:target="goToNextLesson" class="flex items-center">
                @if ($nextLesson)
                    Next
                    <i class="fa-solid fa-arrow-right ml-2"></i>
                @else
                    Course Complete
                    <i class="fa-solid fa-flag-checkered ml-2"></i>
                @endif
            </span>
        </button>
    </div>
</div>
