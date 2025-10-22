<div x-data="{ open: false }" x-on:open-contents.window="open = true">
    <x-course.player-header :course="$course" />

    <div class="flex gap-0 lg:gap-6">

        <div class="hidden md:block md:w-2/5 lg:w-1/3 xl:w-1/4 2xl:w-1/4">
            <x-course.lesson-sidebar :sections="$sections" :currentLesson="$currentLesson" :completedLessons="$completedLessons" />
        </div>

        <main class="w-full p-4 md:p-8 md:w-3/5 lg:w-2/3 xl:w-3/4 2xl:w-3/4 bg-gray-50">
            @if ($currentLesson)

                <h2 class="mb-6 text-3xl font-bold text-gray-800">{{ $currentLesson->title }}</h2>

                @if (session()->has('error'))
                    <div class="relative px-4 py-3 mb-6 text-red-800 bg-red-100 border border-red-300 rounded shadow-sm"
                        role="alert">
                        <strong class="font-semibold"><i class="mr-2 fas fa-exclamation-triangle"></i>Error:</strong>
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif

                <x-course.video-player :currentLesson="$currentLesson" />

                

                @if ($currentLesson->content)
                    <div
                        class="p-6 mt-8 mb-8 prose bg-white border border-gray-200 rounded-lg shadow-sm max-w-none prose-indigo">
                        {!! $currentLesson->content !!}
                    </div>
                @endif

                <x-course.lesson-navigation :currentLesson="$currentLesson" :completedLessons="$completedLessons" :nextLesson="$nextLesson" :previousLesson="$previousLesson" />
            @else
                <x-course.lesson-placeholder :sections="$sections" />
            @endif

            @if ($currentLesson)
                {{-- ...existing lesson content here... --}}

                <livewire:course.lesson-comments :lesson="$currentLesson" :key="'comments' . $currentLesson->id" />
            @endif
        </main>
    </div>

    <div x-show="open" x-transition.opacity class="fixed inset-0 z-40 bg-black/40 md:hidden" x-on:click="open = false"></div>
    <div x-show="open" x-transition x-trap.noscroll.inert="open" class="fixed inset-y-0 right-0 z-50 w-full max-w-sm p-4 overflow-y-auto bg-white shadow-xl md:hidden">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-sm font-semibold tracking-wider text-gray-600 uppercase">Course Contents</h2>
            <button class="p-2 text-gray-500 rounded hover:bg-gray-100" x-on:click="open = false">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <x-course.lesson-sidebar :sections="$sections" :currentLesson="$currentLesson" :completedLessons="$completedLessons" />
    </div>
</div>
