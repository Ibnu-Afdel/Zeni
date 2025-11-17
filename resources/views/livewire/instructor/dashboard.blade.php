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
                        <i class="fa-solid fa-gauge text-primary-600 dark:text-primary-500"></i>
        Instructor Dashboard
    </h1>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Manage your courses and track your progress</p>
                </div>
        <a href="{{ route('instructor.courses.index') }}"
                    class="inline-flex items-center justify-center px-5 py-3 text-sm font-semibold text-white bg-primary-600 hover:bg-primary-700 dark:bg-primary-600 dark:hover:bg-primary-700 rounded-lg transition-colors">
                    <i class="fa-solid fa-list mr-2"></i>
                    Manage Courses
        </a>
    </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-7 gap-4 md:gap-6">
                <!-- Total Courses -->
                <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 hover:border-primary-300 dark:hover:border-primary-700 transition-colors">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center justify-center w-12 h-12 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                            <i class="fa-solid fa-book text-xl text-blue-600 dark:text-blue-500"></i>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $totalCourses }}</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Total Courses</p>
                </div>

                <!-- Published -->
                <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 hover:border-green-300 dark:hover:border-green-700 transition-colors">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center justify-center w-12 h-12 bg-green-50 dark:bg-green-900/20 rounded-lg">
                            <i class="fa-solid fa-check-circle text-xl text-green-600 dark:text-green-500"></i>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $publishedCourses }}</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Published</p>
                </div>

                <!-- Draft -->
                <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 hover:border-yellow-300 dark:hover:border-yellow-700 transition-colors">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center justify-center w-12 h-12 bg-yellow-50 dark:bg-yellow-900/20 rounded-lg">
                            <i class="fa-solid fa-file-pen text-xl text-yellow-600 dark:text-yellow-500"></i>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $inProgressCourses }}</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">In Draft</p>
                </div>

                <!-- Archived -->
                <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 hover:border-gray-400 dark:hover:border-gray-600 transition-colors">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center justify-center w-12 h-12 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <i class="fa-solid fa-box-archive text-xl text-gray-600 dark:text-gray-400"></i>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $archivedCourses }}</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Archived</p>
                </div>

                <!-- Premium Courses -->
                <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 hover:border-purple-300 dark:hover:border-purple-700 transition-colors">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center justify-center w-12 h-12 bg-purple-50 dark:bg-purple-900/20 rounded-lg">
                            <i class="fa-solid fa-crown text-xl text-purple-600 dark:text-purple-500"></i>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $premiumCourses }}</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Premium</p>
                </div>

                <!-- Total Students -->
                <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 hover:border-primary-300 dark:hover:border-primary-700 transition-colors">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center justify-center w-12 h-12 bg-primary-50 dark:bg-primary-900/20 rounded-lg">
                            <i class="fa-solid fa-users text-xl text-primary-600 dark:text-primary-500"></i>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $enrolledStudents }}</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Total Students</p>
                </div>

                <!-- Total Enrollments -->
                <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 hover:border-indigo-300 dark:hover:border-indigo-700 transition-colors">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center justify-center w-12 h-12 bg-indigo-50 dark:bg-indigo-900/20 rounded-lg">
                            <i class="fa-solid fa-user-check text-xl text-indigo-600 dark:text-indigo-500"></i>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $totalEnrollments }}</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Total Enrollments</p>
                </div>
            </div>

            <!-- Two Column Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 md:gap-8">
                <!-- Recent Courses -->
                <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 md:p-8">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center gap-3">
                            <div class="flex items-center justify-center w-10 h-10 bg-primary-50 dark:bg-primary-900/20 rounded-lg">
                                <i class="fa-solid fa-book-open text-primary-600 dark:text-primary-500"></i>
                            </div>
                            <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Recent Courses</h2>
                        </div>
                        <a href="{{ route('instructor.courses.index') }}" 
                            class="text-sm text-primary-600 dark:text-primary-500 hover:text-primary-700 dark:hover:text-primary-400 font-medium">
                            View All
                        </a>
        </div>

                    @if ($recentCourses->count() > 0)
                        <div class="space-y-3">
                            @foreach ($recentCourses as $course)
                                <a href="{{ route('course.detail', $course) }}" 
                                    class="flex items-center gap-3 p-3 bg-gray-50 dark:bg-gray-700/50 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors group">
                                    <div class="flex items-center justify-center w-10 h-10 bg-primary-100 dark:bg-primary-900/30 rounded-lg flex-shrink-0">
                                        <i class="fa-solid fa-book text-primary-600 dark:text-primary-500"></i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 dark:text-white truncate group-hover:text-primary-600 dark:group-hover:text-primary-500 transition-colors">
                                            {{ $course->name }}
                                        </p>
                                        <div class="flex items-center gap-2 mt-1">
                                            <span @class([
                                                'text-xs px-2 py-0.5 rounded-full',
                                                'bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400' => $course->status->value === 'published',
                                                'bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-400' => $course->status->value === 'draft',
                                                'bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400' => $course->status->value === 'archived',
                                            ])>
                                                {{ ucfirst($course->status->value) }}
                                            </span>
                                            @if ($course->is_pro)
                                                <span class="text-xs px-2 py-0.5 rounded-full bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-400">
                                                    <i class="fa-solid fa-crown mr-1"></i>Pro
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <i class="fa-solid fa-arrow-right text-gray-400 dark:text-gray-500 group-hover:text-primary-600 dark:group-hover:text-primary-500 transition-colors"></i>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <i class="fa-solid fa-inbox text-4xl text-gray-300 dark:text-gray-600 mb-3"></i>
                            <p class="text-gray-500 dark:text-gray-400 mb-4">No courses yet</p>
                            <a href="{{ route('instructor.courses.create') }}" 
                                class="inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-primary-600 hover:bg-primary-700 dark:bg-primary-600 dark:hover:bg-primary-700 rounded-lg transition-colors">
                                <i class="fa-solid fa-plus mr-2"></i>
                                Create Your First Course
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Recent Enrollments -->
                <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 md:p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="flex items-center justify-center w-10 h-10 bg-green-50 dark:bg-green-900/20 rounded-lg">
                            <i class="fa-solid fa-user-plus text-green-600 dark:text-green-500"></i>
            </div>
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Recent Enrollments</h2>
        </div>

                    @if ($recentEnrollments->count() > 0)
                        <div class="space-y-3">
                            @foreach ($recentEnrollments as $enrollment)
                                <div class="flex items-center gap-3 p-3 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                                    <div class="flex items-center justify-center w-10 h-10 bg-primary-100 dark:bg-primary-900/30 rounded-full flex-shrink-0">
                                        <i class="fa-solid fa-user text-primary-600 dark:text-primary-500"></i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 dark:text-white truncate">
                                            {{ $enrollment->user->name }}
                                        </p>
                                        <p class="text-xs text-gray-600 dark:text-gray-400 truncate">
                                            {{ $enrollment->course->name }}
                                        </p>
                                    </div>
                                    <span class="text-xs text-gray-500 dark:text-gray-400 whitespace-nowrap">
                                        {{ $enrollment->created_at->diffForHumans() }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <i class="fa-solid fa-user-group text-4xl text-gray-300 dark:text-gray-600 mb-3"></i>
                            <p class="text-gray-500 dark:text-gray-400">No enrollments yet</p>
                        </div>
                    @endif
                </div>
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
                    <a href="{{ route('instructor.courses.create') }}" 
                        class="flex items-center gap-3 p-4 bg-primary-50 dark:bg-primary-900/20 hover:bg-primary-100 dark:hover:bg-primary-900/30 rounded-lg transition-colors group">
                        <div class="flex items-center justify-center w-10 h-10 bg-white dark:bg-gray-800 rounded-lg flex-shrink-0">
                            <i class="fa-solid fa-plus text-primary-600 dark:text-primary-500"></i>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-900 dark:text-white">Create Course</p>
                            <p class="text-xs text-gray-600 dark:text-gray-400">Start a new course</p>
                        </div>
                    </a>

                    <a href="{{ route('instructor.courses.index') }}" 
                        class="flex items-center gap-3 p-4 bg-blue-50 dark:bg-blue-900/20 hover:bg-blue-100 dark:hover:bg-blue-900/30 rounded-lg transition-colors group">
                        <div class="flex items-center justify-center w-10 h-10 bg-white dark:bg-gray-800 rounded-lg flex-shrink-0">
                            <i class="fa-solid fa-list text-blue-600 dark:text-blue-500"></i>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-900 dark:text-white">All Courses</p>
                            <p class="text-xs text-gray-600 dark:text-gray-400">View all courses</p>
                        </div>
                    </a>

                    <a href="{{ route('user.profile', ['username' => auth()->user()->username]) }}" 
                        class="flex items-center gap-3 p-4 bg-purple-50 dark:bg-purple-900/20 hover:bg-purple-100 dark:hover:bg-purple-900/30 rounded-lg transition-colors group">
                        <div class="flex items-center justify-center w-10 h-10 bg-white dark:bg-gray-800 rounded-lg flex-shrink-0">
                            <i class="fa-solid fa-user text-purple-600 dark:text-purple-500"></i>
           </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-900 dark:text-white">My Profile</p>
                            <p class="text-xs text-gray-600 dark:text-gray-400">View your profile</p>
       </div>
                    </a>

                    <a href="{{ route('courses.index') }}" 
                        class="flex items-center gap-3 p-4 bg-green-50 dark:bg-green-900/20 hover:bg-green-100 dark:hover:bg-green-900/30 rounded-lg transition-colors group">
                        <div class="flex items-center justify-center w-10 h-10 bg-white dark:bg-gray-800 rounded-lg flex-shrink-0">
                            <i class="fa-solid fa-globe text-green-600 dark:text-green-500"></i>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-900 dark:text-white">Browse All</p>
                            <p class="text-xs text-gray-600 dark:text-gray-400">Explore courses</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
