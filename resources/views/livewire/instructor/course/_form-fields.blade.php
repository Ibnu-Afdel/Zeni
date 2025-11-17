<div class="space-y-8">
    <!-- Main Content Section -->
    <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 md:p-8">
        <div class="flex items-center gap-3 mb-6">
            <div class="flex items-center justify-center w-10 h-10 bg-primary-50 dark:bg-primary-900/20 rounded-lg">
                <i class="fa-solid fa-info-circle text-primary-600 dark:text-primary-500"></i>
            </div>
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Course Information</h2>
        </div>

        <div class="space-y-6">
            <!-- Course Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Course Name <span class="text-red-500">*</span>
                </label>
                <input type="text" wire:model.defer="name" id="name" maxlength="120" required
                    placeholder="Enter course name"
                    class="block w-full px-4 py-3 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-500 focus:border-transparent transition-colors">
                @error('name')
                    <span class="mt-1.5 text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
                @enderror
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Description <span class="text-red-500">*</span>
                </label>
                <textarea wire:model.defer="description" id="description" rows="6" required
                    placeholder="Describe what students will learn in this course"
                    class="block w-full px-4 py-3 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-500 focus:border-transparent transition-colors"></textarea>
                @error('description')
                    <span class="mt-1.5 text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
                @enderror
            </div>

            <!-- Requirements -->
            <div>
                <label for="requirements" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Requirements (Optional)
                </label>
                <textarea wire:model.defer="requirements" id="requirements" rows="4"
                    placeholder="List any prerequisites, one per line..."
                    class="block w-full px-4 py-3 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-500 focus:border-transparent transition-colors"></textarea>
                @error('requirements')
                    <span class="mt-1.5 text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    <!-- Settings Section -->
    <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 md:p-8">
        <div class="flex items-center gap-3 mb-6">
            <div class="flex items-center justify-center w-10 h-10 bg-purple-50 dark:bg-purple-900/20 rounded-lg">
                <i class="fa-solid fa-sliders text-purple-600 dark:text-purple-500"></i>
            </div>
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Course Settings</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Status -->
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Status <span class="text-red-500">*</span>
                </label>
                <select wire:model.defer="status" id="status" required
                    class="block w-full px-4 py-3 text-gray-900 dark:text-white bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-500 focus:border-transparent transition-colors">
                    <option value="draft">Draft</option>
                    <option value="published">Published</option>
                    <option value="archived">Archived</option>
                </select>
                @error('status')
                    <span class="mt-1.5 text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
                @enderror
            </div>

            <!-- Level -->
            <div>
                <label for="level" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Level <span class="text-red-500">*</span>
                </label>
                <select wire:model.defer="level" id="level" required
                    class="block w-full px-4 py-3 text-gray-900 dark:text-white bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-500 focus:border-transparent transition-colors">
                    <option value="beginner">Beginner</option>
                    <option value="intermediate">Intermediate</option>
                    <option value="advanced">Advanced</option>
                </select>
                @error('level')
                    <span class="mt-1.5 text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
                @enderror
            </div>

            <!-- Duration -->
            <div>
                <label for="duration" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Duration (minutes)
                </label>
                <input type="number" wire:model.defer="duration" id="duration" min="1"
                    placeholder="e.g., 120"
                    class="block w-full px-4 py-3 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-500 focus:border-transparent transition-colors">
                @error('duration')
                    <span class="mt-1.5 text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
                @enderror
            </div>

            <!-- Enrollment Limit -->
            <div>
                <label for="enrollment_limit" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Enrollment Limit
                </label>
                <input type="number" wire:model.defer="enrollment_limit" id="enrollment_limit" min="1"
                    placeholder="Unlimited"
                    class="block w-full px-4 py-3 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-500 focus:border-transparent transition-colors">
                @error('enrollment_limit')
                    <span class="mt-1.5 text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
                @enderror
            </div>

            <!-- Start Date -->
            <div>
                <label for="start_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Start Date
                </label>
                <input type="date" wire:model.defer="start_date" id="start_date"
                    class="block w-full px-4 py-3 text-gray-900 dark:text-white bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-500 focus:border-transparent transition-colors">
                @error('start_date')
                    <span class="mt-1.5 text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
                @enderror
            </div>

            <!-- End Date -->
            <div>
                <label for="end_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    End Date
                </label>
                <input type="date" wire:model.defer="end_date" id="end_date"
                    class="block w-full px-4 py-3 text-gray-900 dark:text-white bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-500 focus:border-transparent transition-colors">
                @error('end_date')
                    <span class="mt-1.5 text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <!-- Premium Toggle -->
        <div class="mt-6 p-4 bg-purple-50 dark:bg-purple-900/20 border border-purple-200 dark:border-purple-800 rounded-lg">
            <label class="flex items-center justify-between cursor-pointer">
                <div class="flex items-center gap-3">
                    <div class="flex items-center justify-center w-10 h-10 bg-purple-100 dark:bg-purple-900/30 rounded-lg">
                        <i class="fa-solid fa-crown text-purple-600 dark:text-purple-500"></i>
                    </div>
                    <div>
                        <span class="block text-sm font-semibold text-gray-900 dark:text-white">Premium Course</span>
                        <span class="block text-xs text-gray-600 dark:text-gray-400">Only pro members can access</span>
                    </div>
                </div>
                <input id="is_pro" wire:model="is_pro" type="checkbox"
                    class="w-6 h-6 text-purple-600 border-gray-300 dark:border-gray-600 rounded focus:ring-purple-500 dark:focus:ring-purple-500 cursor-pointer">
            </label>
        </div>
    </div>

    <!-- Cover Image Section -->
    <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 md:p-8">
        <div class="flex items-center gap-3 mb-6">
            <div class="flex items-center justify-center w-10 h-10 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                <i class="fa-solid fa-image text-blue-600 dark:text-blue-500"></i>
            </div>
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Cover Image</h2>
        </div>

        <div class="space-y-4">
            <!-- Image Preview -->
            @if ($image)
                <div class="relative">
                    <img src="{{ $image->temporaryUrl() }}" 
                        class="w-full h-48 object-cover rounded-lg border border-gray-200 dark:border-gray-700">
                    <div class="absolute top-2 right-2 px-3 py-1 bg-green-500 text-white text-xs font-semibold rounded-lg">
                        <i class="fa-solid fa-check mr-1"></i> New Image
                    </div>
                </div>
            @elseif (!empty($existingImageUrl))
                <div class="relative">
                    <img src="{{ $existingImageUrl }}" 
                        class="w-full h-48 object-cover rounded-lg border border-gray-200 dark:border-gray-700">
                    <div class="absolute top-2 right-2 px-3 py-1 bg-gray-500 text-white text-xs font-semibold rounded-lg">
                        Current Image
                    </div>
                </div>
            @else
                <div class="w-full h-48 bg-gradient-to-br from-primary-50 to-primary-100 dark:from-primary-900/20 dark:to-primary-800/20 rounded-lg border border-gray-200 dark:border-gray-700 flex items-center justify-center">
                    <div class="text-center">
                        <i class="fa-solid fa-image text-4xl text-primary-300 dark:text-primary-700 mb-2"></i>
                        <p class="text-sm text-gray-500 dark:text-gray-400">No image uploaded</p>
                    </div>
                </div>
            @endif

            <!-- File Input -->
            <div>
                <label for="image" 
                    class="block w-full px-4 py-3 text-center text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-50 dark:bg-gray-700 border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors cursor-pointer">
                    <i class="fa-solid fa-upload mr-2"></i>
                    Choose Image
                    <input type="file" wire:model="image" id="image" class="hidden">
                </label>
                <p class="mt-2 text-xs text-gray-500 dark:text-gray-400 text-center">
                    JPG, PNG or JPEG (MAX. 2MB)
                </p>
            </div>

            <div wire:loading wire:target="image" class="text-sm text-primary-600 dark:text-primary-500 text-center">
                <i class="fa-solid fa-spinner fa-spin mr-2"></i>
                Uploading...
            </div>
            
            @error('image')
                <span class="block text-xs text-red-600 dark:text-red-400 text-center">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>
