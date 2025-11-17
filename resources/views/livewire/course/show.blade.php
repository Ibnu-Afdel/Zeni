@php
    $fullWidth = true;
@endphp

<div class="min-h-screen bg-white dark:bg-gray-900 transition-colors duration-300">
    <!-- Course Header -->
    <div class="px-4 py-6 md:py-8 bg-gray-50 dark:bg-gray-800/50">
        <div class="max-w-7xl mx-auto">
            <x-course.show-header :course="$course" :isInstructor="$isInstructor" />
        </div>
    </div>

    <!-- Course Content -->
    <div class="px-4 py-8 md:py-12">
        <div class="max-w-7xl mx-auto space-y-8">
            <x-course.show-detail-card :course="$course" />
            <x-course.show-requirements-card :course="$course" />
            <livewire:course.components.lesson-list :course="$course" :enrolled="$enrollment_status" />
            <x-course.show-enrollment-card :course="$course" :enrollment_status="$enrollment_status" :continueLearningLesson="$continueLearningLesson" :isNewEnrollment="$isNewEnrollment"  />

            @if ($enrollment_status)
                <livewire:course.components.review-section :course="$course" />
            @endif
        </div>
    </div>
</div> 
