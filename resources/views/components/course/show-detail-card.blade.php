<!-- Course Image -->
@if ($course->getFirstMediaUrl('image'))
<div class="mb-6 md:mb-8 overflow-hidden rounded-xl">
    <img src="{{ $course->getFirstMediaUrl('image') }}" alt="{{ $course->name }}"
        class="object-cover w-full h-48 md:h-64 lg:h-80">
</div>
@else
<div class="mb-6 md:mb-8 bg-gradient-to-br from-primary-50 to-primary-100 dark:from-primary-900/20 dark:to-primary-800/20 rounded-xl h-48 md:h-64 flex items-center justify-center">
    <i class="fa-solid fa-book-open text-5xl md:text-6xl text-primary-300 dark:text-primary-700"></i>
</div>
@endif

<!-- Course Description -->
<div class="mb-6 md:mb-8">
    <h2 class="text-xl md:text-2xl font-semibold text-gray-900 dark:text-white mb-4">About This Course</h2>
    <p class="text-base md:text-lg leading-relaxed text-gray-600 dark:text-gray-400">{{ $course->description }}</p>
</div>

<!-- Course Details Card -->
<div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 md:p-8">
    <h2 class="text-xl md:text-2xl font-semibold text-gray-900 dark:text-white mb-6">Course Details</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <div class="space-y-4">
            @if ($course->rating)
            <div class="flex items-center gap-3">
                <div class="flex items-center justify-center w-10 h-10 bg-yellow-50 dark:bg-yellow-900/20 rounded-lg flex-shrink-0">
                    <i class="fa-solid fa-star text-yellow-500 dark:text-yellow-400"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <span class="block text-xs text-gray-500 dark:text-gray-400">Rating</span>
                    <span class="block text-sm font-medium text-gray-900 dark:text-white">
                        {{ number_format($course->rating, 1) }}/5
                    </span>
                </div>
            </div>
            @endif

            <div class="flex items-center gap-3">
                <div class="flex items-center justify-center w-10 h-10 bg-primary-50 dark:bg-primary-900/20 rounded-lg flex-shrink-0">
                    <i class="fa-solid fa-clock text-primary-600 dark:text-primary-500"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <span class="block text-xs text-gray-500 dark:text-gray-400">Duration</span>
                    <span class="block text-sm font-medium text-gray-900 dark:text-white">
                        {{ $course->duration }} minutes
                    </span>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <div class="flex items-center justify-center w-10 h-10 bg-purple-50 dark:bg-purple-900/20 rounded-lg flex-shrink-0">
                    <i class="fa-solid fa-calendar text-purple-600 dark:text-purple-500"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <span class="block text-xs text-gray-500 dark:text-gray-400">Start Date</span>
                    <span class="block text-sm font-medium text-gray-900 dark:text-white">
                        {{ \Carbon\Carbon::parse($course->start_date)->format('M d, Y') }}
                    </span>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <div class="flex items-center justify-center w-10 h-10 bg-purple-50 dark:bg-purple-900/20 rounded-lg flex-shrink-0">
                    <i class="fa-solid fa-calendar-check text-purple-600 dark:text-purple-500"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <span class="block text-xs text-gray-500 dark:text-gray-400">End Date</span>
                    <span class="block text-sm font-medium text-gray-900 dark:text-white">
                        {{ \Carbon\Carbon::parse($course->end_date)->format('M d, Y') }}
                    </span>
                </div>
            </div>
        </div>

        <div class="space-y-4">
            <div class="flex items-center gap-3">
                <div class="flex items-center justify-center w-10 h-10 bg-teal-50 dark:bg-teal-900/20 rounded-lg flex-shrink-0">
                    <i class="fa-solid fa-signal text-teal-600 dark:text-teal-500"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <span class="block text-xs text-gray-500 dark:text-gray-400">Level</span>
                    <span class="block text-sm font-medium text-gray-900 dark:text-white capitalize">
                        {{ ucfirst($course->level->value) }}
                    </span>
                </div>
            </div>

            @if ($course->enrollment_limit)
            <div class="flex items-center gap-3">
                <div class="flex items-center justify-center w-10 h-10 bg-orange-50 dark:bg-orange-900/20 rounded-lg flex-shrink-0">
                    <i class="fa-solid fa-users text-orange-600 dark:text-orange-500"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <span class="block text-xs text-gray-500 dark:text-gray-400">Enrollment Limit</span>
                    <span class="block text-sm font-medium text-gray-900 dark:text-white">
                        {{ $course->enrollment_limit }}
                    </span>
                </div>
            </div>
            @endif

            <div class="flex items-center gap-3">
                <div class="flex items-center justify-center w-10 h-10 bg-indigo-50 dark:bg-indigo-900/20 rounded-lg flex-shrink-0">
                    <i class="fa-solid fa-chalkboard-user text-indigo-600 dark:text-indigo-500"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <span class="block text-xs text-gray-500 dark:text-gray-400">Instructor</span>
                    <a href="{{ route('user.profile', ['username' => $course->instructor->username]) }}"
                        class="block text-sm font-semibold text-primary-600 dark:text-primary-500 hover:text-primary-700 dark:hover:text-primary-400 transition-colors">
                        {{ $course->instructor->name }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>