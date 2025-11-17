@php
    $fullWidth = true;
@endphp

<div class="min-h-screen bg-white dark:bg-gray-900 transition-colors duration-300" x-data="{ openFilters: false }">
    <div class="px-4 py-8 md:py-12">
        <div class="max-w-7xl mx-auto space-y-6">
            <!-- Header -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white flex items-center gap-3">
                        <i class="fa-solid fa-book text-primary-600 dark:text-primary-500"></i>
                        My Courses
                    </h1>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Create and manage your courses</p>
                </div>
                <a href="{{ route('instructor.courses.create') }}"
                    class="inline-flex items-center justify-center px-5 py-3 text-sm font-semibold text-white bg-primary-600 hover:bg-primary-700 dark:bg-primary-600 dark:hover:bg-primary-700 rounded-lg transition-colors">
                    <i class="fa-solid fa-plus mr-2"></i>
                    Create New Course
                </a>
            </div>

            <!-- Success Message -->
            @if (session()->has('message'))
                <div class="p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg flex items-start gap-3">
                    <i class="fa-solid fa-circle-check text-green-600 dark:text-green-400 mt-0.5"></i>
                    <span class="text-sm text-green-700 dark:text-green-300">{{ session('message') }}</span>
                </div>
            @endif

            <!-- Filters -->
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-4 md:p-6">
                <div class="flex items-center justify-between mb-4 md:mb-0">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                        <i class="fa-solid fa-filter text-primary-600 dark:text-primary-500"></i>
                        Filters
                    </h2>
                    <button type="button" 
                        class="md:hidden inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-lg transition-colors"
                        x-on:click="openFilters = !openFilters">
                        <i class="fa-solid mr-2" :class="openFilters ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                        <span x-text="openFilters ? 'Hide' : 'Show'"></span>
                    </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4" 
                    :class="{ 'hidden md:grid': !openFilters, 'grid': openFilters }">
                    <!-- Status Filter -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            <i class="fa-solid fa-list-check mr-1.5"></i>
                            Status
                        </label>
                        <select wire:model.live="filterStatus" 
                            class="w-full px-4 py-2.5 text-gray-900 dark:text-white bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-500 focus:border-transparent transition-colors">
                            <option value="">All Statuses</option>
                            <option value="draft">Draft</option>
                            <option value="published">Published</option>
                            <option value="archived">Archived</option>
                        </select>
                    </div>

                    <!-- Level Filter -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            <i class="fa-solid fa-signal mr-1.5"></i>
                            Level
                        </label>
                        <select wire:model.live="filterLevel" 
                            class="w-full px-4 py-2.5 text-gray-900 dark:text-white bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-500 focus:border-transparent transition-colors">
                            <option value="">All Levels</option>
                            <option value="beginner">Beginner</option>
                            <option value="intermediate">Intermediate</option>
                            <option value="advanced">Advanced</option>
                        </select>
                    </div>

                    <!-- Premium Filter -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            <i class="fa-solid fa-crown mr-1.5"></i>
                            Premium
                        </label>
                        <select wire:model.live="filterPro" 
                            class="w-full px-4 py-2.5 text-gray-900 dark:text-white bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-500 focus:border-transparent transition-colors">
                            <option value="">All Courses</option>
                            <option value="1">Premium Only</option>
                            <option value="0">Free Only</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Courses Grid -->
            @if ($courses->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
                    @foreach ($courses as $course)
                        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl overflow-hidden hover:border-primary-300 dark:hover:border-primary-700 transition-colors">
                            <!-- Course Image or Placeholder -->
                            @if ($course->getFirstMediaUrl('image'))
                                <div class="w-full h-48 bg-gray-200 dark:bg-gray-700">
                                    <img src="{{ $course->getFirstMediaUrl('image') }}" 
                                        alt="{{ $course->name }}"
                                        class="w-full h-full object-cover">
                                </div>
                            @else
                                <div class="w-full h-48 bg-gradient-to-br from-primary-50 to-primary-100 dark:from-primary-900/20 dark:to-primary-800/20 flex items-center justify-center">
                                    <i class="fa-solid fa-book-open text-5xl text-primary-300 dark:text-primary-700"></i>
                                </div>
                            @endif

                            <!-- Course Info -->
                            <div class="p-5">
                                <!-- Badges -->
                                <div class="flex items-center gap-2 mb-3">
                                    <span @class([
                                        'text-xs font-semibold px-2 py-1 rounded-lg',
                                        'bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400' => $course->status->value === 'published',
                                        'bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-400' => $course->status->value === 'draft',
                                        'bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400' => $course->status->value === 'archived',
                                    ])>
                                        {{ ucfirst($course->status->value) }}
                                    </span>
                                    @if ($course->is_pro)
                                        <span class="text-xs font-semibold px-2 py-1 rounded-lg bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-400">
                                            <i class="fa-solid fa-crown mr-1"></i>Premium
                                        </span>
                                    @endif
                                </div>

                                <!-- Title & Description -->
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2 line-clamp-1">
                                    {{ $course->name }}
                                </h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400 line-clamp-2 mb-4">
                                    {{ $course->description }}
                                </p>

                                <!-- Level -->
                                @if ($course->level)
                                    <div class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400 mb-4">
                                        <i class="fa-solid fa-signal"></i>
                                        <span class="capitalize">{{ $course->level->value }}</span>
                                    </div>
                                @endif

                                <!-- Actions -->
                                <div class="flex flex-wrap gap-2">
                                    <a href="{{ route('instructor.courses.edit', $course) }}" 
                                        class="flex-1 inline-flex items-center justify-center px-3 py-2 text-xs font-semibold text-gray-700 dark:text-gray-300 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 rounded-lg transition-colors">
                                        <i class="fa-solid fa-edit mr-1.5"></i>
                                        Edit
                                    </a>
                                    <a href="{{ route('instructor.courses.manage_content', $course) }}" 
                                        class="flex-1 inline-flex items-center justify-center px-3 py-2 text-xs font-semibold text-white bg-primary-600 hover:bg-primary-700 dark:bg-primary-600 dark:hover:bg-primary-700 rounded-lg transition-colors">
                                        <i class="fa-solid fa-layer-group mr-1.5"></i>
                                        Content
                                    </a>
                                </div>

                                <div class="flex gap-2 mt-2">
                                    @if($course->status->value === 'draft')
                                        <button wire:click="publish({{ $course->id }})" 
                                            class="flex-1 inline-flex items-center justify-center px-3 py-2 text-xs font-semibold text-white bg-green-600 hover:bg-green-700 dark:bg-green-600 dark:hover:bg-green-700 rounded-lg transition-colors">
                                            <i class="fa-solid fa-upload mr-1.5"></i>
                                            Publish
                                        </button>
                                    @elseif($course->status->value === 'published')
                                        <button wire:click="unpublish({{ $course->id }})" 
                                            class="flex-1 inline-flex items-center justify-center px-3 py-2 text-xs font-semibold text-gray-700 dark:text-gray-300 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 rounded-lg transition-colors">
                                            <i class="fa-solid fa-undo mr-1.5"></i>
                                            Unpublish
                                        </button>
                                    @endif
                                    <button wire:click="confirmDelete({{ $course->id }})" 
                                        class="flex-1 inline-flex items-center justify-center px-3 py-2 text-xs font-semibold text-white bg-red-600 hover:bg-red-700 dark:bg-red-600 dark:hover:bg-red-700 rounded-lg transition-colors">
                                        <i class="fa-solid fa-trash mr-1.5"></i>
                                        Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-12 text-center">
                    <i class="fa-solid fa-inbox text-6xl text-gray-300 dark:text-gray-600 mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">No courses found</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-6">
                        @if ($filterStatus || $filterLevel || $filterPro !== null)
                            Try adjusting your filters or create a new course
                        @else
                            Start creating your first course to share your knowledge
                        @endif
                    </p>
                    <a href="{{ route('instructor.courses.create') }}" 
                        class="inline-flex items-center px-6 py-3 text-sm font-semibold text-white bg-primary-600 hover:bg-primary-700 dark:bg-primary-600 dark:hover:bg-primary-700 rounded-lg transition-colors">
                        <i class="fa-solid fa-plus mr-2"></i>
                        Create Your First Course
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    @if($confirmingDeleteId)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm">
            <div class="w-full max-w-md bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 shadow-2xl">
                <div class="flex items-center gap-3 mb-4">
                    <div class="flex items-center justify-center w-12 h-12 bg-red-100 dark:bg-red-900/30 rounded-full">
                        <i class="fa-solid fa-exclamation-triangle text-xl text-red-600 dark:text-red-500"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Delete Course</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">This action cannot be undone</p>
                    </div>
                </div>
                
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">
                    Are you sure you want to delete this course? All associated content, lessons, and enrollments will be permanently removed.
                </p>
                
                <div class="flex gap-3">
                    <button wire:click="cancelDelete" 
                        class="flex-1 px-4 py-2.5 text-sm font-semibold text-gray-700 dark:text-gray-300 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 rounded-lg transition-colors">
                        Cancel
                    </button>
                    <button wire:click="deleteCourse({{ $confirmingDeleteId }})" 
                        class="flex-1 px-4 py-2.5 text-sm font-semibold text-white bg-red-600 hover:bg-red-700 dark:bg-red-600 dark:hover:bg-red-700 rounded-lg transition-colors">
                        <i class="fa-solid fa-trash mr-2"></i>
                        Delete
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
