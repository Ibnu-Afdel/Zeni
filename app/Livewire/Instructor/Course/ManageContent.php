<?php

namespace App\Livewire\Instructor\Course;

use App\Models\Course as CourseModel;
use App\Models\Lesson;
use App\Models\Section;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Illuminate\View\View;

class ManageContent extends Component
{
    use AuthorizesRequests;

    public CourseModel $course;
    public $sections;

    public $newSectionTitle = '';
    public $editingSectionId = null;
    public $editingSectionTitle = '';

    public $addingLessonToSectionId = null;
    public $newLessonTitle = '';
    public $newLessonContent = '';
    public $newLessonVideoUrl = '';

    public $editingLessonId = null;
    public $editingLessonTitle = '';
    public $editingLessonContent = '';
    public $editingLessonVideoUrl = '';
    public $confirmingDeleteSection = false;
    public $confirmingDeleteLesson = false;
    public $titleToDeleted;

    public function mount(CourseModel $course): void
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'instructor' || $user->id !== $course->instructor_id) {
            abort(403, 'Unauthorized action.');
        }
        $this->course = $course;
        $this->loadSections();
    }

    public function loadSections(): void
    {
        $this->sections = $this->course->sections()
            ->with(['lessons' => fn($query) => $query->orderBy('order')])
            ->orderBy('order')
            ->get();
        $this->resetEditingStates();
    }

    public function resetEditingStates(): void
    {
        $this->newSectionTitle = '';
        $this->editingSectionId = null;
        $this->editingSectionTitle = '';
        $this->addingLessonToSectionId = null;
        $this->newLessonTitle = '';
        $this->newLessonContent = '';
        $this->newLessonVideoUrl = '';
        $this->editingLessonId = null;
        $this->editingLessonTitle = '';
        $this->editingLessonContent = '';
        $this->editingLessonVideoUrl = '';
    }

    public function addSection(): void
    {
        $validated = $this->validate(['newSectionTitle' => 'required|string|max:255']);
        try {
            $maxOrder = $this->course->sections()->max('order') ?? -1;
            $newSection = $this->course->sections()->create([
                'title' => $validated['newSectionTitle'],
                'order' => $maxOrder + 1,
            ]);
            if ($newSection->exists) {
                $this->reset('newSectionTitle');
                $this->loadSections();
                session()->flash('message', 'Section added successfully.');
            } else {
                session()->flash('error', 'Failed to add section.');
            }
        } catch (Exception $e) {
            Log::error('Error adding section: '.$e->getMessage());
            session()->flash('error', 'An error occurred while adding the section.');
        }
    }

    public function startEditingSection(int $sectionId): void
    {
        $section = Section::where('id', $sectionId)->where('course_id', $this->course->id)->first();
        if ($section) {
            $this->resetEditingStates();
            $this->editingSectionId = $section->id;
            $this->editingSectionTitle = $section->title;
        } else {
            session()->flash('error', 'Section not found or could not be edited.');
            $this->resetEditingStates();
        }
    }

    public function updateSection(): void
    {
        $this->validate(['editingSectionTitle' => 'required|string|max:255']);
        if ($this->editingSectionId) {
            $section = Section::find($this->editingSectionId);
            if ($section && $section->course_id == $this->course->id) {
                $section->update(['title' => $this->editingSectionTitle]);
                $this->loadSections();
                session()->flash('message', 'Section updated successfully.');
            } else {
                session()->flash('error', 'Section not found or invalid.');
            }
        }
        $this->resetEditingStates();
    }

    public function confirmDeleteSection(Section $section): int
    {
        $this->titleToDeleted = $section->title;
        return $this->confirmingDeleteSection = $section->id;
    }

    public function deleteSection(int $sectionId): void
    {
        $section = Section::where('id', $sectionId)->where('course_id', $this->course->id)->first();
        if ($section) {
            $section->delete();
            $this->confirmingDeleteSection = false;
            $this->loadSections();
            session()->flash('message', 'Section deleted successfully.');
        } else {
            session()->flash('error', 'Section not found or invalid for deletion.');
            $this->confirmingDeleteSection = false;
        }
    }

    public function startAddingLesson(int $sectionId): void
    {
        $this->resetEditingStates();
        $this->addingLessonToSectionId = $sectionId;
    }

    public function cancelAddingLesson(): void
    {
        $this->resetEditingStates();
    }

    public function addLesson(): void
    {
        $this->validate([
            'newLessonTitle' => 'required|string|max:255',
            'newLessonVideoUrl' => 'nullable|url',
        ]);
        $section = Section::find($this->addingLessonToSectionId);
        if ($section && $section->course_id == $this->course->id) {
            $normalizedVideoUrl = $this->normalizeYouTubeUrl($this->newLessonVideoUrl);
            $maxOrder = $section->lessons()->max('order') ?? -1;
            $section->lessons()->create([
                'title' => $this->newLessonTitle,
                'content' => $this->newLessonContent,
                'video_url' => $normalizedVideoUrl,
                'order' => $maxOrder + 1,
            ]);
            $this->loadSections();
            session()->flash('message', 'Lesson added successfully.');
        } else {
            session()->flash('error', 'Section not found or invalid for adding lesson.');
        }
        $this->resetEditingStates();
    }

    public function startEditingLesson(Lesson $lesson): void
    {
        $this->resetEditingStates();
        $this->editingLessonId = $lesson->id;
        $this->editingLessonTitle = $lesson->title;
        $this->editingLessonContent = $lesson->content;
        $this->editingLessonVideoUrl = $lesson->video_url;
    }

    public function updateLesson(): void
    {
        $this->validate([
            'editingLessonTitle' => 'required|string|max:255',
            'editingLessonVideoUrl' => 'nullable|url',
        ]);
        $lesson = Lesson::with('section')->find($this->editingLessonId);
        if ($lesson && $lesson->section->course_id == $this->course->id) {
            $normalizedVideoUrl = $this->normalizeYouTubeUrl($this->editingLessonVideoUrl);
            $lesson->update([
                'title' => $this->editingLessonTitle,
                'content' => $this->editingLessonContent,
                'video_url' => $normalizedVideoUrl,
            ]);
            $this->loadSections();
            session()->flash('message', 'Lesson updated successfully.');
        } else {
            session()->flash('error', 'Lesson not found or invalid.');
        }
        $this->resetEditingStates();
    }

    public function confirmDeleteLesson(Lesson $lesson): int
    {
        $this->titleToDeleted = $lesson->title;
        return $this->confirmingDeleteLesson = $lesson->id;
    }

    public function deleteLesson(int $lessonId): void
    {
        $lesson = Lesson::with('section')->find($lessonId);
        if ($lesson && $lesson->section->course_id == $this->course->id) {
            $lesson->delete();
            $this->confirmingDeleteLesson = false;
            $this->loadSections();
            session()->flash('message', 'Lesson deleted successfully.');
        } else {
            session()->flash('error', 'Lesson not found or invalid.');
            $this->confirmingDeleteLesson = false;
        }
        $this->resetEditingStates();
    }

    public function render(): View
    {
        return view('livewire.instructor.course.manage-content');
    }

    public function cancelEditingSection(): void
    {
        $this->resetEditingStates();
    }

    public function cancelEditingLesson(): void
    {
        $this->resetEditingStates();
    }

    private function normalizeYouTubeUrl(?string $url): ?string
    {
        if ($url === null || trim($url) === '') {
            return null;
        }

        $url = trim($url);
        $parsed = parse_url($url);
        if ($parsed === false) {
            return $url; // leave as-is if unparsable
        }

        $host = strtolower($parsed['host'] ?? '');
        $path = $parsed['path'] ?? '';
        $query = $parsed['query'] ?? '';

        $videoId = null;

        // youtu.be/<id>
        if (in_array($host, ['youtu.be'])) {
            $videoId = ltrim($path, '/');
        }

        // youtube.com/watch?v=<id>
        if ($videoId === null && str_contains($host, 'youtube.com')) {
            // /watch?v=ID
            if (str_starts_with($path, '/watch')) {
                parse_str($query, $q);
                if (!empty($q['v'])) {
                    $videoId = $q['v'];
                }
            }

            // /shorts/<id>
            if ($videoId === null && str_starts_with($path, '/shorts/')) {
                $videoId = substr($path, strlen('/shorts/'));
            }

            // /embed/<id>
            if ($videoId === null && str_starts_with($path, '/embed/')) {
                $videoId = substr($path, strlen('/embed/'));
            }
        }

        if ($videoId) {
            // strip any additional path segments or params from id
            $videoId = preg_replace('~[^a-zA-Z0-9_-].*$~', '', $videoId) ?? $videoId;
            return 'https://www.youtube-nocookie.com/embed/' . $videoId;
        }

        // Not a recognizable YouTube URL, keep original
        return $url;
    }
}
