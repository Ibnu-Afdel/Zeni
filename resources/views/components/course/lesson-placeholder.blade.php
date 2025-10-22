<div
    class="flex flex-col items-center justify-center h-full min-h-[400px] py-10 text-center rounded-lg bg-gray-100 border border-dashed border-gray-300">
    <i class="mb-4 text-5xl text-gray-400 fas fa-hand-pointer"></i>
    <p class="text-xl font-medium text-gray-600">
        @if ($sections->isEmpty())
            This course doesn't have any content yet.
        @else
            Select a lesson from the sidebar to get started!
        @endif
    </p>
    <p class="mt-1 text-sm text-gray-500">Choose any lesson to begin learning.</p>
</div>

