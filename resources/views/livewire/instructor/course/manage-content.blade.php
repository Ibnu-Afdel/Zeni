@php
    $fullWidth = true;
@endphp

<div class="min-h-screen bg-white dark:bg-gray-900 transition-colors duration-300">
    <!-- Header -->
    <div class="sticky top-0 z-20 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 shadow-sm">
        <div class="px-4 py-4 md:py-6">
            <div class="max-w-7xl mx-auto">
                <div class="flex items-center justify-between mb-4">
<div>
                        <a href="{{ route('instructor.courses.index') }}" 
                            class="inline-flex items-center text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-primary-600 dark:hover:text-primary-500 transition-colors mb-2">
                            <i class="fa-solid fa-arrow-left mr-2"></i>
                            Back to Courses
                        </a>
                        <h1 class="text-xl md:text-2xl font-bold text-gray-900 dark:text-white flex items-center gap-3">
                            <i class="fa-solid fa-layer-group text-primary-600 dark:text-primary-500"></i>
                    Manage Content
                </h1>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ $course->name }}</p>
                    </div>
            </div>

                <!-- Messages -->
            @if (session()->has('message'))
                    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition.opacity.duration.300ms
                        class="p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg flex items-start gap-3">
                        <i class="fa-solid fa-circle-check text-green-600 dark:text-green-400 mt-0.5"></i>
                        <span class="text-sm text-green-700 dark:text-green-300">{{ session('message') }}</span>
                    </div>
            @endif
            @if (session()->has('error'))
                    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition.opacity.duration.300ms
                        class="p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg flex items-start gap-3">
                        <i class="fa-solid fa-circle-exclamation text-red-600 dark:text-red-400 mt-0.5"></i>
                        <span class="text-sm text-red-700 dark:text-red-300">{{ session('error') }}</span>
                    </div>
            @endif
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="px-4 py-8 md:py-12">
        <div class="max-w-7xl mx-auto space-y-6">
            <!-- Add Section Form -->
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6">
                <form wire:submit.prevent="addSection" class="flex flex-col md:flex-row gap-3">
                    <div class="flex-1">
                    <label for="new-section-title" class="sr-only">Add new section</label>
                        <input id="new-section-title" type="text" wire:model.defer="newSectionTitle" 
                            placeholder="Enter section title (e.g., Introduction, Getting Started)" required
                            class="w-full px-4 py-3 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-500 focus:border-transparent transition-colors">
                        @error('newSectionTitle')
                            <span class="mt-1.5 text-xs text-red-600 dark:text-red-400 block">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" 
                        class="inline-flex items-center justify-center px-6 py-3 text-sm font-semibold text-white bg-primary-600 hover:bg-primary-700 dark:bg-primary-600 dark:hover:bg-primary-700 rounded-lg transition-colors whitespace-nowrap"
                        wire:loading.attr="disabled" wire:target="addSection">
                        <span wire:loading.remove wire:target="addSection">
                            <i class="fa-solid fa-plus mr-2"></i>
                            Add Section
                        </span>
                        <span wire:loading wire:target="addSection">
                            <i class="fa-solid fa-spinner fa-spin mr-2"></i>
                            Adding...
                        </span>
                    </button>
                </form>
            </div>

            <!-- Sections List -->
            <div class="space-y-4" x-data="{}" x-sortable="'updateSectionOrder'" wire:loading.class="opacity-50" wire:target="updateSectionOrder">
                @forelse ($sections as $section)
                    <div wire:key="section-{{ $section->id }}" wire:sortable.item="{{ $section->id }}" 
                        class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl overflow-hidden">
                        <div x-data="{ open: true }">
                            <!-- Section Header -->
                            <div class="p-4 md:p-6 border-b border-gray-200 dark:border-gray-700">
                                @if ($editingSectionId === $section->id)
                                    <!-- Edit Section Form -->
                                    <form wire:submit.prevent="updateSection" class="flex flex-col md:flex-row gap-3">
                                        <div class="flex-1">
                                            <label for="editing-section-title" class="sr-only">Section title</label>
                                            <input id="editing-section-title" type="text" wire:model.defer="editingSectionTitle" 
                                                placeholder="Section title" required
                                                class="w-full px-4 py-3 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-500 focus:border-transparent transition-colors">
                                            @error('editingSectionTitle')
                                                <span class="mt-1.5 text-xs text-red-600 dark:text-red-400 block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <button type="submit" 
                                                class="flex-1 md:flex-none px-4 py-3 text-sm font-semibold text-white bg-primary-600 hover:bg-primary-700 rounded-lg transition-colors">
                                                <i class="fa-solid fa-check mr-2"></i>Save
                                            </button>
                                            <button type="button" wire:click="cancelEditingSection" 
                                                class="flex-1 md:flex-none px-4 py-3 text-sm font-semibold text-gray-700 dark:text-gray-300 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 rounded-lg transition-colors">
                                                Cancel
                                            </button>
                                        </div>
                                        <div wire:loading wire:target="updateSection" class="text-sm text-primary-600 dark:text-primary-500">
                                            <i class="fa-solid fa-spinner fa-spin"></i>
                                        </div>
                                    </form>
                                @else
                                    <!-- Section Title -->
                                    <div class="flex items-center justify-between gap-4">
                                        <button type="button" class="flex-1 text-left flex items-center gap-3 min-w-0" x-on:click="open = !open">
                                            <span wire:sortable.handle class="text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-400 cursor-move flex-shrink-0" title="Drag to reorder">
                                                <i class="fa-solid fa-grip-vertical text-lg"></i>
                                            </span>
                                            <div class="flex-1 min-w-0">
                                                <h3 class="text-base md:text-lg font-semibold text-gray-900 dark:text-white truncate">
                                                    {{ $section->title }}
                                                </h3>
                                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                                    {{ $section->lessons->count() }} {{ $section->lessons->count() === 1 ? 'lesson' : 'lessons' }}
                                                </p>
                                            </div>
                                            <i class="fa-solid fa-chevron-down text-gray-500 dark:text-gray-400 transition-transform flex-shrink-0" :class="{ 'rotate-180': open }"></i>
                                        </button>
                                        <div class="flex items-center gap-2 flex-shrink-0">
                                            <button wire:click="startEditingSection({{ $section->id }})" 
                                                class="px-3 py-2 text-xs font-semibold text-blue-700 dark:text-blue-400 bg-blue-100 dark:bg-blue-900/30 hover:bg-blue-200 dark:hover:bg-blue-900/50 rounded-lg transition-colors">
                                                <i class="fa-solid fa-edit"></i>
                                                <span class="hidden sm:inline ml-1">Edit</span>
                                            </button>
                                            <button wire:click="confirmDeleteSection({{ $section->id }})" 
                                                class="px-3 py-2 text-xs font-semibold text-red-700 dark:text-red-400 bg-red-100 dark:bg-red-900/30 hover:bg-red-200 dark:hover:bg-red-900/50 rounded-lg transition-colors">
                                                <i class="fa-solid fa-trash"></i>
                                                <span class="hidden sm:inline ml-1">Delete</span>
                                        </button>
                                    </div>
                                    </div>
                                @endif
                            </div>

                            <!-- Lessons List -->
                            <div x-show="open" x-collapse class="p-4 md:p-6 bg-gray-50 dark:bg-gray-900/50">
                                <div class="space-y-3" x-data="{}" x-sortable="'updateLessonOrder'" wire:sortable-group-key="{{ $section->id }}">
                                    @forelse ($section->lessons as $lesson)
                                        <div wire:key="lesson-{{ $lesson->id }}" wire:sortable.item="{{ $lesson->id }}" 
                                            class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                                            @if ($editingLessonId === $lesson->id)
                                                <!-- Edit Lesson Form -->
                                                <form wire:submit.prevent="updateLesson" class="space-y-4">
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                                            Lesson Title <span class="text-red-500">*</span>
                                                        </label>
                                                        <input type="text" wire:model.defer="editingLessonTitle" 
                                                            class="w-full px-4 py-3 text-gray-900 dark:text-white bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 transition-colors">
                                                        @error('editingLessonTitle')
                                                            <span class="mt-1.5 text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                                            Video URL (Optional)
                                                        </label>
                                                        <input type="url" wire:model.defer="editingLessonVideoUrl" 
                                                            placeholder="https://www.youtube-nocookie.com/embed/"
                                                            class="w-full px-4 py-3 text-gray-900 dark:text-white bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 transition-colors">
                                                        @error('editingLessonVideoUrl')
                                                            <span class="mt-1.5 text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                                            Content (Optional)
                                                        </label>
                                                        <textarea wire:model.defer="editingLessonContent" rows="4" 
                                                            class="w-full px-4 py-3 text-gray-900 dark:text-white bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 transition-colors"></textarea>
                                                    </div>
                                                    <div class="flex items-center gap-2 flex-wrap">
                                                        <button type="submit" 
                                                            class="px-4 py-2 text-sm font-semibold text-white bg-primary-600 hover:bg-primary-700 rounded-lg transition-colors">
                                                            <i class="fa-solid fa-save mr-2"></i>Save Lesson
                                                        </button>
                                                        <button type="button" wire:click="cancelEditingLesson" 
                                                            class="px-4 py-2 text-sm font-semibold text-gray-700 dark:text-gray-300 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 rounded-lg transition-colors">
                                                            Cancel
                                                        </button>
                                                        <div wire:loading wire:target="updateLesson" class="text-sm text-primary-600 dark:text-primary-500">
                                                            <i class="fa-solid fa-spinner fa-spin"></i>
                                                        </div>
                                                    </div>
                                                </form>
                                            @else
                                                <!-- Lesson Display -->
                                                <div class="flex items-start justify-between gap-3">
                                                    <div class="flex items-start gap-3 flex-1 min-w-0">
                                                        <span wire:sortable.handle class="text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-400 cursor-move mt-1 flex-shrink-0" title="Drag to reorder">
                                                            <i class="fa-solid fa-grip-vertical"></i>
                                                        </span>
                                                        <div class="flex-1 min-w-0">
                                                            <p class="text-sm font-medium text-gray-900 dark:text-white truncate">
                                                        {{ $lesson->title }}
                                                            </p>
                                                            <div class="flex flex-wrap items-center gap-2 mt-2">
                                                        @if ($lesson->video_url)
                                                                    <span class="inline-flex items-center px-2 py-1 text-xs font-semibold text-blue-700 dark:text-blue-400 bg-blue-100 dark:bg-blue-900/30 rounded">
                                                                        <i class="fa-solid fa-video mr-1"></i>Video
                                                                    </span>
                                                        @endif
                                                        @if ($lesson->content)
                                                                    <span class="inline-flex items-center px-2 py-1 text-xs font-semibold text-green-700 dark:text-green-400 bg-green-100 dark:bg-green-900/30 rounded">
                                                                        <i class="fa-solid fa-file-lines mr-1"></i>Content
                                                                    </span>
                                                        @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="flex items-center gap-2 flex-shrink-0">
                                                        <button wire:click="startEditingLesson({{ $lesson->id }})" 
                                                            class="px-3 py-2 text-xs font-semibold text-blue-700 dark:text-blue-400 bg-blue-100 dark:bg-blue-900/30 hover:bg-blue-200 dark:hover:bg-blue-900/50 rounded-lg transition-colors">
                                                            <i class="fa-solid fa-edit"></i>
                                                        </button>
                                                        <button wire:click="confirmDeleteLesson({{ $lesson->id }})" 
                                                            class="px-3 py-2 text-xs font-semibold text-red-700 dark:text-red-400 bg-red-100 dark:bg-red-900/30 hover:bg-red-200 dark:hover:bg-red-900/50 rounded-lg transition-colors">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    @empty
                                        <div class="text-center py-8 text-gray-500 dark:text-gray-400">
                                            <i class="fa-solid fa-inbox text-3xl mb-2"></i>
                                            <p class="text-sm">No lessons yet. Add one below.</p>
                                        </div>
                                    @endforelse

                                    <!-- Add Lesson Form/Button -->
                                    <div class="pt-3">
                                        @if ($addingLessonToSectionId === $section->id)
                                            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-4 md:p-6">
                                                <form wire:submit.prevent="addLesson" class="space-y-4">
                                                    <h4 class="text-sm font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                                                        <i class="fa-solid fa-plus-circle text-primary-600 dark:text-primary-500"></i>
                                                        Add New Lesson
                                                    </h4>
                                                <div>
                                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                                            Title <span class="text-red-500">*</span>
                                                        </label>
                                                        <input type="text" wire:model.defer="newLessonTitle" 
                                                            placeholder="Lesson title" required
                                                            class="w-full px-4 py-3 text-gray-900 dark:text-white bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 transition-colors">
                                                    @error('newLessonTitle')
                                                            <span class="mt-1.5 text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div>
                                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                                            Video URL (Optional)
                                                        </label>
                                                        <input type="url" wire:model.defer="newLessonVideoUrl" 
                                                            placeholder="https://www.youtube-nocookie.com/embed/"
                                                            class="w-full px-4 py-3 text-gray-900 dark:text-white bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 transition-colors">
                                                    @error('newLessonVideoUrl')
                                                            <span class="mt-1.5 text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div>
                                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                                            Content (Optional)
                                                        </label>
                                                        <textarea wire:model.defer="newLessonContent" rows="4" 
                                                            placeholder="Lesson details..."
                                                            class="w-full px-4 py-3 text-gray-900 dark:text-white bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 transition-colors"></textarea>
                                                    </div>
                                                    <div class="flex items-center gap-2 flex-wrap">
                                                        <button type="submit" 
                                                            class="px-4 py-2 text-sm font-semibold text-white bg-green-600 hover:bg-green-700 rounded-lg transition-colors">
                                                            <i class="fa-solid fa-plus mr-2"></i>Add Lesson
                                                        </button>
                                                        <button type="button" wire:click="cancelAddingLesson" 
                                                            class="px-4 py-2 text-sm font-semibold text-gray-700 dark:text-gray-300 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 rounded-lg transition-colors">
                                                            Cancel
                                                        </button>
                                                        <div wire:loading wire:target="addLesson" class="text-sm text-green-600 dark:text-green-500">
                                                            <i class="fa-solid fa-spinner fa-spin"></i>
                                                </div>
                                                </div>
                                            </form>
                                            </div>
                                        @else
                                            <button wire:click="startAddingLesson({{ $section->id }})" 
                                                class="w-full px-4 py-3 text-sm font-semibold text-green-700 dark:text-green-400 bg-green-50 dark:bg-green-900/20 hover:bg-green-100 dark:hover:bg-green-900/30 border-2 border-dashed border-green-300 dark:border-green-800 rounded-lg transition-colors">
                                                <i class="fa-solid fa-plus mr-2"></i>
                                                Add Lesson to this Section
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <!-- Empty State -->
                    <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-12 text-center">
                        <i class="fa-solid fa-layer-group text-5xl text-gray-300 dark:text-gray-600 mb-4"></i>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">No sections yet</h3>
                        <p class="text-gray-600 dark:text-gray-400">Create your first section above to start organizing your course content.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Delete Section Modal -->
    @if($confirmingDeleteSection)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm">
            <div class="w-full max-w-md bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 shadow-2xl">
                <div class="flex items-center gap-3 mb-4">
                    <div class="flex items-center justify-center w-12 h-12 bg-red-100 dark:bg-red-900/30 rounded-full flex-shrink-0">
                        <i class="fa-solid fa-exclamation-triangle text-xl text-red-600 dark:text-red-500"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white truncate">Delete Section</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">This action cannot be undone</p>
                    </div>
                </div>
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">
                    Are you sure you want to delete "<strong class="text-gray-900 dark:text-white">{{ $titleToDeleted }}</strong>"? 
                    This will permanently remove the section and all its lessons.
                </p>
                <div class="flex gap-3">
                    <button wire:click="$set('confirmingDeleteSection', false)" 
                        class="flex-1 px-4 py-2.5 text-sm font-semibold text-gray-700 dark:text-gray-300 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 rounded-lg transition-colors">
                        Cancel
                    </button>
                    <button wire:click="deleteSection({{ $confirmingDeleteSection }})" 
                        class="flex-1 px-4 py-2.5 text-sm font-semibold text-white bg-red-600 hover:bg-red-700 rounded-lg transition-colors">
                        <i class="fa-solid fa-trash mr-2"></i>Delete
                    </button>
                </div>
            </div>
        </div>
    @endif

    <!-- Delete Lesson Modal -->
    @if($confirmingDeleteLesson)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm">
            <div class="w-full max-w-md bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 shadow-2xl">
                <div class="flex items-center gap-3 mb-4">
                    <div class="flex items-center justify-center w-12 h-12 bg-red-100 dark:bg-red-900/30 rounded-full flex-shrink-0">
                        <i class="fa-solid fa-exclamation-triangle text-xl text-red-600 dark:text-red-500"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white truncate">Delete Lesson</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">This action cannot be undone</p>
                    </div>
                </div>
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">
                    Are you sure you want to delete "<strong class="text-gray-900 dark:text-white">{{ $titleToDeleted }}</strong>"? 
                    This will permanently remove the lesson.
                </p>
                <div class="flex gap-3">
                    <button wire:click="$set('confirmingDeleteLesson', false)" 
                        class="flex-1 px-4 py-2.5 text-sm font-semibold text-gray-700 dark:text-gray-300 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 rounded-lg transition-colors">
                        Cancel
                    </button>
                    <button wire:click="deleteLesson({{ $confirmingDeleteLesson }})" 
                        class="flex-1 px-4 py-2.5 text-sm font-semibold text-white bg-red-600 hover:bg-red-700 rounded-lg transition-colors">
                        <i class="fa-solid fa-trash mr-2"></i>Delete
                    </button>
                </div>
            </div>
</div>
    @endif
</div>
