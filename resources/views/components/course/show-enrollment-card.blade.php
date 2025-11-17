@props(['course', 'enrollment_status', 'continueLearningLesson', 'isNewEnrollment'])

<div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 md:p-8">
    @if (!$enrollment_status)
        <div class="space-y-4">
            <h3 class="text-lg md:text-xl font-semibold text-gray-900 dark:text-white">Ready to start?</h3>
            <p class="text-sm text-gray-600 dark:text-gray-400">Enroll now to access all course content</p>
            <livewire:course.enrollment :course="$course" />
        </div>
    @else
        <div class="flex flex-col md:flex-row items-start md:items-center md:justify-between gap-4">
            <div class="flex items-center gap-3">
                <div class="flex items-center justify-center w-10 h-10 bg-green-50 dark:bg-green-900/20 rounded-lg flex-shrink-0">
                    <i class="fa-solid fa-check-circle text-green-600 dark:text-green-500"></i>
                </div>
                <div>
                    <p class="text-sm font-semibold text-gray-900 dark:text-white">Enrolled</p>
                    <p class="text-xs text-gray-600 dark:text-gray-400">You have access to this course</p>
                </div>
            </div>
            
            <div class="flex flex-wrap gap-3">
                @auth
                    @if ($continueLearningLesson)
                        <a href="{{ route('course-play', ['course' => $course, 'lesson' => $continueLearningLesson->id]) }}"
                            class="inline-flex items-center justify-center px-5 py-2.5 text-sm font-semibold text-white bg-primary-600 hover:bg-primary-700 dark:bg-primary-600 dark:hover:bg-primary-700 rounded-lg transition-colors">
                            @if ($isNewEnrollment)
                                <i class="fa-solid fa-play mr-2"></i> Start Learning
                            @else
                                <i class="fa-solid fa-redo mr-2"></i> Continue Learning
                            @endif
                        </a>
                        <a href="{{ route('course-chat', ['course' => $course]) }}"
                            class="inline-flex items-center justify-center px-5 py-2.5 text-sm font-semibold text-gray-700 dark:text-gray-300 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 rounded-lg transition-colors">
                            <i class="fa-solid fa-comments mr-2"></i> Chat
                        </a>
                    @endif
                @endauth
            </div>
        </div>
    @endif
</div>