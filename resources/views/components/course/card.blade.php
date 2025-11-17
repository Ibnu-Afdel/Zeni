@props(['course', 'is_pro' => false])

<div @class([
  'relative', 
  'flex flex-col overflow-hidden transition-all duration-200 rounded-xl', 
  // Premium & user has pro access
  'bg-yellow-50 dark:bg-yellow-900/10 border border-yellow-200 dark:border-yellow-800/50 hover:shadow-lg hover:border-yellow-300 dark:hover:border-yellow-700' =>
      $course->is_pro && $is_pro,
  // Locked course (premium but user doesn't have access)
  'bg-gray-50 dark:bg-gray-800/50 border border-gray-200 dark:border-gray-700 hover:shadow-lg' => $course->is_locked,
  // Regular course
  'bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 hover:shadow-lg hover:border-primary-200 dark:hover:border-primary-800' => !$course->is_pro && !$course->is_locked,
])>

  @if ($course->discount && $course->discount_value > 0 && ($course->price || $course->original_price))
      <span
          class="absolute z-10 px-2 py-1 text-xs font-semibold text-white bg-red-500 dark:bg-red-600 rounded-lg shadow-md top-3 left-3">
          <i class="fa-solid fa-tag mr-1"></i>
          @if ($course->discount_type === 'percent')
              {{ $course->discount_value }}% OFF
          @else
              {{ number_format($course->discount_value, 0) }} ETB OFF
          @endif
      </span>
  @endif

  @if ($course->is_pro)
      <span @class([
          'absolute z-10 px-2 py-1 text-xs font-semibold rounded-lg shadow-md top-3 right-3',
          'bg-yellow-500 dark:bg-yellow-600 text-white' => $course->is_pro && $is_pro,
          'bg-gray-500 dark:bg-gray-600 text-white' => $course->is_locked,
      ])>
          <i class="fa-solid fa-crown mr-1"></i> Premium
      </span>
  @endif

  @if ($course->getFirstMediaUrl('image'))
  <div class="w-full aspect-[4/3] overflow-hidden bg-gray-200 dark:bg-gray-700">
      <a href="{{ route('course.detail', $course->id) }}"
          @if ($course->is_locked) onclick="return false;" title="Upgrade to Pro to access" @endif
          class="block w-full h-full">
          <img src="{{ $course->getFirstMediaUrl('image') }}" alt="{{ $course->name }}"
              class="object-cover w-full h-full transition-transform duration-300 hover:scale-105 @if ($course->is_locked) opacity-50 dark:opacity-40 @endif">
      </a>
  </div>
  @else
  <div class="w-full aspect-[4/3] bg-gradient-to-br from-primary-50 to-primary-100 dark:from-primary-900/20 dark:to-primary-800/20 flex items-center justify-center">
      <i class="fa-solid fa-book-open text-4xl text-primary-300 dark:text-primary-700"></i>
  </div>
  @endif

  <div class="flex flex-col justify-between flex-grow p-4 md:p-5">
      <div>
          <h2 class="text-base md:text-lg font-semibold text-gray-900 dark:text-white truncate mb-2">
              <a href="{{ route('course.detail', $course->id) }}"
                  @if ($course->is_locked) onclick="return false;" title="Upgrade to Pro to access" @endif
                  class="hover:text-primary-600 dark:hover:text-primary-500 transition-colors @if ($course->is_locked) cursor-not-allowed @endif">
                  {{ $course->name }}
              </a>
          </h2>
          <p class="text-sm text-gray-600 dark:text-gray-400 line-clamp-2">
              {{ $course->description }}
          </p>
      </div>

      <div class="mt-4 space-y-2">
          {{-- Rating - Only show if exists --}}
          @if ($course->rating)
          <div class="flex items-center text-sm">
              <div class="flex text-yellow-500 dark:text-yellow-400">
                  @for ($i = 1; $i <= 5; $i++)
                      @if ($i <= round($course->rating))
                          <i class="fa-solid fa-star text-xs"></i>
                      @else
                          <i class="fa-regular fa-star text-xs text-gray-300 dark:text-gray-600"></i>
                      @endif
                  @endfor
              </div>
              <span class="ml-2 text-xs text-gray-500 dark:text-gray-400">
                  ({{ number_format($course->rating, 1) }})
              </span>
          </div>
          @endif

          {{-- Course Meta Info --}}
          <div class="flex flex-wrap items-center gap-2 md:gap-3 text-xs text-gray-500 dark:text-gray-400">
              {{-- Level --}}
              @if ($course->level)
              <div class="flex items-center gap-1 whitespace-nowrap">
                  <i class="fa-solid fa-signal text-primary-600 dark:text-primary-500"></i>
                  <span class="capitalize">{{ $course->level }}</span>
              </div>
              @endif

              {{-- Duration --}}
              @if ($course->duration)
              <div class="flex items-center gap-1 whitespace-nowrap">
                  <i class="fa-solid fa-clock text-primary-600 dark:text-primary-500"></i>
                  <span>{{ $course->duration }}m</span>
              </div>
              @endif

              {{-- Lessons Count --}}
              @if ($course->lessons_count ?? false)
              <div class="flex items-center gap-1 whitespace-nowrap">
                  <i class="fa-solid fa-list text-primary-600 dark:text-primary-500"></i>
                  <span>{{ $course->lessons_count }} {{ $course->lessons_count == 1 ? 'lesson' : 'lessons' }}</span>
              </div>
              @endif
          </div>

          {{-- Price - Only show if exists --}}
          @if ($course->price || $course->original_price)
          <div>
            @if ($course->discount && $course->discount_value > 0 && $course->final_price < $course->original_price)
                <div class="flex items-baseline gap-2">
                    <span class="text-base md:text-lg font-bold text-primary-600 dark:text-primary-500">
                        {{ number_format($course->final_price, 2) }} ETB
                    </span>
                    <span class="text-xs text-gray-400 dark:text-gray-500 line-through">
                        {{ number_format($course->original_price, 2) }} ETB
                    </span>
                </div>
            @else
                <div class="text-base md:text-lg font-bold text-gray-900 dark:text-white">
                    {{ number_format($course->original_price ?? $course->price, 2) }} ETB
                </div>
            @endif
          </div>
          @endif
        
      </div>
  </div>

  <div class="px-4 md:px-5 pb-4 md:pb-5 mt-auto">
      <a href="{{ route('course.detail', $course) }}" @class([
          'flex items-center justify-center w-full px-4 py-2.5 text-sm font-semibold text-center transition-colors duration-200 rounded-lg',
          'bg-gray-400 dark:bg-gray-600 text-white cursor-not-allowed' => $course->is_locked,
          'bg-primary-600 hover:bg-primary-700 dark:bg-primary-600 dark:hover:bg-primary-700 text-white' => !$course->is_locked,
      ])
          @if ($course->is_locked) onclick="return false;"
          title="Upgrade to Pro to access this course" @endif>
          @if ($course->is_locked)
              <i class="fa-solid fa-lock mr-2"></i>
              Locked
          @else
              <i class="fa-solid fa-arrow-right mr-2"></i>
              View Course
          @endif
      </a>
  </div>
</div>