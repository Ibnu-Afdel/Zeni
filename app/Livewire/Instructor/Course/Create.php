<?php

namespace App\Livewire\Instructor\Course;

use App\Enums\Course\DiscountType;
use App\Enums\Course\Levels;
use App\Enums\Course\Status;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Enum;
use Livewire\WithFileUploads;
use Livewire\Component;

class Create extends Component
{
    use WithFileUploads;

    public $name, $description, $image, $duration, $level = 'beginner';
    public $start_date, $end_date, $status = 'draft', $enrollment_limit, $requirements, $syllabus;
    public $instructor_id;
    public $is_pro = false;

    public function mount(): void
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'instructor') {
            abort(403, 'Unauthorized action.');
        }
        $this->instructor_id = $user->id;
    }

    public function saveCourse()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'duration' => 'nullable|numeric|min:1',
            'level' => ['required', new Enum(Levels::class)],
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'status' => ['required', new Enum(Status::class)],
            'enrollment_limit' => 'nullable|integer|min:1',
            'requirements' => 'nullable|string',
            'syllabus' => 'nullable|string',
        ]);

        $user = Auth::user();
        if ($user->role !== 'instructor') {
            abort(403, 'You are not authorized to create courses.');
        }

        $course = Course::create([
            'is_pro' => (bool) $this->is_pro,
            'name' => $this->name,
            'description' => $this->description,
            'price' => 0,
            'original_price' => null,
            'duration' => $this->duration,
            'level' => $this->level,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'status' => $this->status,
            'enrollment_limit' => $this->enrollment_limit,
            'requirements' => $this->requirements,
            'instructor_id' => $user->id,
        ]);

        if ($this->image) {
            $course->addMedia($this->image->getRealPath())
                ->usingFileName($this->image->getClientOriginalName())
                ->toMediaCollection('images');
        }

        return redirect()->route('instructor.courses.index');
    }

    public function render()
    {
        return view('livewire.instructor.course.create');
    }
}
