<div class="sticky top-0 z-20 bg-white/80 backdrop-blur border-b border-gray-200">
    <div class="flex items-center justify-between px-4 py-3">
        <a href="{{ route('course.detail', ['course' => $course]) }}"
            class="inline-flex items-center text-sm font-medium text-gray-700 transition hover:text-gray-900">
            <i class="mr-2 text-gray-500 fas fa-arrow-left"></i>
            Back
        </a>
        <h1 class="flex-1 mx-3 text-base font-semibold text-center text-gray-800 truncate sm:text-lg md:text-xl">
            {{ $course->name }}
        </h1>
        <button type="button" class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-white rounded-md shadow-sm md:hidden bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
            x-on:click="$dispatch('open-contents')">
            <i class="mr-2 fas fa-list-ul"></i>
            Contents
        </button>
        <span class="hidden md:inline-flex w-[90px]"></span>
    </div>
</div>

