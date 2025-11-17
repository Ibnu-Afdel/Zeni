<div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 md:p-8">
    <div class="flex items-center gap-3 mb-6">
        <div class="flex items-center justify-center w-10 h-10 bg-yellow-50 dark:bg-yellow-900/20 rounded-lg flex-shrink-0">
            <i class="fa-solid fa-star text-yellow-500 dark:text-yellow-400"></i>
        </div>
        <h3 class="text-xl md:text-2xl font-semibold text-gray-900 dark:text-white">Reviews</h3>
    </div>
    <livewire:course.review :course-id="$course->id" />
</div>
