<div>
<div class="min-h-screen flex flex-col">
    <header class="sticky top-0 z-10 bg-white/80 backdrop-blur border-b">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <h1 class="text-xl font-semibold text-gray-900">
                    Manage Content
                    <span class="ml-1 font-normal text-gray-600">· {{ $course->name }}</span>
                </h1>
                <a href="{{ route('instructor.courses.index') }}" class="hidden sm:inline-flex items-center text-sm text-gray-600 hover:text-gray-900">Back</a>
            </div>
            @if (session()->has('message'))
                <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 2000)" x-show="show" x-transition.opacity.duration.300ms
                    class="mt-3 px-3 py-2 text-sm text-green-800 bg-green-100 border border-green-200 rounded">{{ session('message') }}</div>
            @endif
            @if (session()->has('error'))
                <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 2000)" x-show="show" x-transition.opacity.duration.300ms
                    class="mt-3 px-3 py-2 text-sm text-red-800 bg-red-100 border border-red-200 rounded">{{ session('error') }}</div>
            @endif
        </div>
    </header>

    <main class="flex-1">
        <div class="container mx-auto px-4 py-4">
            <div class="mb-4">
                <form wire:submit.prevent="addSection" class="flex flex-col sm:flex-row gap-2 sm:items-center bg-white border border-gray-200 rounded-lg p-3 shadow-sm">
                    <label for="new-section-title" class="sr-only">Add new section</label>
                    <input id="new-section-title" type="text" wire:model.defer="newSectionTitle" placeholder="New section title" required class="flex-1 px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <div class="flex items-center gap-2 sm:justify-end">
                        <button type="submit" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded hover:bg-indigo-700" wire:loading.attr="disabled" wire:target="addSection">
                            <span wire:loading.remove wire:target="addSection">Add Section</span>
                            <span wire:loading wire:target="addSection">Adding...</span>
                        </button>
                    </div>
                    @error('newSectionTitle')
                        <span class="text-xs text-red-600">{{ $message }}</span>
                    @enderror
                </form>
            </div>
            <div class="space-y-4" x-data="{}" x-sortable="'updateSectionOrder'" wire:loading.class="opacity-50" wire:target="updateSectionOrder">
                @forelse ($sections as $section)
                    <div wire:key="section-{{ $section->id }}" wire:sortable.item="{{ $section->id }}" class="rounded-lg border border-gray-200 bg-white shadow-sm">
                        <div x-data="{ open: true }" class="divide-y divide-gray-200">
                            <div class="p-3 sm:p-4 flex items-start justify-between">
                                @if ($editingSectionId === $section->id)
                                    <form wire:submit.prevent="updateSection" class="w-full grid grid-cols-1 sm:grid-cols-12 gap-2">
                                        <div class="sm:col-span-9">
                                            <label for="editing-section-title" class="sr-only">Section title</label>
                                            <input id="editing-section-title" type="text" wire:model.defer="editingSectionTitle" placeholder="Section title"
                                                class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                                            @error('editingSectionTitle')
                                                <span class="mt-1 text-xs text-red-600">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="sm:col-span-3 flex items-center justify-end gap-2">
                                            <button type="submit" class="inline-flex items-center px-3 py-2 text-xs font-medium text-white bg-indigo-600 rounded hover:bg-indigo-700">Save</button>
                                            <button type="button" wire:click="cancelEditingSection" class="inline-flex items-center px-3 py-2 text-xs font-medium text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-50">Cancel</button>
                                            <div wire:loading wire:target="updateSection" class="text-xs text-gray-500">Saving...</div>
                                        </div>
                                    </form>
                                @else
                                    <div class="flex-1 min-w-0">
                                        <button type="button" class="w-full text-left flex items-center gap-3" x-on:click="open = !open">
                                            <span wire:sortable.handle class="text-gray-400 hover:text-gray-600" title="Drag to reorder">
                                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                                                </svg>
                                            </span>
                                            <span class="flex-1 truncate text-base font-medium text-gray-900">{{ $section->title }}</span>
                                            <svg class="w-5 h-5 text-gray-500" :class="{ 'rotate-180': open }" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="ml-3 flex items-center gap-2">
                                        <button wire:click="startEditingSection({{ $section->id }})" class="px-2 py-1 text-xs font-medium text-blue-700 bg-blue-100 rounded hover:bg-blue-200">Edit</button>
                                        <button wire:click="confirmDeleteSection({{ $section->id }})" class="px-2 py-1 text-xs font-medium text-red-700 bg-red-100 rounded hover:bg-red-200">Delete</button>
                                    </div>
                                @endif
                            </div>

                            @if($confirmingDeleteSection)
                                <div class="fixed inset-0 z-20">
                                    <div class="absolute inset-0 bg-black/40"></div>
                                    <div class="absolute inset-0 flex items-center justify-center p-4">
                                        <div class="w-full max-w-sm bg-white rounded-lg shadow border border-gray-200 p-5">
                                            <h3 class="text-base font-semibold text-gray-900">Delete "{{ $titleToDeleted }}"?</h3>
                                            <p class="mt-1 text-sm text-gray-600">This will remove the section and its lessons. This action cannot be undone.</p>
                                            <div class="mt-4 flex justify-end gap-2">
                                                <button wire:click="$set('confirmingDeleteSection', false)" class="px-3 py-1.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-50">Cancel</button>
                                                <button wire:click="deleteSection({{ $confirmingDeleteSection }})" class="px-3 py-1.5 text-sm font-medium text-white bg-red-600 rounded hover:bg-red-700">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="p-3 sm:p-4" x-show="open" x-collapse>
                                <div class="space-y-3" x-data="{}" x-sortable="'updateLessonOrder'" wire:sortable-group-key="{{ $section->id }}">
                                    @forelse ($section->lessons as $lesson)
                                        <div wire:key="lesson-{{ $lesson->id }}" wire:sortable.item="{{ $lesson->id }}" class="p-3 rounded-md border border-gray-200 bg-white shadow-sm">
                                            @if ($editingLessonId === $lesson->id)
                                                <form wire:submit.prevent="updateLesson" class="space-y-3">
                                                    <div>
                                                        <label class="block text-xs font-medium text-gray-700">Title</label>
                                                        <input type="text" wire:model.defer="editingLessonTitle" class="mt-1 w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                                        @error('editingLessonTitle')
                                                            <span class="text-xs text-red-600">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div>
                                                        <label class="block text-xs font-medium text-gray-700">Video URL (Optional)</label>
                                                        <input type="url" wire:model.defer="editingLessonVideoUrl" placeholder="https://www.youtube-nocookie.com/embed/" class="mt-1 w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                                        @error('editingLessonVideoUrl')
                                                            <span class="text-xs text-red-600">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div>
                                                        <label class="block text-xs font-medium text-gray-700">Content (Optional)</label>
                                                        <textarea wire:model.defer="editingLessonContent" rows="3" class="mt-1 w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"></textarea>
                                                    </div>
                                                    <div class="flex items-center gap-2">
                                                        <button type="submit" class="px-3 py-2 text-xs font-medium text-white bg-indigo-600 rounded hover:bg-indigo-700">Save Lesson</button>
                                                        <button type="button" wire:click="cancelEditingLesson" class="px-3 py-2 text-xs font-medium text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-50">Cancel</button>
                                                        <div wire:loading wire:target="updateLesson" class="text-xs text-gray-500">Saving...</div>
                                                    </div>
                                                </form>
                                            @else
                                                <div class="flex items-start justify-between gap-3">
                                                    <p class="flex items-center text-sm text-gray-800">
                                                        <span wire:sortable.handle class="mr-2 text-gray-400 hover:text-gray-600" title="Drag to reorder">
                                                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                                                            </svg>
                                                        </span>
                                                        {{ $lesson->title }}
                                                        @if ($lesson->video_url)
                                                            <span class="ml-2 text-xs font-medium text-blue-700 bg-blue-100 px-1.5 py-0.5 rounded">Video</span>
                                                        @endif
                                                        @if ($lesson->content)
                                                            <span class="ml-2 text-xs font-medium text-green-700 bg-green-100 px-1.5 py-0.5 rounded">Content</span>
                                                        @endif
                                                    </p>
                                                    <div class="flex items-center gap-2">
                                                        <button wire:click="startEditingLesson({{ $lesson->id }})" class="px-2 py-1 text-xs font-medium text-blue-700 bg-blue-100 rounded hover:bg-blue-200">Edit</button>
                                                        <button wire:click="confirmDeleteLesson({{ $lesson->id }})" class="px-2 py-1 text-xs font-medium text-red-700 bg-red-100 rounded hover:bg-red-200">Delete</button>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    @empty
                                        <p class="text-xs italic text-gray-500">No lessons in this section yet.</p>
                                    @endforelse

                                    @if($confirmingDeleteLesson)
                                        <div class="fixed inset-0 z-20">
                                            <div class="absolute inset-0 bg-black/40"></div>
                                            <div class="absolute inset-0 flex items-center justify-center p-4">
                                                <div class="w-full max-w-sm bg-white rounded-lg shadow border border-gray-200 p-5">
                                                    <h3 class="text-base font-semibold text-gray-900">Delete "{{ $titleToDeleted }}"?</h3>
                                                    <p class="mt-1 text-sm text-gray-600">This will remove the lesson. This action cannot be undone.</p>
                                                    <div class="mt-4 flex justify-end gap-2">
                                                        <button wire:click="$set('confirmingDeleteLesson', false)" class="px-3 py-1.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-50">Cancel</button>
                                                        <button wire:click="deleteLesson({{ $confirmingDeleteLesson }})" class="px-3 py-1.5 text-sm font-medium text-white bg-red-600 rounded hover:bg-red-700">Delete</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="pt-3 mt-1 border-t border-gray-200">
                                        @if ($addingLessonToSectionId === $section->id)
                                            <form wire:submit.prevent="addLesson" class="p-3 -m-1 space-y-3 bg-gray-50 rounded-md">
                                                <h4 class="text-sm font-medium text-gray-900">Add New Lesson</h4>
                                                <div>
                                                    <label class="block text-xs font-medium text-gray-700">Title <span class="text-red-600">*</span></label>
                                                    <input type="text" wire:model.defer="newLessonTitle" placeholder="Lesson title" required class="mt-1 w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                                    @error('newLessonTitle')
                                                        <span class="text-xs text-red-600">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div>
                                                    <label class="block text-xs font-medium text-gray-700">Video URL (Optional)</label>
                                                    <input type="url" wire:model.defer="newLessonVideoUrl" placeholder="https://www.youtube-nocookie.com/embed/" class="mt-1 w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                                    @error('newLessonVideoUrl')
                                                        <span class="text-xs text-red-600">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div>
                                                    <label class="block text-xs font-medium text-gray-700">Content (Optional)</label>
                                                    <textarea wire:model.defer="newLessonContent" rows="3" placeholder="Lesson details..." class="mt-1 w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"></textarea>
                                                </div>
                                                <div class="flex items-center gap-2">
                                                    <button type="submit" class="px-3 py-2 text-xs font-medium text-white bg-green-600 rounded hover:bg-green-700">Add Lesson</button>
                                                    <button type="button" wire:click="cancelAddingLesson" class="px-3 py-2 text-xs font-medium text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-50">Cancel</button>
                                                    <div wire:loading wire:target="addLesson" class="text-xs text-gray-500">Adding...</div>
                                                </div>
                                            </form>
                                        @else
                                            <button wire:click="startAddingLesson({{ $section->id }})" class="px-2.5 py-1.5 text-xs font-medium text-green-700 bg-green-100 rounded hover:bg-green-200">+ Add Lesson</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="rounded-lg border border-gray-200 bg-white shadow-sm px-6 py-4 text-sm text-center text-gray-500">No sections created yet. Add one below to get started.</div>
                @endforelse
            </div>
        </div>
    </main>
    
</div>
</div>
