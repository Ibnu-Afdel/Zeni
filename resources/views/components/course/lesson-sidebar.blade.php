<aside
    class="w-full p-4 bg-white border-gray-200 md:sticky md:top-4 md:max-h-[calc(100vh-5rem)] md:overflow-y-auto md:border-r md:shadow-sm">
    <h2 class="flex items-center mb-4 text-xs font-semibold tracking-wider text-gray-500 uppercase md:text-sm">
        <i class="mr-2 text-gray-400 fas fa-list-ul"></i>
        Course Content
    </h2>
    @if ($sections->isEmpty())
        <p class="text-sm text-gray-500">No content available yet.</p>
    @else
        <div class="space-y-4 md:space-y-6">
            @foreach ($sections as $section)
                <div wire:key="section-{{ $section->id }}">
                    <h3 class="mb-2 text-sm font-semibold text-gray-800 md:text-base">{{ $section->title }}</h3>

                    <ul class="ml-1 space-y-0.5 md:space-y-1 border-l-2 border-gray-200">
                        @forelse ($section->lessons as $lesson)
                            <li wire:key="lesson-{{ $lesson->id }}"
                                wire:click="selectLesson({{ $lesson->id }})"
                                wire:loading.class="opacity-50 cursor-wait"
                                wire:target="selectLesson({{ $lesson->id }})"
                                class="flex items-center justify-between px-2 py-2 text-xs md:text-sm rounded-r cursor-pointer group transition duration-150 ease-in-out
                                {{ $currentLesson && $currentLesson->id === $lesson->id
                                    ? 'bg-indigo-100 text-indigo-800 font-semibold border-l-2 border-indigo-500 -ml-px'
                                    : 'text-gray-700 hover:bg-gray-100' }}
                                {{ in_array($lesson->id, $completedLessons) && !($currentLesson && $currentLesson->id === $lesson->id)
                                    ? 'text-green-700 hover:bg-green-50'
                                    : '' }}">

                                <span class="flex items-center">

                                    @if ($currentLesson && $currentLesson->id === $lesson->id)
                                        <i class="mr-2 text-indigo-600 fas fa-play-circle fa-fw"></i>
                                    @elseif (in_array($lesson->id, $completedLessons))
                                        <i class="mr-2 text-green-500 fas fa-check-circle fa-fw"></i>
                                    @else
                                        <i class="mr-2 text-gray-300 group-hover:text-gray-500 far fa-circle fa-fw"></i>
                                    @endif
                                    <span class="truncate max-w-[12rem] md:max-w-[16rem]">{{ $lesson->title }}</span>
                                </span>

                                <div wire:loading wire:target="selectLesson({{ $lesson->id }})">
                                    <svg class="w-4 h-4 text-indigo-500 animate-spin"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10"
                                            stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                        </path>
                                    </svg>
                                </div>
                            </li>
                        @empty
                            <li class="ml-3 text-xs italic text-gray-400">No lessons in this section.</li>
                        @endforelse
                    </ul>
                </div>
            @endforeach
        </div>
    @endif
</aside>

