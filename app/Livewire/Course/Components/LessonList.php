<?php

namespace App\Livewire\Course\Components;

use App\Models\Course;
use Livewire\Component;

class LessonList extends Component
{
    public Course $course;
    public bool $enrolled = false;

    public function mount(Course $course, bool $enrolled = false): void
    {
        $this->course = $course;
        $this->enrolled = $enrolled;
    }
    public function render()
    {
        $sections = $this->course
            ->sections()
            ->with(['lessons' => fn($q) => $q->orderBy('order')])
            ->orderBy('order')
            ->get();

        return view('livewire.course.components.lesson-list', [
            'sections' => $sections,
        ]);
    }
}
