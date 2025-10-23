<div class="flex flex-col min-h-screen" x-data="{ openFilters: false }">
<div class="px-4 py-6 flex-1">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-xl font-semibold text-gray-800">My Courses</h1>
        <a href="{{ route('instructor.courses.create') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded shadow hover:bg-indigo-700">
            <i class="mr-2 fas fa-plus"></i>
            New Course
        </a>
    </div>

    @if (session()->has('message'))
        <div class="px-4 py-2 mb-4 text-sm text-green-800 bg-green-100 border border-green-200 rounded">
            {{ session('message') }}
        </div>
    @endif

    <div class="mb-3 flex items-center justify-between">
        <button type="button" class="md:hidden inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded shadow-sm hover:bg-gray-50" x-on:click="openFilters = !openFilters">
            <i class="mr-2 fas fa-filter"></i>
            Filters
        </button>
        <div class="hidden md:flex gap-3 w-full md:w-auto">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Status</label>
                <select wire:model.live="filterStatus" class="w-full border-gray-300 rounded">
                    <option value="">All</option>
                    <option value="draft">Draft</option>
                    <option value="published">Published</option>
                    <option value="archived">Archived</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Level</label>
                <select wire:model.live="filterLevel" class="w-full border-gray-300 rounded">
                    <option value="">All</option>
                    <option value="beginner">Beginner</option>
                    <option value="intermediate">Intermediate</option>
                    <option value="advanced">Advanced</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Premium</label>
                <select wire:model.live="filterPro" class="w-full border-gray-300 rounded">
                    <option value="">All</option>
                    <option value="1">Premium Only</option>
                    <option value="0">Free</option>
                </select>
            </div>
        </div>
    </div>
    <div class="md:hidden" x-show="openFilters" x-transition>
        <div class="p-3 mb-3 bg-white border border-gray-200 rounded-lg shadow-sm grid grid-cols-1 gap-3">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Status</label>
                <select wire:model.live="filterStatus" class="w-full border-gray-300 rounded">
                    <option value="">All</option>
                    <option value="draft">Draft</option>
                    <option value="published">Published</option>
                    <option value="archived">Archived</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Level</label>
                <select wire:model.live="filterLevel" class="w-full border-gray-300 rounded">
                    <option value="">All</option>
                    <option value="beginner">Beginner</option>
                    <option value="intermediate">Intermediate</option>
                    <option value="advanced">Advanced</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Premium</label>
                <select wire:model.live="filterPro" class="w-full border-gray-300 rounded">
                    <option value="">All</option>
                    <option value="1">Premium Only</option>
                    <option value="0">Free</option>
                </select>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
        @forelse ($courses as $course)
            <div class="relative p-4 bg-white border border-gray-200 rounded shadow-sm">
                <span class="absolute top-3 right-3 px-2 py-0.5 rounded text-xs font-medium {{ $course->is_pro ? 'bg-purple-100 text-purple-700' : 'bg-emerald-100 text-emerald-700' }}">
                    {{ $course->is_pro ? 'Premium' : 'Free' }}
                </span>
                <h2 class="pr-16 text-base font-semibold text-gray-900 truncate">{{ $course->name }}</h2>
                <p class="mt-1 text-sm text-gray-600 line-clamp-2">{{ $course->description }}</p>
                <div class="flex items-center justify-between mt-3 text-sm text-gray-500">
                    <span>Status: <span class="font-medium capitalize">{{ $course->status }}</span></span>
                </div>
                <div class="flex items-center gap-2 mt-4">
                    <a href="{{ route('instructor.courses.edit', ['course' => $course]) }}" class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-50">
                        <i class="mr-2 fas fa-edit"></i>
                        Edit
                    </a>
                    <a href="{{ route('instructor.courses.manage_content', ['course' => $course]) }}" class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-white bg-indigo-600 rounded hover:bg-indigo-700">
                        <i class="mr-2 fas fa-layer-group"></i>
                        Manage Content
                    </a>
                    @if($course->status === 'draft')
                        <button wire:click="publish({{ $course->id }})" class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-white bg-emerald-600 rounded hover:bg-emerald-700">
                            <i class="mr-2 fas fa-upload"></i>
                            Publish
                        </button>
                    @elseif($course->status === 'published')
                        <button wire:click="unpublish({{ $course->id }})" class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-50">
                            <i class="mr-2 fas fa-undo"></i>
                            Unpublish
                        </button>
                    @endif
                    <button wire:click="confirmDelete({{ $course->id }})" class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-white bg-red-600 rounded hover:bg-red-700">
                        <i class="mr-2 fas fa-trash"></i>
                        Delete
                    </button>
                </div>
            </div>
        @empty
            <div class="col-span-full">
                <div class="p-6 text-center text-gray-500 bg-white border border-gray-200 rounded">No courses yet.</div>
            </div>
        @endforelse
    </div>

    @if($confirmingDeleteId)
        <div class="fixed inset-0 z-40 bg-black/40"></div>
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4">
            <div class="w-full max-w-sm p-5 bg-white border border-gray-200 rounded-lg shadow">
                <h3 class="text-base font-semibold text-gray-800">Delete course?</h3>
                <p class="mt-1 text-sm text-gray-600">This action cannot be undone.</p>
                <div class="flex justify-end gap-2 mt-4">
                    <button wire:click="cancelDelete" class="px-3 py-1.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-50">Cancel</button>
                    <button wire:click="deleteCourse({{ $confirmingDeleteId }})" class="px-3 py-1.5 text-sm font-medium text-white bg-red-600 rounded hover:bg-red-700">Delete</button>
                </div>
            </div>
        </div>
    @endif
    </div>
</div>

