<div class="container px-4 py-8 mx-auto">
    <h2 class="mb-6 text-2xl font-bold">Edit Course</h2>

    <form wire:submit.prevent="updateCourse" class="space-y-6">
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Course Name</label>
            <input type="text" wire:model="name" id="name" class="block w-full mt-1" required>
            @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea wire:model="description" id="description" class="block w-full mt-1" required></textarea>
            @error('description') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="image" class="block text-sm font-medium text-gray-700">Course Image</label>
            @if($image && is_object($image))
                <img src="{{ $image->temporaryUrl() }}" alt="Course Image" class="object-cover w-32 h-32 mb-2">
            @endif
            <input type="file" wire:model="image" id="image" class="block w-full mt-1">
            @error('image') <span class="text-red-500">{{ $message }}</span> @enderror
            <div wire:loading wire:target="image">Uploading...</div>
        </div>

        <div>
            <label for="price" class="block text-sm font-medium text-gray-700">Course Price</label>
            <input type="number" wire:model="original_price" id="price" class="block w-full mt-1" required>
            @error('price') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="inline-flex items-center">
                <input type="checkbox" wire:model="discount" class="form-checkbox">
                <span class="ml-2">Apply Discount</span>
            </label>
        </div>

        <div>
            <label for="discount_type" class="block text-sm font-medium text-gray-700">Discount Type</label>
            <select wire:model="discount_type" id="discount_type" class="block w-full mt-1">
                <option value="">Select Type</option>
                <option value="percent">Percentage</option>
                <option value="amount">Fixed Amount</option>
            </select>
            @error('discount_type') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="discount_value" class="block text-sm font-medium text-gray-700">Discount Value</label>
            <input type="number" wire:model="discount_value" id="discount_value" class="block w-full mt-1">
            @error('discount_value') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="level" class="block text-sm font-medium text-gray-700">Course Level</label>
            <select wire:model="level" id="level" class="block w-full mt-1">
                <option value="beginner">Beginner</option>
                <option value="intermediate">Intermediate</option>
                <option value="advanced">Advanced</option>
            </select>
            @error('level') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
            <input type="date" wire:model="start_date" id="start_date" class="block w-full mt-1">
            @error('start_date') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
            <input type="date" wire:model="end_date" id="end_date" class="block w-full mt-1">
            @error('end_date') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="duration" class="block text-sm font-medium text-gray-700">Course Duration (hours)</label>
            <input type="number" wire:model="duration" id="duration" class="block w-full mt-1">
            @error('duration') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="enrollment_limit" class="block text-sm font-medium text-gray-700">Enrollment Limit</label>
            <input type="number" wire:model="enrollment_limit" id="enrollment_limit" class="block w-full mt-1">
            @error('enrollment_limit') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="requirements" class="block text-sm font-medium text-gray-700">Course Requirements</label>
            <textarea wire:model="requirements" id="requirements" class="block w-full mt-1"></textarea>
            @error('requirements') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="syllabus" class="block text-sm font-medium text-gray-700">Course Syllabus</label>
            <textarea wire:model="syllabus" id="syllabus" class="block w-full mt-1"></textarea>
            @error('syllabus') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded">Update Course</button>
    </form>
</div>
<div>
    {{-- Success is as dangerous as failure. --}}
</div>
