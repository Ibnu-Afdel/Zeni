@php
    $fullWidth = true;
@endphp

<div class="min-h-screen bg-white dark:bg-gray-900 transition-colors duration-300">
    <div class="px-4 py-8 md:py-12">
        <div class="max-w-5xl mx-auto">
            <!-- Header -->
            <div class="mb-6">
                <a href="{{ route('instructor.courses.index') }}" 
                    class="inline-flex items-center text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-primary-600 dark:hover:text-primary-500 transition-colors mb-4">
                    <i class="fa-solid fa-arrow-left mr-2"></i>
                    Back to Courses
                </a>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white flex items-center gap-3">
                    <i class="fa-solid fa-edit text-primary-600 dark:text-primary-500"></i>
                    Edit Course
                </h1>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">Update your course information</p>
            </div>

            <!-- Success Message -->
            @if (session()->has('message'))
                <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg flex items-start gap-3">
                    <i class="fa-solid fa-circle-check text-green-600 dark:text-green-400 mt-0.5"></i>
                    <span class="text-sm text-green-700 dark:text-green-300">{{ session('message') }}</span>
                </div>
            @endif

            <!-- Form -->
            <form wire:submit.prevent="updateCourse">
                @include('livewire.instructor.course._form-fields')

                <!-- Form Actions -->
                <div class="flex items-center justify-end gap-3 mt-8">
                    <a href="{{ route('instructor.courses.index') }}" 
                        class="px-6 py-3 text-sm font-semibold text-gray-700 dark:text-gray-300 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 rounded-lg transition-colors">
                        Cancel
                    </a>
                    <button type="submit"
                        class="inline-flex items-center px-6 py-3 text-sm font-semibold text-white bg-primary-600 hover:bg-primary-700 dark:bg-primary-600 dark:hover:bg-primary-700 rounded-lg transition-colors">
                        <span wire:loading.remove wire:target="updateCourse">
                            <i class="fa-solid fa-save mr-2"></i>
                            Update Course
                        </span>
                        <span wire:loading wire:target="updateCourse">
                            <i class="fa-solid fa-spinner fa-spin mr-2"></i>
                            Updating...
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
