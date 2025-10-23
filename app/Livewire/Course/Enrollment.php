<?php

namespace App\Livewire\Course;

use App\Models\Course;
use App\Models\Enrollment as EnrollmentModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Enrollment extends Component
{
    public Course $course;
    public bool $enrollment_status = false;
    public string $successMessage = '';
    public string $errorMessage = '';

    public function mount(Course $course): void
    {
        $this->course = $course;
        $this->enrollment_status = Auth::check()
            ? EnrollmentModel::where('user_id', Auth::id())
                ->where('course_id', $this->course->id)
                ->exists()
            : false;
    }

    public function enroll()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if ($this->course->is_pro && !Auth::user()->is_pro) {
            $this->errorMessage = 'This course is for premium users.';
            return;
        }

        if (!$this->enrollment_status) {
            EnrollmentModel::create([
                'user_id' => Auth::id(),
                'course_id' => $this->course->id,
                'enrolled_at' => now(),
                'completion_status' => 'in-progress',
                'progress' => 0,
            ]);

            $this->enrollment_status = true;
            $this->successMessage = 'You have successfully enrolled in this course!';
            $this->dispatch('user-enrolled');
        }
    }

    public function unenroll()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        EnrollmentModel::where('user_id', Auth::id())
            ->where('course_id', $this->course->id)
            ->delete();

        $this->enrollment_status = false;
        $this->successMessage = '';
        $this->dispatch('user-enrolled');
    }

    public function render()
    {
        return view('livewire.course.enrollment');
    }
}
