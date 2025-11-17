@php
    $fullWidth = true;
@endphp

<div class="min-h-screen bg-white dark:bg-gray-900 transition-colors duration-300" x-data="{ sidebarOpen: false }" x-on:open-contents.window="sidebarOpen = true">
    <!-- Header -->
    <x-course.player-header :course="$course" />

    <!-- Main Layout -->
    <div class="flex">
        <!-- Desktop Sidebar -->
        <div class="hidden lg:block lg:w-80 xl:w-96 h-[calc(100vh-64px)] sticky top-16 border-r border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800">
            <x-course.lesson-sidebar :sections="$sections" :currentLesson="$currentLesson" :completedLessons="$completedLessons" />
        </div>

        <!-- Main Content Area -->
        <main class="flex-1 min-w-0">
            @if ($currentLesson)
                <div class="max-w-6xl mx-auto">
                    <!-- Video Player Section -->
                    <div class="bg-black">
                        <x-course.video-player :currentLesson="$currentLesson" />
                    </div>

                    <!-- Content Section -->
                    <div class="px-4 md:px-6 lg:px-8 py-6 md:py-8">
                        <!-- Lesson Title -->
                        <h1 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-6">
                            {{ $currentLesson->title }}
                        </h1>

                        <!-- Error Message -->
                        @if (session()->has('error'))
                            <div class="mb-6 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg flex items-start gap-3">
                                <i class="fa-solid fa-exclamation-triangle text-red-600 dark:text-red-400 mt-0.5"></i>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-red-800 dark:text-red-200">Error</p>
                                    <p class="text-sm text-red-700 dark:text-red-300">{{ session('error') }}</p>
                                </div>
                            </div>
                        @endif

                        <!-- Lesson Navigation Controls -->
                        <x-course.lesson-navigation :currentLesson="$currentLesson" :completedLessons="$completedLessons" :nextLesson="$nextLesson" :previousLesson="$previousLesson" />

                        <!-- Lesson Content -->
                        @if ($currentLesson->content)
                            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 md:p-8 mb-8">
                                <div class="flex items-center gap-3 mb-6">
                                    <div class="flex items-center justify-center w-10 h-10 bg-primary-50 dark:bg-primary-900/20 rounded-lg">
                                        <i class="fa-solid fa-file-lines text-primary-600 dark:text-primary-500"></i>
                                    </div>
                                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Lesson Content</h2>
                                </div>
                                <div class="prose prose-sm md:prose-base dark:prose-invert max-w-none">
                                    {!! $currentLesson->content !!}
                                </div>
                            </div>
                        @endif

                        <!-- Lesson Comments -->
                        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 md:p-8">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="flex items-center justify-center w-10 h-10 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                                    <i class="fa-solid fa-comments text-blue-600 dark:text-blue-500"></i>
                                </div>
                                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Discussion</h2>
                            </div>
                            <livewire:course.lesson-comments :lesson="$currentLesson" :key="'comments' . $currentLesson->id" />
                        </div>
                    </div>
                </div>
            @else
                <div class="px-4 md:px-6 lg:px-8 py-12">
                    <x-course.lesson-placeholder :sections="$sections" />
                </div>
            @endif
        </main>
    </div>

    <!-- Mobile Sidebar Overlay -->
    <div x-show="sidebarOpen" x-transition.opacity 
        class="fixed inset-0 z-40 bg-black/60 backdrop-blur-sm lg:hidden" 
        x-on:click="sidebarOpen = false"
        x-cloak></div>
    
    <!-- Mobile Sidebar -->
    <div x-show="sidebarOpen" 
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full"
        class="fixed inset-y-0 right-0 z-50 w-full max-w-sm bg-white dark:bg-gray-800 shadow-2xl overflow-y-auto lg:hidden"
        x-cloak>
        <div class="sticky top-0 z-10 flex items-center justify-between p-4 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Course Content</h2>
            <button class="p-2 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors" 
                x-on:click="sidebarOpen = false">
                <i class="fa-solid fa-times text-xl"></i>
            </button>
        </div>
        <div class="p-4">
            <x-course.lesson-sidebar :sections="$sections" :currentLesson="$currentLesson" :completedLessons="$completedLessons" />
        </div>
    </div>
</div>
