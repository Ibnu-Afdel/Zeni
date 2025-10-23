<?php

namespace App\Livewire\Instructor\Course;

use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use Livewire\WithFileUploads;
use Livewire\Component;

class Edit extends Component
{
    use WithFileUploads;

    public $name, $description, $image, $duration, $level;
    public $start_date, $end_date, $status, $enrollment_limit, $requirements;
    public $original_price;
    public ?string $existingImageUrl = null;
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
        $this->original_price = null;
        $this->duration = $course->duration;
        $this->level = $course->level instanceof \BackedEnum
            ? $course->level->value
            : $course->level;
        $this->start_date = $course->start_date ? Carbon::parse($course->start_date)->toDateString() : null;
        $this->end_date = $course->end_date ? Carbon::parse($course->end_date)->toDateString() : null;
        $this->status = $course->status instanceof \BackedEnum
            ? $course->status->value
            : $course->status;
        $this->enrollment_limit = $course->enrollment_limit;
        $this->requirements = $course->requirements;
        $this->discount = (bool) $course->discount;
        $this->discount_type = $course->discount_type;
        $this->discount_value = $course->discount_value;
        $this->is_pro = $course->is_pro;

        // Build existing image preview URL
        $url = null;
        if (method_exists($course, 'getFirstMediaUrl')) {
            $url = $course->getFirstMediaUrl('images') ?: null;
        }
        if (!$url && is_array($course->images ?? null) && isset($course->images['path'])) {
            $url = $this->buildPublicUrlFromPath($course->images['path']);
        } elseif (!$url && is_string($course->images ?? null) && $course->images !== '') {
            $url = $this->buildPublicUrlFromPath($course->images);
        } elseif (!$url && !empty($course->image)) {
            $url = $this->buildPublicUrlFromPath($course->image);
        }
        $this->existingImageUrl = $url;
    }

    public function updateCourse()
    {
        // Normalize enum-backed properties to strings in case Livewire received enum objects
        $this->level = $this->level instanceof \BackedEnum ? $this->level->value : (string) $this->level;
        $this->status = $this->status instanceof \BackedEnum ? $this->status->value : (string) $this->status;

        $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            // price removed: courses are free
            'duration' => 'nullable|numeric|min:1',
            'level' => 'required|in:beginner,intermediate,advanced',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'status' => 'required|in:draft,published,archived',
            'enrollment_limit' => 'nullable|integer|min:1',
            'requirements' => 'nullable|string',
            // 'syllabus' removed
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

        // pricing removed: always free

        $course->update([
            'name' => $this->name,
            'description' => $this->description,
            'images' => $imageData,
            'price' => 0,
            'original_price' => null,
            'duration' => $this->duration,
            'level' => $this->level,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'status' => $this->status,
            'enrollment_limit' => $this->enrollment_limit,
            'requirements' => $this->requirements,
            'discount' => false,
            'discount_type' => null,
            'discount_value' => null,
            'is_pro' => $this->is_pro,
        ]);

        session()->flash('message', 'Course updated successfully.');
        return redirect()->route('instructor.courses.index');
    }
    public function render()
    {
        return view('livewire.instructor.course.edit');
    }

    private function buildPublicUrlFromPath(string $path): string
    {
        $trimmed = ltrim($path, '/');
        if (str_starts_with($trimmed, 'http')) {
            return $trimmed;
        }
        // If already under storage/, keep it, else prefix with storage/
        $relative = str_starts_with($trimmed, 'storage/') ? $trimmed : 'storage/' . $trimmed;
        return asset($relative);
    }
}
