<header class="sticky top-0 z-30 bg-white/95 dark:bg-gray-800/95 backdrop-blur-md border-b border-gray-200 dark:border-gray-700 transition-colors duration-300">
    <div class="flex items-center justify-between px-4 py-4">
        <!-- Back Button -->
        <a href="{{ route('course.detail', ['course' => $course]) }}"
            class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-500 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
            <i class="fa-solid fa-arrow-left mr-2"></i>
            <span class="hidden sm:inline">Back to Course</span>
            <span class="sm:hidden">Back</span>
        </a>

        <!-- Course Title (Center) -->
        <h1 class="flex-1 mx-4 text-base md:text-lg font-semibold text-center text-gray-900 dark:text-white truncate">
            {{ $course->name }}
        </h1>

        <!-- Mobile Menu Button -->
        <button type="button" 
            class="lg:hidden inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 dark:bg-primary-600 dark:hover:bg-primary-700 rounded-lg transition-colors"
            x-on:click="$dispatch('open-contents')">
            <i class="fa-solid fa-list mr-2"></i>
            <span>Lessons</span>
        </button>

        <!-- Spacer for desktop -->
        <div class="hidden lg:block w-24"></div>
    </div>
</header>
