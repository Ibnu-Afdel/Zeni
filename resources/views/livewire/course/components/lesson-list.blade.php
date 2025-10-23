<div class="p-6 bg-white border border-gray-200 rounded-xl">
    <h3 class="mb-4 text-lg font-semibold text-gray-800">Course Content</h3>
    @forelse ($sections as $section)
        <div class="mb-3 rounded-lg border border-gray-200">
            <div x-data="{ open: false }" class="divide-y divide-gray-200">
                <button type="button" class="w-full flex items-center justify-between px-4 py-3 text-left hover:bg-gray-50"
                    x-on:click="open = !open">
                    <div class="min-w-0">
                        <h4 class="text-sm font-medium text-gray-900 truncate">{{ $section->title }}</h4>
                        <p class="mt-0.5 text-xs text-gray-500">{{ $section->lessons->count() }} lesson{{ $section->lessons->count() === 1 ? '' : 's' }}</p>
                    </div>
                    <svg class="w-5 h-5 text-gray-500 transition-transform" :class="{ 'rotate-180': open }" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                </button>
                <div x-show="open" x-collapse class="px-4 py-3 bg-white">
                    <ul class="ml-3 space-y-1 border-l-2 border-gray-200">
                        @foreach ($section->lessons as $lesson)
                            <li class="flex items-start text-sm text-gray-700">
                                <i class="mt-0.5 mr-2 text-gray-400 fas fa-play-circle"></i>
                                <span class="truncate">{{ $lesson->title }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @empty
        <p class="text-sm text-gray-500">No content available yet.</p>
    @endforelse
</div>
