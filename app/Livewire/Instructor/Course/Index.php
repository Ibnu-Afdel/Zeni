<?php

namespace App\Livewire\Instructor\Course;

use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public $courses = [];
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
        $this->loadCourses();
    }

    public function updatedFilterStatus(): void { $this->loadCourses(); }
    public function updatedFilterLevel(): void { $this->loadCourses(); }
    public function updatedFilterPro(): void { $this->loadCourses(); }

    protected function loadCourses(): void
    {
        $user = Auth::user();
        $query = Course::query()->where('instructor_id', $user->id)->latest();
        if ($this->filterStatus) { $query->where('status', $this->filterStatus); }
        if ($this->filterLevel) { $query->where('level', $this->filterLevel); }
        if ($this->filterPro !== null) { $query->where('is_pro', $this->filterPro); }
        $this->courses = $query->get();
    }

    public function publish(int $courseId): void
    {
        $course = Course::findOrFail($courseId);
        $this->authorizeAction($course);
        $course->update(['status' => 'published']);
        $this->loadCourses();
        session()->flash('message', 'Course published.');
    }

    public function unpublish(int $courseId): void
    {
        $course = Course::findOrFail($courseId);
        $this->authorizeAction($course);
        $course->update(['status' => 'draft']);
        $this->loadCourses();
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

    public function deleteCourse(int $courseId): void
    {
        $course = Course::findOrFail($courseId);
        $this->authorizeAction($course);
        $course->delete();
        $this->confirmingDeleteId = null;
        $this->loadCourses();
        session()->flash('message', 'Course deleted.');
    }
    public function render()
    {
        return view('livewire.instructor.course.index');
    }
}
