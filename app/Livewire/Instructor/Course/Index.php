<?php

namespace App\Livewire\Instructor\Course;

use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public $courses = [];

    public function mount(): void
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'instructor') {
            abort(403, 'Unauthorized action.');
        }

        $this->courses = Course::query()
            ->where('instructor_id', $user->id)
            ->latest()
            ->get();
    }

    public function render()
    {
        return view('livewire.instructor.course.index');
    }
}
