<div class="bg-white border border-gray-200 rounded-lg shadow-md">
    <div class="sticky top-0 z-10 flex items-center justify-between px-4 py-3 border-b bg-white/80 backdrop-blur">
        <a href="{{ route('instructor.courses.index') }}" class="inline-flex items-center text-sm font-medium text-gray-700 transition hover:text-gray-900">
            <i class="mr-2 fas fa-arrow-left"></i>
            Back
        </a>
        <h2 class="text-lg font-semibold text-gray-800 sm:text-xl">Edit Course</h2>
        <a href="{{ route('instructor.courses.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Cancel</a>
    </div>
    <div class="p-4 sm:p-6 lg:p-8">

    <form wire:submit.prevent="updateCourse" class="space-y-6">
        @include('livewire.instructor.course._form-fields')
        @if($existingImageUrl && !$image)
            <div class="mt-4">
                <span class="block mb-1 text-sm font-medium text-gray-700">Current Image</span>
                <img src="{{ $existingImageUrl }}" alt="Current course image" class="object-cover w-auto h-16 rounded">
            </div>
        @endif
        
        <div class="pt-5 border-t border-gray-200">
            <div class="flex justify-end">
                <button type="submit" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded hover:bg-indigo-700">
                    Update Course
                </button>
            </div>
        </div>
    </form>
    </div>
</div>
