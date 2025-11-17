<div class="relative flex flex-col p-4 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-lg hover:shadow-xl transition-all duration-200 hover:border-primary-300 dark:hover:border-primary-700">
    @if ($course->discount && $course->discount_value > 0)
        <span class="absolute inline-block px-3 py-1 text-xs font-bold text-white bg-red-600 rounded-full top-2 right-2 z-10">
            @if($course->discount_type === 'percent')
                {{ $course->discount_value }}% OFF
            @elseif($course->discount_type === 'amount')
                ${{ number_format($course->discount_value, 2) }} OFF
            @endif
        </span>
    @endif

    @if($course->imageUrl)
        <img src="{{ $course->imageUrl }}" alt="{{ $course->name }}" class="object-cover w-full h-40 mb-4 rounded-lg">
    @endif

    <div class="flex-1">
        <h2 class="text-xl font-semibold text-gray-900 dark:text-white">{{ $course->name }}</h2>
        <p class="mt-2 text-gray-600 dark:text-gray-400">{{ Str::limit($course->description, 100) }}</p>

        <p class="mt-2 text-sm font-semibold text-gray-700 dark:text-gray-300">
            Rating:
            @if($course->rating)
                <span class="text-yellow-500 dark:text-yellow-400">
                    @for($i = 0; $i < floor($course->rating); $i++) ★ @endfor
                    @for($i = 0; $i < (5 - floor($course->rating)); $i++) ☆ @endfor
                </span>
            @else
                <span class="text-gray-400 dark:text-gray-500">No ratings yet</span>
            @endif
        </p>
    </div>

    @php
        $originalPrice = $course->original_price;
        $finalPrice = $originalPrice;

        if ($course->discount && $course->discount_value > 0) {
            if ($course->discount_type === 'percent') {
                $finalPrice = $originalPrice * ((100 - $course->discount_value) / 100);
            } elseif ($course->discount_type === 'amount') {
                $finalPrice = max(0, $originalPrice - $course->discount_value);
            }
        }
    @endphp

    <div class="mt-4">
        @if($course->discount && $course->discount_value > 0)
            <p class="text-lg font-bold text-green-600 dark:text-green-500">{{ number_format($finalPrice, 2) }} USD</p>
            <p class="text-sm text-gray-500 dark:text-gray-400 line-through">{{ number_format($originalPrice, 2) }} USD</p>
        @else
            <p class="text-lg font-bold text-gray-900 dark:text-white">{{ number_format($originalPrice, 2) }} USD</p>
        @endif
    </div>

    <a href="{{ route('course.detail', $course->id) }}" class="mt-4 font-semibold text-primary-600 dark:text-primary-500 hover:text-primary-700 dark:hover:text-primary-400 transition-colors inline-flex items-center">
        View Course
        <i class="fa-solid fa-arrow-right ml-2"></i>
    </a>
</div>
