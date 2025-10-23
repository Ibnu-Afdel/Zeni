<div class="grid grid-cols-1 gap-6 md:grid-cols-3">
    <div class="md:col-span-2">
        <div class="p-4 bg-white border border-gray-200 rounded-lg">
            <div class="space-y-6">
                <div class="max-w-2xl">
                    <label for="name" class="block mb-1 text-sm font-medium text-gray-700">Course Name <span class="text-red-500">*</span></label>
                    <input type="text" wire:model.defer="name" id="name" maxlength="120" required
                        class="block w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @error('name')
                        <span class="mt-1 text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <div class="max-w-2xl">
                    <label for="description" class="block mb-1 text-sm font-medium text-gray-700">Description <span class="text-red-500">*</span></label>
                    <textarea wire:model.defer="description" id="description" rows="6" required
                        class="block w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                    @error('description')
                        <span class="mt-1 text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <div class="max-w-2xl">
                    <label for="requirements" class="block mb-1 text-sm font-medium text-gray-700">Requirements (Optional)</label>
                    <textarea wire:model.defer="requirements" id="requirements" rows="3"
                        class="block w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="List any prerequisites, one per line..."></textarea>
                    @error('requirements')
                        <span class="mt-1 text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <div class="md:col-span-1 space-y-6">
        <div class="p-4 bg-white border border-gray-200 rounded-lg">
            <h3 class="mb-3 text-sm font-semibold text-gray-800">Cover Image</h3>
            <div class="flex items-center mt-1 space-x-4">
                @if ($image)
                    <img src="{{ $image->temporaryUrl() }}" class="object-cover w-auto h-16 rounded">
                @elseif (!empty($existingImageUrl))
                    <img src="{{ $existingImageUrl }}" class="object-cover w-auto h-16 rounded">
                @endif
                <input type="file" wire:model="image" id="image"
                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
            </div>
            <div wire:loading wire:target="image" class="mt-1 text-sm text-gray-500">Uploading...</div>
            @error('image')
                <span class="mt-1 text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <div class="p-4 bg-white border border-gray-200 rounded-lg">
            <h3 class="mb-3 text-sm font-semibold text-gray-800">Settings</h3>
            <div class="space-y-4">
                <label class="flex items-center justify-between">
                    <span class="text-sm text-gray-700">Premium Only</span>
                    <input id="is_pro" wire:model="is_pro" type="checkbox"
                        class="w-5 h-5 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                </label>

                <div>
                    <label for="status" class="block mb-1 text-sm font-medium text-gray-700">Status</label>
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

                <div>
                    <label for="level" class="block mb-1 text-sm font-medium text-gray-700">Level</label>
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

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <label for="start_date" class="block mb-1 text-sm font-medium text-gray-700">Start</label>
                        <input type="date" wire:model.defer="start_date" id="start_date"
                            class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @error('start_date')
                            <span class="mt-1 text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="end_date" class="block mb-1 text-sm font-medium text-gray-700">End</label>
                        <input type="date" wire:model.defer="end_date" id="end_date"
                            class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @error('end_date')
                            <span class="mt-1 text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <label for="duration" class="block mb-1 text-sm font-medium text-gray-700">Duration (hrs)</label>
                        <input type="number" wire:model.defer="duration" id="duration" min="1"
                            class="block w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @error('duration')
                            <span class="mt-1 text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="enrollment_limit" class="block mb-1 text-sm font-medium text-gray-700">Enrollment Limit</label>
                        <input type="number" wire:model.defer="enrollment_limit" id="enrollment_limit" min="1"
                            class="block w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            placeholder="Unlimited">
                        @error('enrollment_limit')
                            <span class="mt-1 text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

