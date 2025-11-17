<!-- Back Button -->
<div class="mb-4">
    <a href="{{ route('courses.index') }}"
        class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-500 transition-colors">
        <i class="fa-solid fa-arrow-left mr-2"></i>
        Back to Courses
    </a>
</div>

<!-- Course Title -->
<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
    <div class="flex flex-wrap items-center gap-3">
        <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white">
            {{ $course->name }}
        </h1>

        @if ($course->is_pro)
            <span class="inline-flex items-center px-3 py-1 text-xs md:text-sm font-semibold bg-yellow-500 dark:bg-yellow-600 text-white rounded-lg">
                <i class="fa-solid fa-crown mr-1.5"></i>
                Premium
            </span>
        @endif
    </div>

    @if ($isInstructor)
        <a href="{{ route('instructor.courses.manage_content', $course) }}"
            class="inline-flex items-center justify-center px-4 py-2 text-sm font-semibold bg-primary-600 hover:bg-primary-700 text-white rounded-lg transition-colors">
            <i class="fa-solid fa-edit mr-2"></i>
            Manage Content
        </a>
    @endif
</div>