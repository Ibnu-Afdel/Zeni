<?php

namespace App\Livewire\Course\Components;

use App\Models\Course;
use Livewire\Component;

class ReviewSection extends Component
{
    public Course $course;

    public function mount(Course $course): void
    {
        $this->course = $course;
    }
    public function render()
    {
        return view('livewire.course.components.review-section');
    }
}
