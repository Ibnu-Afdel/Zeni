<div>
    @if ($enrollment_status)
        @if ($successMessage)
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
                class="p-3 mb-3 text-sm text-green-700 bg-green-100 border border-green-200 rounded">
                {{ $successMessage }}
            </div>
        @endif
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('course-play', ['course' => $course]) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded hover:bg-indigo-700">
                Continue Learning
            </a>
            <button wire:click="unenroll" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-50">
                Unenroll
            </button>
        </div>
    @else
        @if ($errorMessage)
            <div class="p-3 mb-3 text-sm text-red-700 bg-red-100 border border-red-200 rounded">
                {{ $errorMessage }}
            </div>
        @endif
        <button wire:click="enroll" class="inline-flex items-center px-6 py-3 text-white bg-blue-600 rounded-lg hover:bg-blue-700">
            Enroll Now
        </button>
    @endif
</div>
