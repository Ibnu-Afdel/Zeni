@php
    $fullWidth = true;
@endphp

<div class="min-h-screen bg-white dark:bg-gray-900 transition-colors duration-300">
    <div class="px-4 py-8 md:py-12">
        <div class="max-w-5xl mx-auto space-y-6">
            <!-- Profile Header Card -->
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl overflow-hidden">
                <!-- Banner -->
                <div @class([
                    'h-32 md:h-40',
                    'bg-gradient-to-r from-yellow-400 to-amber-500' => $user->is_pro,
                    'bg-gradient-to-r from-primary-500 to-primary-700' => !$user->is_pro,
                ])></div>
                
                <!-- Profile Info -->
                <div class="px-6 md:px-8 pb-6">
                    <div class="flex flex-col md:flex-row md:items-end md:justify-between -mt-16 md:-mt-20">
                        <!-- Avatar & Name -->
                        <div class="flex flex-col sm:flex-row sm:items-end gap-4">
                            <!-- Avatar -->
                            <div @class([
                                'flex items-center justify-center w-24 h-24 md:w-32 md:h-32 text-3xl md:text-4xl rounded-xl border-4 border-white dark:border-gray-800 shadow-lg',
                                'bg-gradient-to-br from-yellow-400 to-amber-500 text-white' => $user->is_pro,
                                'bg-primary-100 dark:bg-primary-900/20 text-primary-600 dark:text-primary-500' => !$user->is_pro,
                            ])>
                                <i class="fa-solid {{ $user->is_pro ? 'fa-crown' : 'fa-user' }}"></i>
                            </div>
                            
                            <!-- Name & Username -->
                            <div class="flex-1 min-w-0 pb-2">
                                <div class="flex flex-wrap items-center gap-2 mb-1">
                                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white">
                                        {{ $user->name }}
                                    </h1>
                                    @if ($user->is_pro)
                                        <span class="inline-flex items-center px-3 py-1 text-xs font-semibold bg-yellow-500 dark:bg-yellow-600 text-white rounded-lg">
                                            <i class="fa-solid fa-crown mr-1"></i> Pro Member
                                        </span>
                                    @endif
                                </div>
                                
                                <div class="flex flex-wrap items-center gap-3 text-sm text-gray-600 dark:text-gray-400">
                                    <span class="flex items-center">
                                        <i class="fa-solid fa-at mr-1.5"></i>
                                        {{ $user->username }}
                                    </span>
                                    <span class="flex items-center capitalize">
                                        <i class="fa-solid fa-user-tag mr-1.5"></i>
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Action Buttons (if viewing own profile) -->
                        @if (auth()->check() && auth()->id() === $user->id)
                            <div class="flex gap-2 mt-4 md:mt-0">
                                @if ($user->role === 'student' && !$application)
                                    <a href="{{ route('instructor.apply') }}"
                                        class="inline-flex items-center justify-center px-4 py-2 text-sm font-semibold text-gray-700 dark:text-gray-300 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 rounded-lg transition-colors">
                                        <i class="fa-solid fa-chalkboard-user mr-2"></i>
                                        Become Instructor
                                    </a>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Contact Information Card -->
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 md:p-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="flex items-center justify-center w-10 h-10 bg-primary-50 dark:bg-primary-900/20 rounded-lg">
                        <i class="fa-solid fa-envelope text-primary-600 dark:text-primary-500"></i>
                    </div>
                    <h2 class="text-xl md:text-2xl font-semibold text-gray-900 dark:text-white">Contact Information</h2>
                </div>
                
                <div class="space-y-3">
                    <div class="flex items-center gap-3 p-3 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                        <i class="fa-solid fa-envelope text-gray-400 dark:text-gray-500"></i>
                        <span class="text-sm md:text-base text-gray-700 dark:text-gray-300">{{ $user->email }}</span>
                    </div>
                </div>
            </div>

            <!-- Instructor Application Details (for approved instructors) -->
            @if ($user->role === 'instructor' && $application && $application->status === 'approved')
                <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 md:p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="flex items-center justify-center w-10 h-10 bg-primary-50 dark:bg-primary-900/20 rounded-lg">
                            <i class="fa-solid fa-id-card text-primary-600 dark:text-primary-500"></i>
                        </div>
                        <h2 class="text-xl md:text-2xl font-semibold text-gray-900 dark:text-white">Professional Information</h2>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @if (!empty($application->full_name))
                            <div class="flex items-start gap-3">
                                <i class="fa-solid fa-user-circle text-gray-400 dark:text-gray-500 mt-1"></i>
                                <div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Full Name</p>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $application->full_name }}</p>
                                </div>
                            </div>
                        @endif
                        
                        @if (!empty($application->email))
                            <div class="flex items-start gap-3">
                                <i class="fa-solid fa-envelope text-gray-400 dark:text-gray-500 mt-1"></i>
                                <div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Professional Email</p>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $application->email }}</p>
                                </div>
                            </div>
                        @endif
                        
                        @if (!empty($application->website))
                            <div class="flex items-start gap-3">
                                <i class="fa-solid fa-globe text-gray-400 dark:text-gray-500 mt-1"></i>
                                <div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Website</p>
                                    <a href="{{ $application->website }}" target="_blank" 
                                        class="text-sm font-medium text-primary-600 dark:text-primary-500 hover:underline">
                                        {{ $application->website }}
                                    </a>
                                </div>
                            </div>
                        @endif
                        
                        @if (!empty($application->linkedin))
                            <div class="flex items-start gap-3">
                                <i class="fa-brands fa-linkedin text-gray-400 dark:text-gray-500 mt-1"></i>
                                <div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">LinkedIn</p>
                                    <a href="{{ $application->linkedin }}" target="_blank" 
                                        class="text-sm font-medium text-primary-600 dark:text-primary-500 hover:underline">
                                        View Profile
                                    </a>
                                </div>
                            </div>
                        @endif
                        
                        @if (isset($application->highest_qualification) && $application->highest_qualification !== 'none')
                            <div class="flex items-start gap-3">
                                <i class="fa-solid fa-graduation-cap text-gray-400 dark:text-gray-500 mt-1"></i>
                                <div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Qualification</p>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white capitalize">{{ $application->highest_qualification }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Student Details (for own profile only) -->
            @if (auth()->check() && auth()->id() === $user->id && $user->role === 'student')
                <!-- Enrolled Courses -->
                <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 md:p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="flex items-center justify-center w-10 h-10 bg-primary-50 dark:bg-primary-900/20 rounded-lg">
                            <i class="fa-solid fa-book-open text-primary-600 dark:text-primary-500"></i>
                        </div>
                        <h2 class="text-xl md:text-2xl font-semibold text-gray-900 dark:text-white">Enrolled Courses</h2>
                    </div>
                    
                    @isset($enrolledCourses)
                        @if ($enrolledCourses->count() > 0)
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach ($enrolledCourses as $course)
                                    <a href="{{ route('course.detail', $course) }}" 
                                        class="flex items-center gap-3 p-4 bg-gray-50 dark:bg-gray-700/50 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors group">
                                        <div class="flex items-center justify-center w-10 h-10 bg-primary-100 dark:bg-primary-900/30 rounded-lg flex-shrink-0">
                                            <i class="fa-solid fa-book text-primary-600 dark:text-primary-500"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-900 dark:text-white truncate group-hover:text-primary-600 dark:group-hover:text-primary-500 transition-colors">
                                                {{ $course->name }}
                                            </p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                                {{ $course->lessons_count ?? 0 }} lessons
                                            </p>
                                        </div>
                                        <i class="fa-solid fa-arrow-right text-gray-400 dark:text-gray-500 group-hover:text-primary-600 dark:group-hover:text-primary-500 transition-colors"></i>
                                    </a>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8">
                                <i class="fa-solid fa-inbox text-4xl text-gray-300 dark:text-gray-600 mb-3"></i>
                                <p class="text-gray-500 dark:text-gray-400 mb-4">No courses enrolled yet</p>
                                <a href="{{ route('courses.index') }}" 
                                    class="inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-primary-600 hover:bg-primary-700 dark:bg-primary-600 dark:hover:bg-primary-700 rounded-lg transition-colors">
                                    <i class="fa-solid fa-search mr-2"></i>
                                    Browse Courses
                                </a>
                            </div>
                        @endif
                    @else
                        <p class="text-center text-gray-500 dark:text-gray-400 py-4">Enrolled course data not available.</p>
                    @endisset
                </div>

                <!-- Instructor Application Status -->
                <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 md:p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="flex items-center justify-center w-10 h-10 bg-purple-50 dark:bg-purple-900/20 rounded-lg">
                            <i class="fa-solid fa-chalkboard-user text-purple-600 dark:text-purple-500"></i>
                        </div>
                        <h2 class="text-xl md:text-2xl font-semibold text-gray-900 dark:text-white">Instructor Status</h2>
                    </div>
                    
                    @if ($application)
                        <div class="p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Application Status</span>
                                <span @class([
                                    'px-3 py-1 text-xs font-semibold rounded-lg',
                                    'bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-400' => $application->status === 'pending',
                                    'bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400' => $application->status === 'approved',
                                    'bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400' => $application->status === 'rejected',
                                ])>
                                    {{ ucfirst($application->status) }}
                                </span>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-6">
                            <p class="text-gray-600 dark:text-gray-400 mb-4">Share your knowledge and teach on our platform</p>
                            @if (Route::has('instructor.apply'))
                                <a href="{{ route('instructor.apply') }}"
                                    class="inline-flex items-center px-6 py-3 text-sm font-semibold text-white bg-primary-600 hover:bg-primary-700 dark:bg-primary-600 dark:hover:bg-primary-700 rounded-lg transition-colors">
                                    <i class="fa-solid fa-plus-circle mr-2"></i>
                                    Apply to Become an Instructor
                                </a>
                            @else
                                <p class="text-sm text-gray-500 dark:text-gray-400">Instructor applications are currently closed.</p>
                            @endif
                        </div>
                    @endif
                </div>
            @endif

            <!-- Instructor Details (for own profile only) -->
            @if (auth()->check() && auth()->id() === $user->id && $user->role === 'instructor')
                <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 md:p-8">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center gap-3">
                            <div class="flex items-center justify-center w-10 h-10 bg-primary-50 dark:bg-primary-900/20 rounded-lg">
                                <i class="fa-solid fa-chalkboard text-primary-600 dark:text-primary-500"></i>
                            </div>
                            <h2 class="text-xl md:text-2xl font-semibold text-gray-900 dark:text-white">My Courses</h2>
                        </div>
                        <a href="{{ route('instructor.courses.create') }}" 
                            class="inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-primary-600 hover:bg-primary-700 dark:bg-primary-600 dark:hover:bg-primary-700 rounded-lg transition-colors">
                            <i class="fa-solid fa-plus mr-2"></i>
                            Create Course
                        </a>
                    </div>
                    
                    @isset($instructorCourses)
                        @if ($instructorCourses->count() > 0)
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach ($instructorCourses as $course)
                                    <a href="{{ route('course.detail', $course) }}" 
                                        class="flex items-center gap-3 p-4 bg-gray-50 dark:bg-gray-700/50 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors group">
                                        <div class="flex items-center justify-center w-10 h-10 bg-primary-100 dark:bg-primary-900/30 rounded-lg flex-shrink-0">
                                            <i class="fa-solid fa-book text-primary-600 dark:text-primary-500"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-900 dark:text-white truncate group-hover:text-primary-600 dark:group-hover:text-primary-500 transition-colors">
                                                {{ $course->name }}
                                            </p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 capitalize">
                                                {{ $course->status }}
                                            </p>
                                        </div>
                                        <i class="fa-solid fa-arrow-right text-gray-400 dark:text-gray-500 group-hover:text-primary-600 dark:group-hover:text-primary-500 transition-colors"></i>
                                    </a>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8">
                                <i class="fa-solid fa-inbox text-4xl text-gray-300 dark:text-gray-600 mb-3"></i>
                                <p class="text-gray-500 dark:text-gray-400 mb-4">You haven't created any courses yet</p>
                                <a href="{{ route('instructor.courses.create') }}" 
                                    class="inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-primary-600 hover:bg-primary-700 dark:bg-primary-600 dark:hover:bg-primary-700 rounded-lg transition-colors">
                                    <i class="fa-solid fa-plus mr-2"></i>
                                    Create Your First Course
                                </a>
                            </div>
                        @endif
                    @else
                        <p class="text-center text-gray-500 dark:text-gray-400 py-4">Course data not available.</p>
                    @endisset
                </div>
            @endif

            <!-- Admin Badge -->
            @if (auth()->check() && auth()->id() === $user->id && $user->role === 'admin')
                <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 md:p-8">
                    <div class="flex items-center gap-3">
                        <div class="flex items-center justify-center w-10 h-10 bg-red-50 dark:bg-red-900/20 rounded-lg">
                            <i class="fa-solid fa-user-shield text-red-600 dark:text-red-500"></i>
                        </div>
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Administrator</h2>
                            <p class="text-sm text-gray-600 dark:text-gray-400">You have full administrative privileges</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Upgrade to Pro CTA (for non-pro users viewing own profile) -->
            @if (auth()->check() && auth()->id() === $user->id && !$user->is_pro)
                <div class="bg-gradient-to-br from-primary-600 to-primary-700 dark:from-primary-700 dark:to-primary-800 rounded-xl p-8 md:p-10 text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-white/20 rounded-full mb-4">
                        <i class="fa-solid fa-crown text-3xl text-white"></i>
                    </div>
                    <h3 class="text-2xl md:text-3xl font-bold text-white mb-3">Upgrade to Pro</h3>
                    <p class="text-primary-100 dark:text-primary-200 mb-6 max-w-lg mx-auto">
                        Get unlimited access to premium courses, priority support, and exclusive features
                    </p>
                    <a href="{{ route('subscribe.index') }}"
                        class="inline-flex items-center px-6 py-3 text-base font-semibold text-primary-700 bg-white hover:bg-gray-50 rounded-lg transition-colors shadow-lg">
                        Become Pro Now
                        <i class="fa-solid fa-arrow-right ml-2"></i>
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
