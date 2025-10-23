<div class="bg-white border border-gray-200 rounded-lg shadow-md">
    <div class="sticky top-0 z-10 flex items-center justify-between px-4 py-3 border-b bg-white/80 backdrop-blur">
        <a href="{{ route('instructor.courses.index') }}" class="inline-flex items-center text-sm font-medium text-gray-700 transition hover:text-gray-900">
            <i class="mr-2 fas fa-arrow-left"></i>
            Back
        </a>
        <h2 class="text-lg font-semibold text-gray-800 sm:text-xl">Create New Course</h2>
        <span class="w-[60px]"></span>
    </div>
    <div class="p-4 sm:p-6 lg:p-8">

    <form wire:submit.prevent="saveCourse" class="space-y-6">
        @include('livewire.instructor.course._form-fields')

        <div class="pt-5 border-t border-gray-200">
            <div class="flex justify-end space-x-3">
                <a href="{{ route('instructor.courses.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Cancel
                </a>
                <button type="submit"
                    class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <span wire:loading.remove wire:target="saveCourse">Create Course</span>
                    <span wire:loading wire:target="saveCourse">Saving...</span>
                </button>
            </div>
        </div>
    </form>
    </div>
</div>
