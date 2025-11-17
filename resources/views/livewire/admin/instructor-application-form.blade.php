@php
    $fullWidth = true;
@endphp

<div class="min-h-screen bg-white dark:bg-gray-900 transition-colors duration-300">
    <div class="px-4 py-8 md:py-12">
        <div class="max-w-2xl mx-auto">
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl shadow-lg p-6 md:p-8">
                <!-- Back Link -->
                <div class="mb-6">
                    <a href="{{ route('user.profile', ['username' => auth()->user()->username]) }}"
                        class="inline-flex items-center text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-primary-600 dark:hover:text-primary-500 transition-colors">
                        <i class="mr-2 fa-solid fa-arrow-left"></i>
                        Back to Profile
                    </a>
                </div>

                @if ($existingApplication)
                    <!-- Application Status Messages -->
                    @if ($existingApplication->status === 'pending')
                        <div class="p-4 mb-6 bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg">
                            <div class="flex items-start gap-3">
                                <div class="flex items-center justify-center w-10 h-10 bg-yellow-100 dark:bg-yellow-900/30 rounded-lg flex-shrink-0">
                                    <i class="fa-solid fa-clock text-yellow-600 dark:text-yellow-400"></i>
                                </div>
                                <div>
                                    <h2 class="text-base font-semibold text-yellow-900 dark:text-yellow-200">Application Under Review</h2>
                                    <p class="text-sm text-yellow-800 dark:text-yellow-300 mt-1">Your application is being reviewed. Please wait for approval from the admin.</p>
                                </div>
                            </div>
                        </div>
                    @elseif ($existingApplication->status === 'approved')
                        <div class="p-4 mb-6 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg">
                            <div class="flex items-start gap-3">
                                <div class="flex items-center justify-center w-10 h-10 bg-green-100 dark:bg-green-900/30 rounded-lg flex-shrink-0">
                                    <i class="fa-solid fa-check-circle text-green-600 dark:text-green-400"></i>
                                </div>
                                <div>
                                    <h2 class="text-base font-semibold text-green-900 dark:text-green-200">You're Approved!</h2>
                                    <p class="text-sm text-green-800 dark:text-green-300 mt-1">
                                        Congratulations! You're now an instructor.
                                        <a href="{{ route('user.profile', ['username' => auth()->user()->username]) }}"
                                            class="font-medium underline hover:text-green-700 dark:hover:text-green-200">Back to Profile</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @elseif ($existingApplication->status === 'rejected')
                        <div class="p-4 mb-6 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg">
                            <div class="flex items-start gap-3">
                                <div class="flex items-center justify-center w-10 h-10 bg-red-100 dark:bg-red-900/30 rounded-lg flex-shrink-0">
                                    <i class="fa-solid fa-times-circle text-red-600 dark:text-red-400"></i>
                                </div>
                                <div>
                                    <h2 class="text-base font-semibold text-red-900 dark:text-red-200">Application Rejected</h2>
                                    <p class="text-sm text-red-800 dark:text-red-300 mt-1">
                                        Unfortunately, your application was rejected.
                                        <a href="{{ route('user.profile', ['username' => auth()->user()->username]) }}"
                                            class="font-medium underline hover:text-red-700 dark:hover:text-red-200">Contact the admins</a> if you believe this is a mistake.
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                @else
                    <!-- Form Header -->
                    <div class="mb-8">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="flex items-center justify-center w-12 h-12 bg-primary-50 dark:bg-primary-900/20 rounded-lg">
                                <i class="fa-solid fa-chalkboard-user text-primary-600 dark:text-primary-500 text-xl"></i>
                            </div>
                            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white">Become an Instructor</h2>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Submit your application — it only takes a few minutes.</p>
                    </div>

                    <!-- Success Message -->
                    @if (session()->has('success'))
                        <div class="p-4 mb-6 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg flex items-start gap-3">
                            <i class="fa-solid fa-circle-check text-green-600 dark:text-green-400 mt-0.5"></i>
                            <span class="text-sm text-green-700 dark:text-green-300">{{ session('success') }}</span>
                        </div>
                    @endif

                    <!-- Application Form -->
                    <form wire:submit.prevent="submit" class="space-y-6">
                        <!-- Personal Information Section -->
                        <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-6">
                            <div class="flex items-center gap-2 mb-4">
                                <i class="fa-solid fa-user text-primary-600 dark:text-primary-500"></i>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Personal Information</h3>
                            </div>

                            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                                <div>
                                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Full Name <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" wire:model.defer="full_name" placeholder="Your full name" required
                                        class="w-full px-4 py-3 text-sm text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-500 focus:border-transparent transition-colors" />
                                    @error('full_name')
                                        <p class="mt-1.5 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Email <span class="text-red-500">*</span>
                                    </label>
                                    <input type="email" wire:model.defer="email" placeholder="you@example.com" required
                                        class="w-full px-4 py-3 text-sm text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-500 focus:border-transparent transition-colors" />
                                    @error('email')
                                        <p class="mt-1.5 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Phone Number <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" wire:model.defer="phone_number" placeholder="+251..." required
                                        class="w-full px-4 py-3 text-sm text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-500 focus:border-transparent transition-colors" />
                                    @error('phone_number')
                                        <p class="mt-1.5 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Date of Birth <span class="text-red-500">*</span>
                                    </label>
                                    <input type="date" wire:model.defer="date_of_birth" required
                                        class="w-full px-4 py-3 text-sm text-gray-900 dark:text-white bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-500 focus:border-transparent transition-colors" />
                                    @error('date_of_birth')
                                        <p class="mt-1.5 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Address</label>
                                    <input type="text" wire:model.defer="adress" placeholder="City, Country"
                                        class="w-full px-4 py-3 text-sm text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-500 focus:border-transparent transition-colors" />
                                    @error('adress')
                                        <p class="mt-1.5 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Professional Information Section -->
                        <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-6">
                            <div class="flex items-center gap-2 mb-4">
                                <i class="fa-solid fa-briefcase text-primary-600 dark:text-primary-500"></i>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Professional Information</h3>
                            </div>

                            <div class="space-y-6">
                                <div>
                                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                        LinkedIn Profile <span class="text-red-500">*</span>
                                    </label>
                                    <input type="url" wire:model.defer="linkedin" placeholder="https://linkedin.com/in/your-profile" required
                                        class="w-full px-4 py-3 text-sm text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-500 focus:border-transparent transition-colors" />
                                    @error('linkedin')
                                        <p class="mt-1.5 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Website (optional)</label>
                                    <input type="url" wire:model.defer="webiste" placeholder="https://yourwebsite.com"
                                        class="w-full px-4 py-3 text-sm text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-500 focus:border-transparent transition-colors" />
                                    @error('webiste')
                                        <p class="mt-1.5 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                                    <div>
                                        <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                            Highest Qualification <span class="text-red-500">*</span>
                                        </label>
                                        <select wire:model.defer="higest_qualification" required
                                            class="w-full px-4 py-3 text-sm text-gray-900 dark:text-white bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-500 focus:border-transparent transition-colors">
                                            <option value="">Select qualification</option>
                                            <option>None</option>
                                            <option>Diploma</option>
                                            <option>Bachelor's</option>
                                            <option>Master's</option>
                                            <option>PhD</option>
                                        </select>
                                        @error('higest_qualification')
                                            <p class="mt-1.5 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                            Current Occupation <span class="text-red-500">*</span>
                                        </label>
                                        <select wire:model.defer="current_ocupation" required
                                            class="w-full px-4 py-3 text-sm text-gray-900 dark:text-white bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-500 focus:border-transparent transition-colors">
                                            <option value="">Select occupation</option>
                                            <option>Student</option>
                                            <option>Freelancer</option>
                                            <option>Full-time Job</option>
                                            <option>Part-time Job</option>
                                            <option>Unemployed</option>
                                        </select>
                                        @error('current_ocupation')
                                            <p class="mt-1.5 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Motivation Section -->
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                Why do you want to become an instructor?
                            </label>
                            <textarea wire:model.defer="reason" rows="5"
                                class="w-full px-4 py-3 text-sm text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-500 focus:border-transparent transition-colors"
                                placeholder="Share your background, teaching experience, or motivation..."></textarea>
                            @error('reason')
                                <p class="mt-1.5 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div>
                            <button type="submit"
                                class="w-full px-6 py-3 text-sm font-semibold text-white bg-primary-600 hover:bg-primary-700 dark:bg-primary-600 dark:hover:bg-primary-700 rounded-lg transition-colors flex items-center justify-center">
                                <i class="fa-solid fa-paper-plane mr-2"></i>
                                <span wire:loading.remove wire:target="submit">Submit Application</span>
                                <span wire:loading wire:target="submit">
                                    <i class="fa-solid fa-spinner fa-spin mr-2"></i>
                                    Submitting...
                                </span>
                            </button>
                        </div>

                        <!-- Privacy Notice -->
                        <p class="text-xs text-center text-gray-500 dark:text-gray-400">
                            <i class="fa-solid fa-lock mr-1"></i>
                            We respect your privacy and only use this data for review.
                        </p>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
