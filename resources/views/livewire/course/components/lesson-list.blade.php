<div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 md:p-8">
    <div class="flex items-center gap-3 mb-6">
        <div class="flex items-center justify-center w-10 h-10 bg-primary-50 dark:bg-primary-900/20 rounded-lg flex-shrink-0">
            <i class="fa-solid fa-list text-primary-600 dark:text-primary-500"></i>
        </div>
        <h3 class="text-xl md:text-2xl font-semibold text-gray-900 dark:text-white">Course Content</h3>
    </div>
    
    @forelse ($sections as $section)
        <div class="mb-3 rounded-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div x-data="{ open: false }">
                <button type="button" class="w-full flex items-center justify-between px-4 py-3 text-left bg-gray-50 dark:bg-gray-700/50 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors"
                    x-on:click="open = !open">
                    <div class="min-w-0 flex-1">
                        <h4 class="text-sm md:text-base font-medium text-gray-900 dark:text-white truncate">{{ $section->title }}</h4>
                        <p class="mt-0.5 text-xs text-gray-500 dark:text-gray-400">{{ $section->lessons->count() }} lesson{{ $section->lessons->count() === 1 ? '' : 's' }}</p>
                    </div>
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400 transition-transform flex-shrink-0" :class="{ 'rotate-180': open }" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                </button>
                <div x-show="open" x-collapse class="px-4 py-3 bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
                    <ul class="ml-3 space-y-2 border-l-2 border-primary-200 dark:border-primary-800">
                        @foreach ($section->lessons as $lesson)
                            <li class="flex items-start text-sm text-gray-700 dark:text-gray-300 pl-3">
                                <i class="mt-0.5 mr-2 text-primary-500 dark:text-primary-400 fa-solid fa-play-circle"></i>
                                <span class="flex-1">{{ $lesson->title }}</span>
                                @if ($lesson->duration)
                                    <span class="text-xs text-gray-500 dark:text-gray-400 ml-2 whitespace-nowrap">{{ $lesson->duration }}m</span>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @empty
        <div class="text-center py-8">
            <i class="fa-solid fa-inbox text-3xl text-gray-300 dark:text-gray-600 mb-2"></i>
            <p class="text-sm text-gray-500 dark:text-gray-400">No content available yet.</p>
        </div>
    @endforelse
</div>
