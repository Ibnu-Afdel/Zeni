@php
    $fullWidth = true;
@endphp

<div class="min-h-screen bg-white dark:bg-gray-900 transition-colors duration-300">
    <!-- Hero Section -->
    <section class="relative px-4 py-16 md:py-24 lg:py-32">
        <div class="max-w-7xl mx-auto">
            <div class="text-center space-y-6 md:space-y-8">
                <!-- Icon Badge -->
                <div class="flex justify-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 md:w-20 md:h-20 bg-primary-50 dark:bg-primary-900/20 rounded-2xl">
                        <i class="fa-solid fa-graduation-cap text-3xl md:text-4xl text-primary-600 dark:text-primary-500"></i>
                    </div>
                </div>

                <!-- Main Heading -->
                <div class="space-y-3 md:space-y-4">
                    <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold text-gray-900 dark:text-white leading-tight">
                        Welcome to <span class="text-primary-600 dark:text-primary-500">Zeni</span>
                    </h1>
                    <p class="text-base md:text-lg lg:text-xl text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                        Your gateway to quality education, anytime, anywhere. Learn from the best instructors and grow your skills.
                    </p>
                </div>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row items-center justify-center gap-3 md:gap-4 pt-4">
                    <a href="{{ route('courses.index') }}"
                        class="w-full sm:w-auto inline-flex items-center justify-center px-6 md:px-8 py-3 md:py-3.5 text-sm md:text-base font-semibold text-white bg-primary-600 hover:bg-primary-700 dark:bg-primary-600 dark:hover:bg-primary-700 rounded-lg transition-colors duration-200">
                        <i class="fa-solid fa-book-open mr-2 text-white"></i>
                        Browse Courses
                    </a>
                    @auth
                        <a href="{{ route('user.dashboard') }}"
                            class="w-full sm:w-auto inline-flex items-center justify-center px-6 md:px-8 py-3 md:py-3.5 text-sm md:text-base font-semibold text-gray-700 dark:text-gray-300 bg-gray-100 hover:bg-gray-200 dark:bg-gray-800 dark:hover:bg-gray-700 rounded-lg transition-colors duration-200">
                            <i class="fa-solid fa-gauge mr-2 text-gray-700 dark:text-gray-300"></i>
                            Go to Dashboard
                        </a>
                    @else
                        <a href="{{ route('register') }}"
                            class="w-full sm:w-auto inline-flex items-center justify-center px-6 md:px-8 py-3 md:py-3.5 text-sm md:text-base font-semibold text-gray-700 dark:text-gray-300 bg-gray-100 hover:bg-gray-200 dark:bg-gray-800 dark:hover:bg-gray-700 rounded-lg transition-colors duration-200">
                            <i class="fa-solid fa-user-plus mr-2 text-gray-700 dark:text-gray-300"></i>
                            Get Started
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="px-4 py-12 md:py-16 lg:py-20 bg-gray-50 dark:bg-gray-800/50">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 lg:gap-8">
                <!-- Feature 1 -->
                <div class="bg-white dark:bg-gray-800 rounded-xl p-6 md:p-8 border border-gray-100 dark:border-gray-700 hover:border-primary-200 dark:hover:border-primary-800 transition-colors duration-200">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center w-12 h-12 bg-primary-50 dark:bg-primary-900/20 rounded-lg">
                                <i class="fa-solid fa-book text-xl text-primary-600 dark:text-primary-500"></i>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="text-lg md:text-xl font-semibold text-gray-900 dark:text-white mb-2">
                                Wide Course Selection
                            </h3>
                            <p class="text-sm md:text-base text-gray-600 dark:text-gray-400">
                                Access courses in tech, business, design, and more with expert instructors.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white dark:bg-gray-800 rounded-xl p-6 md:p-8 border border-gray-100 dark:border-gray-700 hover:border-primary-200 dark:hover:border-primary-800 transition-colors duration-200">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center w-12 h-12 bg-primary-50 dark:bg-primary-900/20 rounded-lg">
                                <i class="fa-solid fa-chalkboard-user text-xl text-primary-600 dark:text-primary-500"></i>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="text-lg md:text-xl font-semibold text-gray-900 dark:text-white mb-2">
                                Top Instructors
                            </h3>
                            <p class="text-sm md:text-base text-gray-600 dark:text-gray-400">
                                Learn from experienced professionals who understand your learning needs.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white dark:bg-gray-800 rounded-xl p-6 md:p-8 border border-gray-100 dark:border-gray-700 hover:border-primary-200 dark:hover:border-primary-800 transition-colors duration-200">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center w-12 h-12 bg-primary-50 dark:bg-primary-900/20 rounded-lg">
                                <i class="fa-solid fa-clock text-xl text-primary-600 dark:text-primary-500"></i>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="text-lg md:text-xl font-semibold text-gray-900 dark:text-white mb-2">
                                Flexible Learning
                            </h3>
                            <p class="text-sm md:text-base text-gray-600 dark:text-gray-400">
                                Study anytime, on any device, and track your progress seamlessly.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="px-4 py-12 md:py-16 lg:py-20">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-8">
                <!-- Stat 1 -->
                <div class="text-center">
                    <div class="flex items-center justify-center mb-3">
                        <i class="fa-solid fa-users text-2xl md:text-3xl text-primary-600 dark:text-primary-500"></i>
                    </div>
                    <div class="text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white mb-1">
                        1K+
                    </div>
                    <div class="text-xs md:text-sm text-gray-600 dark:text-gray-400">
                        Active Students
                    </div>
                </div>

                <!-- Stat 2 -->
                <div class="text-center">
                    <div class="flex items-center justify-center mb-3">
                        <i class="fa-solid fa-book-open text-2xl md:text-3xl text-primary-600 dark:text-primary-500"></i>
                    </div>
                    <div class="text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white mb-1">
                        50+
                    </div>
                    <div class="text-xs md:text-sm text-gray-600 dark:text-gray-400">
                        Courses
                    </div>
                </div>

                <!-- Stat 3 -->
                <div class="text-center">
                    <div class="flex items-center justify-center mb-3">
                        <i class="fa-solid fa-user-tie text-2xl md:text-3xl text-primary-600 dark:text-primary-500"></i>
                    </div>
                    <div class="text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white mb-1">
                        20+
                    </div>
                    <div class="text-xs md:text-sm text-gray-600 dark:text-gray-400">
                        Expert Instructors
                    </div>
                </div>

                <!-- Stat 4 -->
                <div class="text-center">
                    <div class="flex items-center justify-center mb-3">
                        <i class="fa-solid fa-star text-2xl md:text-3xl text-primary-600 dark:text-primary-500"></i>
                    </div>
                    <div class="text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white mb-1">
                        4.8
                    </div>
                    <div class="text-xs md:text-sm text-gray-600 dark:text-gray-400">
                        Average Rating
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
