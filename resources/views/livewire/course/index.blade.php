@php
    $fullWidth = true;
@endphp

<div class="min-h-screen bg-white dark:bg-gray-900 transition-colors duration-300">
    <!-- Courses Grid Section -->
    <div class="px-4 py-8 md:py-12 lg:py-16">
        <div class="max-w-7xl mx-auto">
            @if (!empty($courses) && $courses->count())
                <!-- Courses Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
                    @foreach ($courses as $course)
                        <x-course.card :course="$course" :is_pro="$is_pro" />
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8 md:mt-12">
                    {{ $courses->links() }}
                </div>
            @else
                <!-- Empty State -->
                <div class="max-w-md mx-auto">
                    <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-8 md:p-10 text-center">
                        <div class="flex items-center justify-center w-16 h-16 md:w-20 md:h-20 mx-auto mb-4 bg-primary-50 dark:bg-primary-900/20 rounded-full">
                            <i class="fa-solid fa-book text-2xl md:text-3xl text-primary-600 dark:text-primary-500"></i>
                        </div>
                        <h3 class="text-lg md:text-xl font-semibold text-gray-900 dark:text-white mb-2">
                            No Courses Available Yet
                        </h3>
                        <p class="text-sm md:text-base text-gray-600 dark:text-gray-400">
                            We are working on adding new courses. Please check back soon!
                        </p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
