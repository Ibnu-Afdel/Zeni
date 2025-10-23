<div class="p-4 bg-white border border-gray-200 rounded-lg shadow-md sm:p-6 lg:p-8">
    <h2 class="pb-4 mb-6 text-xl font-bold text-center text-gray-800 border-b sm:text-2xl">
        Create New Course
    </h2>

    <form wire:submit.prevent="saveCourse" class="space-y-6">
        <div class="relative flex items-start">
            <div class="flex items-center h-5">
                <input id="is_pro" wire:model="is_pro" value="1" type="checkbox"
                    class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
            </div>
            <div class="ml-3 text-sm">
                <label for="is_pro" class="font-medium text-gray-700">Premium</label>
                <p class="text-gray-500">The course is only for pro account users</p>
            </div>
        </div>

        <div>
            <label for="name" class="block mb-1 text-sm font-medium text-gray-700">Course Name <span class="text-red-500">*</span></label>
            <input type="text" wire:model.defer="name" id="name" required
                class="block w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            @error('name')
                <span class="mt-1 text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="description" class="block mb-1 text-sm font-medium text-gray-700">Description <span class="text-red-500">*</span></label>
            <textarea wire:model.defer="description" id="description" rows="4" required
                class="block w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
            @error('description')
                <span class="mt-1 text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="image" class="block mb-1 text-sm font-medium text-gray-700">Course Image (optional)</label>
            <div class="flex items-center mt-1 space-x-4">
                @if ($image)
                    <img src="{{ $image->temporaryUrl() }}" class="object-cover w-auto h-16 rounded">
                @endif
                <input type="file" wire:model="image" id="image"
                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
            </div>
            <div wire:loading wire:target="image" class="mt-1 text-sm text-gray-500">Uploading...</div>
        </div>

        <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-3">
            <div>
                <label for="price" class="block mb-1 text-sm font-medium text-gray-700">Base Price ($) <span class="text-red-500">*</span></label>
                <input type="number" wire:model.defer="price" id="price" step="0.01" min="0" required
                    class="block w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @error('price')
                    <span class="mt-1 text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="level" class="block mb-1 text-sm font-medium text-gray-700">Course Level</label>
                <select wire:model.defer="level" id="level" required
                    class="block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="beginner">Beginner</option>
                    <option value="intermediate">Intermediate</option>
                    <option value="advanced">Advanced</option>
                </select>
                @error('level')
                    <span class="mt-1 text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="status" class="block mb-1 text-sm font-medium text-gray-700">Course Status</label>
                <select wire:model.defer="status" id="status" required
                    class="block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="draft">Draft</option>
                    <option value="published">Published</option>
                    <option value="archived">Archived</option>
                </select>
                @error('status')
                    <span class="mt-1 text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <fieldset class="p-4 space-y-4 border border-gray-300 rounded-md">
            <legend class="px-2 text-sm font-medium text-gray-700">Discount (Optional)</legend>
            <div class="relative flex items-start">
                <div class="flex items-center h-5">
                    <input id="discount" wire:model.live="discount" type="checkbox"
                        class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                </div>
                <div class="ml-3 text-sm">
                    <label for="discount" class="font-medium text-gray-700">Apply Discount</label>
                    <p class="text-gray-500">Enable to set a discount percentage or amount.</p>
                </div>
            </div>
            @if ($discount)
                <div class="grid grid-cols-1 pt-4 border-t border-gray-200 gap-y-6 gap-x-4 sm:grid-cols-2">
                    <div>
                        <label for="discount_type" class="block mb-1 text-sm font-medium text-gray-700">Discount Type <span class="text-red-500">*</span></label>
                        <select wire:model.defer="discount_type" id="discount_type" required
                            class="block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">Select Type</option>
                            <option value="percent">Percentage (%)</option>
                            <option value="amount">Fixed Amount ($)</option>
                        </select>
                        @error('discount_type')
                            <span class="mt-1 text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="discount_value" class="block mb-1 text-sm font-medium text-gray-700">Discount Value <span class="text-red-500">*</span></label>
                        <input type="number" wire:model.defer="discount_value" id="discount_value" step="0.01" min="0" required
                            class="block w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @error('discount_value')
                            <span class="mt-1 text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            @endif
        </fieldset>

        <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-3">
            <div>
                <label for="start_date" class="block mb-1 text-sm font-medium text-gray-700">Start Date</label>
                <input type="date" wire:model.defer="start_date" id="start_date"
                    class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @error('start_date')
                    <span class="mt-1 text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="end_date" class="block mb-1 text-sm font-medium text-gray-700">End Date</label>
                <input type="date" wire:model.defer="end_date" id="end_date"
                    class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @error('end_date')
                    <span class="mt-1 text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="duration" class="block mb-1 text-sm font-medium text-gray-700">Duration (Hours) <span class="text-red-500">*</span></label>
                <input type="number" wire:model.defer="duration" id="duration" min="1" required
                    class="block w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @error('duration')
                    <span class="mt-1 text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div>
            <label for="enrollment_limit" class="block mb-1 text-sm font-medium text-gray-700">Enrollment Limit (Optional)</label>
            <input type="number" wire:model.defer="enrollment_limit" id="enrollment_limit" min="1"
                class="block w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                placeholder="Leave blank for unlimited">
            @error('enrollment_limit')
                <span class="mt-1 text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="requirements" class="block mb-1 text-sm font-medium text-gray-700">Requirements (Optional)</label>
            <textarea wire:model.defer="requirements" id="requirements" rows="3"
                class="block w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                placeholder="List any prerequisites, one per line..."></textarea>
            @error('requirements')
                <span class="mt-1 text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <div class="pt-5 border-t border-gray-200">
            <div class="flex justify-end space-x-3">
                <a href="{{ route('instructor.courses.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Cancel
                </a>
                <button type="submit"
                    class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <span wire:loading.remove wire:target="saveCourse">Create Course</span>
                    <span wire:loading wire:target="saveCourse">Saving...</span>
                </button>
            </div>
        </div>
    </form>
</div>
