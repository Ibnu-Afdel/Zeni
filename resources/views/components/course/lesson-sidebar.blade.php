<aside class="h-full overflow-y-auto">
    <div class="p-4">
        <h2 class="flex items-center gap-2 mb-6 text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
            <i class="fa-solid fa-list"></i>
            Course Content
        </h2>

        @if ($sections->isEmpty())
            <div class="text-center py-8">
                <i class="fa-solid fa-inbox text-3xl text-gray-300 dark:text-gray-600 mb-2"></i>
                <p class="text-sm text-gray-500 dark:text-gray-400">No content available yet.</p>
            </div>
        @else
            <div class="space-y-6">
                @foreach ($sections as $section)
                    <div wire:key="section-{{ $section->id }}">
                        <!-- Section Header -->
                        <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-3 px-2">
                            {{ $section->title }}
                        </h3>

                        <!-- Lessons List -->
                        <ul class="space-y-1 border-l-2 border-gray-200 dark:border-gray-700 ml-2">
                            @forelse ($section->lessons as $lesson)
                                <li wire:key="lesson-{{ $lesson->id }}"
                                    wire:click="selectLesson({{ $lesson->id }})"
                                    wire:loading.class="opacity-50 cursor-wait"
                                    wire:target="selectLesson({{ $lesson->id }})"
                                    @class([
                                        'relative flex items-start gap-3 px-3 py-3 -ml-0.5 rounded-r-lg cursor-pointer transition-all duration-150 group',
                                        'bg-primary-50 dark:bg-primary-900/20 border-l-2 border-primary-600 dark:border-primary-500 text-primary-900 dark:text-primary-100 font-semibold' => $currentLesson && $currentLesson->id === $lesson->id,
                                        'hover:bg-gray-100 dark:hover:bg-gray-700/50 text-gray-700 dark:text-gray-300' => !($currentLesson && $currentLesson->id === $lesson->id),
                                        'text-green-700 dark:text-green-400' => in_array($lesson->id, $completedLessons) && !($currentLesson && $currentLesson->id === $lesson->id),
                                    ])>

                                    <!-- Icon -->
                                    <div class="flex-shrink-0 mt-0.5">
                                        @if ($currentLesson && $currentLesson->id === $lesson->id)
                                            <i class="fa-solid fa-play-circle text-primary-600 dark:text-primary-500"></i>
                                        @elseif (in_array($lesson->id, $completedLessons))
                                            <i class="fa-solid fa-check-circle text-green-600 dark:text-green-500"></i>
                                        @else
                                            <i class="fa-regular fa-circle text-gray-400 dark:text-gray-600 group-hover:text-gray-500 dark:group-hover:text-gray-500"></i>
                                        @endif
                                    </div>

                                    <!-- Lesson Title -->
                                    <span class="flex-1 text-sm leading-tight line-clamp-2">
                                        {{ $lesson->title }}
                                    </span>

                                    <!-- Loading Spinner -->
                                    <div wire:loading wire:target="selectLesson({{ $lesson->id }})" class="flex-shrink-0">
                                        <i class="fa-solid fa-spinner fa-spin text-primary-600 dark:text-primary-500"></i>
                                    </div>
                                </li>
                            @empty
                                <li class="px-3 py-2 text-xs italic text-gray-400 dark:text-gray-600">
                                    No lessons in this section.
                                </li>
                            @endforelse
                        </ul>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</aside>
