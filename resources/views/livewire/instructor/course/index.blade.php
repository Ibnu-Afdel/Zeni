<div class="px-4 py-6">
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

    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
        @forelse ($courses as $course)
            <div class="p-4 bg-white border border-gray-200 rounded shadow-sm">
                <h2 class="text-base font-semibold text-gray-900 truncate">{{ $course->name }}</h2>
                <p class="mt-1 text-sm text-gray-600 line-clamp-2">{{ $course->description }}</p>
                <div class="flex items-center justify-between mt-3 text-sm text-gray-500">
                    <span>Status: <span class="font-medium capitalize">{{ $course->status }}</span></span>
                    <span>Price: <span class="font-medium">{{ $course->price }}</span></span>
                </div>
                <div class="flex items-center gap-2 mt-4">
                    <a href="{{ route('courses.edit', ['course' => $course]) }}" class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-50">
                        <i class="mr-2 fas fa-edit"></i>
                        Edit
                    </a>
                    <a href="{{ route('instructor.courses.manage_content', ['course' => $course]) }}" class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-white bg-indigo-600 rounded hover:bg-indigo-700">
                        <i class="mr-2 fas fa-layer-group"></i>
                        Manage Content
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-full">
                <div class="p-6 text-center text-gray-500 bg-white border border-gray-200 rounded">No courses yet.</div>
            </div>
        @endforelse
    </div>
</div>

