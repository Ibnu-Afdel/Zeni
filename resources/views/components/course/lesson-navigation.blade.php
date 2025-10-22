<div class="mb-8 flex gap-3">
    @if (!in_array($currentLesson->id, $completedLessons))
        <button wire:click="markAsComplete" wire:loading.attr="disabled" wire:target="markAsComplete"
            class="inline-flex items-center px-6 py-2 text-white transition duration-150 ease-in-out rounded shadow-sm bg-emerald-500 hover:bg-emerald-600 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 disabled:opacity-75 disabled:cursor-not-allowed">
            <span wire:loading wire:target="markAsComplete" class="mr-2">
                <svg class="w-5 h-5 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>
            </span>
            <span wire:loading.remove wire:target="markAsComplete">
                <i class="mr-2 fas fa-check"></i>
            </span>
            Mark as Complete
        </button>
    @else
        <button wire:click="markAsIncomplete" wire:loading.attr="disabled" wire:target="markAsIncomplete"
            class="inline-flex items-center px-6 py-2 text-gray-700 transition duration-150 ease-in-out bg-white border border-gray-300 rounded shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2 disabled:opacity-75 disabled:cursor-not-allowed">
            <span wire:loading wire:target="markAsIncomplete" class="mr-2">
                <svg class="w-5 h-5 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>
            </span>
            <span wire:loading.remove wire:target="markAsIncomplete">
                <i class="mr-2 fas fa-undo"></i>
            </span>
            Mark as Incomplete
        </button>
    @endif
</div>

<div class="flex items-center justify-between pt-6 mt-8 border-t border-gray-200">
    <button wire:click="goToPreviousLesson" wire:loading.attr="disabled" wire:target="goToPreviousLesson, selectLesson"
        @disabled(!$previousLesson)
        class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 transition duration-150 ease-in-out bg-white border border-gray-300 rounded shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed">
        <div wire:loading wire:target="goToPreviousLesson" class="mr-2">
            <svg class="w-4 h-4 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor"
                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                </path>
            </svg>
        </div>
        <i class="mr-1 text-gray-500 fas fa-arrow-left fa-fw" wire:loading.remove wire:target="goToPreviousLesson"></i>
        Previous
    </button>

    <button wire:click="goToNextLesson" wire:loading.attr="disabled" wire:target="goToNextLesson, selectLesson"
        @disabled(!$nextLesson)
        class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition duration-150 ease-in-out bg-indigo-600 border border-transparent rounded shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed disabled:bg-indigo-400">
        <div wire:loading wire:target="goToNextLesson" class="mr-2">
            <svg class="w-4 h-4 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor"
                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                </path>
            </svg>
        </div>
        @if ($nextLesson)
            <span wire:loading.remove wire:target="goToNextLesson">Next</span>
            <i class="ml-1 fas fa-arrow-right fa-fw" wire:loading.remove wire:target="goToNextLesson"></i>
        @else
            <span wire:loading.remove wire:target="goToNextLesson">End of Course</span>
            <i class="ml-1 fas fa-flag-checkered fa-fw" wire:loading.remove wire:target="goToNextLesson"></i>
        @endif
    </button>
</div>

