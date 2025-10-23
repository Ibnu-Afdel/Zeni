<?php

namespace App\Livewire\Instructor\Course;

use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Livewire\Component;

class Edit extends Component
{
    use WithFileUploads;

    public $name, $description, $image, $price, $duration, $level;
    public $start_date, $end_date, $status, $enrollment_limit, $requirements, $syllabus;
    public $original_price;
    public ?Course $course = null;
    public $discount = false;
    public $discount_type;
    public $discount_value;
    public $is_pro;

    public function mount(Course $course): void
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'instructor' || $user->id !== $course->instructor_id) {
            abort(403, 'Unauthorized action.');
        }

        $this->course = $course;
        $this->name = $course->name;
        $this->description = $course->description;
        $this->price = $course->original_price;
        $this->original_price = $course->original_price;
        $this->duration = $course->duration;
        $this->level = $course->level;
        $this->start_date = $course->start_date;
        $this->end_date = $course->end_date;
        $this->status = $course->status;
        $this->enrollment_limit = $course->enrollment_limit;
        $this->requirements = $course->requirements;
        $this->syllabus = $course->syllabus;
        $this->discount = (bool) $course->discount;
        $this->discount_type = $course->discount_type;
        $this->discount_value = $course->discount_value;
        $this->is_pro = $course->is_pro;
    }

    public function updateCourse()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'original_price' => 'required|numeric|min:0',
            'duration' => 'nullable|numeric|min:1',
            'level' => 'required|in:beginner,intermediate,advanced',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'status' => 'required|in:draft,published,archived',
            'enrollment_limit' => 'nullable|integer|min:1',
            'requirements' => 'nullable|string',
            'syllabus' => 'nullable|string',
            'discount_type' => 'nullable|in:percent,amount',
            'discount_value' => 'nullable|numeric|min:0',
        ]);

        $course = $this->course;

        $imageData = $course->images;
        if ($this->image) {
            if (is_array($course->images) && isset($course->images['path'])) {
                Storage::disk('public')->delete($course->images['path']);
            }
            $path = $this->image->store('course-images', 'public');
            $imageData = ['path' => $path];
        }

        $finalPrice = $this->price;
        if ($this->discount && $this->discount_type === 'percent') {
            $finalPrice = $this->price * ((100 - $this->discount_value) / 100);
        } elseif ($this->discount && $this->discount_type === 'amount') {
            $finalPrice = max(0, $this->price - $this->discount_value);
        }

        $course->update([
            'name' => $this->name,
            'description' => $this->description,
            'images' => $imageData,
            'price' => $finalPrice,
            'original_price' => $this->price,
            'duration' => $this->duration,
            'level' => $this->level,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'status' => $this->status,
            'enrollment_limit' => $this->enrollment_limit,
            'requirements' => $this->requirements,
            'syllabus' => $this->syllabus,
            'discount' => $this->discount,
            'discount_type' => $this->discount_type,
            'discount_value' => $this->discount_value,
            'is_pro' => $this->is_pro,
        ]);

        session()->flash('message', 'Course updated successfully.');
        return redirect()->route('instructor.courses.index');
    }
    public function render()
    {
        return view('livewire.instructor.course.edit');
    }
}
