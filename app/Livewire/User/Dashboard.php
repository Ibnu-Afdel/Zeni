<?php

namespace App\Livewire\User;

use App\Models\Enrollment;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{
    public $enrolledCourses = [];
    public $completedCourses = [];
    public $inProgressCourses = [];
    public $totalEnrolled = 0;
    public $totalInProgress = 0;
    public $totalCompleted = 0;

    public function mount()
    {
        $user = Auth::user();

        // Fetch enrolled courses
        $enrollments = Enrollment::where('user_id', $user->id)
            ->with('course') // Eager load courses
            ->get();

        // Categorize courses
        $this->completedCourses = $enrollments->filter(fn($e) => $e->completion_status === 'completed')->map->course;
        $this->inProgressCourses = $enrollments->filter(fn($e) => $e->completion_status === 'in-progress')->map->course;
        
        // Calculate stats
        $this->totalEnrolled = $enrollments->count();
        $this->totalInProgress = $this->inProgressCourses->count();
        $this->totalCompleted = $this->completedCourses->count();
    }

    public function render()
    {
        return view('livewire.user.dashboard');
    }

}
