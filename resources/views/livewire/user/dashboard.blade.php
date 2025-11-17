@php
    $fullWidth = true;
@endphp

<div class="min-h-screen bg-white dark:bg-gray-900 transition-colors duration-300">
    <div class="px-4 py-8 md:py-12">
        <div class="max-w-7xl mx-auto space-y-8">
            <!-- Header -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white flex items-center gap-3">
                        <i class="fa-solid fa-user-graduate text-primary-600 dark:text-primary-500"></i>
                        Student Dashboard
                    </h1>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Track your learning progress and manage your courses</p>
                </div>
                <a href="{{ route('courses.index') }}"
                    class="inline-flex items-center justify-center px-5 py-3 text-sm font-semibold text-white bg-primary-600 hover:bg-primary-700 dark:bg-primary-600 dark:hover:bg-primary-700 rounded-lg transition-colors">
                    <i class="fa-solid fa-book mr-2"></i>
                    Browse Courses
                </a>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
                <!-- Total Enrolled -->
                <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 hover:border-primary-300 dark:hover:border-primary-700 transition-colors">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center justify-center w-12 h-12 bg-primary-50 dark:bg-primary-900/20 rounded-lg">
                            <i class="fa-solid fa-book-open text-xl text-primary-600 dark:text-primary-500"></i>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $totalEnrolled }}</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Total Enrolled</p>
                </div>

                <!-- In Progress -->
                <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 hover:border-blue-300 dark:hover:border-blue-700 transition-colors">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center justify-center w-12 h-12 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                            <i class="fa-solid fa-spinner text-xl text-blue-600 dark:text-blue-500"></i>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $totalInProgress }}</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">In Progress</p>
                </div>

                <!-- Completed -->
                <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 hover:border-green-300 dark:hover:border-green-700 transition-colors">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center justify-center w-12 h-12 bg-green-50 dark:bg-green-900/20 rounded-lg">
                            <i class="fa-solid fa-check-circle text-xl text-green-600 dark:text-green-500"></i>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $totalCompleted }}</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Completed</p>
                </div>
            </div>

            <!-- In Progress Courses -->
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 md:p-8">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-3">
                        <div class="flex items-center justify-center w-10 h-10 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                            <i class="fa-solid fa-spinner text-blue-600 dark:text-blue-500"></i>
                        </div>
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white">In Progress Courses</h2>
                    </div>
                    @if($inProgressCourses->count() > 0)
                        <a href="{{ route('courses.index') }}" 
                            class="text-sm text-primary-600 dark:text-primary-500 hover:text-primary-700 dark:hover:text-primary-400 font-medium">
                            View All
                        </a>
                    @endif
                </div>

                @if($inProgressCourses->count())
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach($inProgressCourses as $course)
                            @livewire('user.course-card', ['course' => $course], key($course->id))
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <div class="flex items-center justify-center w-16 h-16 bg-blue-50 dark:bg-blue-900/20 rounded-full mx-auto mb-4">
                            <i class="fa-solid fa-spinner text-2xl text-blue-600 dark:text-blue-500"></i>
                        </div>
                        <p class="text-gray-500 dark:text-gray-400 mb-4">No courses in progress yet</p>
                        <a href="{{ route('courses.index') }}" 
                            class="inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-primary-600 hover:bg-primary-700 dark:bg-primary-600 dark:hover:bg-primary-700 rounded-lg transition-colors">
                            <i class="fa-solid fa-book mr-2"></i>
                            Browse Courses
                        </a>
                    </div>
                @endif
            </div>

            <!-- Completed Courses -->
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 md:p-8">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-3">
                        <div class="flex items-center justify-center w-10 h-10 bg-green-50 dark:bg-green-900/20 rounded-lg">
                            <i class="fa-solid fa-check-circle text-green-600 dark:text-green-500"></i>
                        </div>
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Completed Courses</h2>
                    </div>
                    @if($completedCourses->count() > 0)
                        <a href="{{ route('courses.index') }}" 
                            class="text-sm text-primary-600 dark:text-primary-500 hover:text-primary-700 dark:hover:text-primary-400 font-medium">
                            View All
                        </a>
                    @endif
                </div>

                @if($completedCourses->count())
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach($completedCourses as $course)
                            @livewire('user.course-card', ['course' => $course], key($course->id))
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <div class="flex items-center justify-center w-16 h-16 bg-green-50 dark:bg-green-900/20 rounded-full mx-auto mb-4">
                            <i class="fa-solid fa-check-circle text-2xl text-green-600 dark:text-green-500"></i>
                        </div>
                        <p class="text-gray-500 dark:text-gray-400 mb-4">No completed courses yet</p>
                        <a href="{{ route('courses.index') }}" 
                            class="inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-primary-600 hover:bg-primary-700 dark:bg-primary-600 dark:hover:bg-primary-700 rounded-lg transition-colors">
                            <i class="fa-solid fa-book mr-2"></i>
                            Browse Courses
                        </a>
                    </div>
                @endif
            </div>

            <!-- Quick Actions -->
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 md:p-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="flex items-center justify-center w-10 h-10 bg-primary-50 dark:bg-primary-900/20 rounded-lg">
                        <i class="fa-solid fa-bolt text-primary-600 dark:text-primary-500"></i>
                    </div>
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Quick Actions</h2>
                </div>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <a href="{{ route('courses.index') }}" 
                        class="flex items-center gap-3 p-4 bg-primary-50 dark:bg-primary-900/20 hover:bg-primary-100 dark:hover:bg-primary-900/30 rounded-lg transition-colors group">
                        <div class="flex items-center justify-center w-10 h-10 bg-white dark:bg-gray-800 rounded-lg flex-shrink-0">
                            <i class="fa-solid fa-book text-primary-600 dark:text-primary-500"></i>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-900 dark:text-white">Browse Courses</p>
                            <p class="text-xs text-gray-600 dark:text-gray-400">Explore all courses</p>
                        </div>
                    </a>

                    <a href="{{ route('user.profile', ['username' => auth()->user()->username]) }}" 
                        class="flex items-center gap-3 p-4 bg-blue-50 dark:bg-blue-900/20 hover:bg-blue-100 dark:hover:bg-blue-900/30 rounded-lg transition-colors group">
                        <div class="flex items-center justify-center w-10 h-10 bg-white dark:bg-gray-800 rounded-lg flex-shrink-0">
                            <i class="fa-solid fa-user text-blue-600 dark:text-blue-500"></i>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-900 dark:text-white">My Profile</p>
                            <p class="text-xs text-gray-600 dark:text-gray-400">View your profile</p>
                        </div>
                    </a>

                    <a href="{{ route('courses.index') }}" 
                        class="flex items-center gap-3 p-4 bg-green-50 dark:bg-green-900/20 hover:bg-green-100 dark:hover:bg-green-900/30 rounded-lg transition-colors group">
                        <div class="flex items-center justify-center w-10 h-10 bg-white dark:bg-gray-800 rounded-lg flex-shrink-0">
                            <i class="fa-solid fa-graduation-cap text-green-600 dark:text-green-500"></i>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-900 dark:text-white">Continue Learning</p>
                            <p class="text-xs text-gray-600 dark:text-gray-400">Resume your courses</p>
                        </div>
                    </a>

                    <a href="{{ route('courses.index') }}" 
                        class="flex items-center gap-3 p-4 bg-purple-50 dark:bg-purple-900/20 hover:bg-purple-100 dark:hover:bg-purple-900/30 rounded-lg transition-colors group">
                        <div class="flex items-center justify-center w-10 h-10 bg-white dark:bg-gray-800 rounded-lg flex-shrink-0">
                            <i class="fa-solid fa-star text-purple-600 dark:text-purple-500"></i>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-900 dark:text-white">Discover</p>
                            <p class="text-xs text-gray-600 dark:text-gray-400">Find new courses</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
