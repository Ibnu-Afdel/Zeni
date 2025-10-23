<?php

namespace App\Livewire\Instructor\Course;

use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\View\View;

class Index extends Component
{
    public ?string $filterStatus = null; // draft|published|archived|null
    public ?string $filterLevel = null; // beginner|intermediate|advanced|null
    public ?bool $filterPro = null; // true|false|null
    public ?int $confirmingDeleteId = null;

    public function mount(): void
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'instructor') {
            abort(403, 'Unauthorized action.');
        }
    }

    public function publish(Course $course): void
    {
        $this->authorizeAction($course);
        $course->update(['status' => 'published']);
        session()->flash('message', 'Course published.');
    }

    public function unpublish(Course $course): void
    {
        $this->authorizeAction($course);
        $course->update(['status' => 'draft']);
        session()->flash('message', 'Course moved to draft.');
    }

    private function authorizeAction(Course $course): void
    {
        $user = Auth::user();
        if ($course->instructor_id !== $user->id) {
            abort(403, 'Unauthorized');
        }
    }

    public function confirmDelete(int $courseId): void
    {
        $this->confirmingDeleteId = $courseId;
    }

    public function cancelDelete(): void
    {
        $this->confirmingDeleteId = null;
    }

    public function deleteCourse(Course $course): void
    {
        $this->authorizeAction($course);
        $course->delete();
        $this->confirmingDeleteId = null;
        session()->flash('message', 'Course deleted.');
    }
    public function render(): View
    {
        $user = Auth::user();
        $courses = Course::query()
            ->where('instructor_id', $user->id)
            ->latest()
            ->when($this->filterStatus, fn ($q) => $q->where('status', $this->filterStatus))
            ->when($this->filterLevel, fn ($q) => $q->where('level', $this->filterLevel))
            ->when($this->filterPro !== null, fn ($q) => $q->where('is_pro', $this->filterPro))
            ->get();

        return view('livewire.instructor.course.index', [
            'courses' => $courses,
        ]);
    }
}
