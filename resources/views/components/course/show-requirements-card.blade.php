@if ($course->requirements)
    <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 md:p-8">
        <div class="flex items-center gap-3 mb-4">
            <div class="flex items-center justify-center w-10 h-10 bg-primary-50 dark:bg-primary-900/20 rounded-lg flex-shrink-0">
                <i class="fa-solid fa-clipboard-list text-primary-600 dark:text-primary-500"></i>
            </div>
            <h2 class="text-xl md:text-2xl font-semibold text-gray-900 dark:text-white">
                Requirements
            </h2>
        </div>
        <div class="prose prose-sm dark:prose-invert max-w-none text-gray-600 dark:text-gray-400">
            {!! nl2br(e($course->requirements)) !!}
        </div>
    </div>
@endif