<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Zeni - Course Management System' }}</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    
    @vite('resources/css/app.css')
    @livewireStyles
    {{-- Consider moving Toastr CSS/JS to app.js/app.css via Vite for better bundling --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script>
        // Dark mode initialization - runs before page renders
        function initDarkMode() {
            if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
                return true;
            } else {
                document.documentElement.classList.remove('dark');
                return false;
            }
        }
        
        // Initialize immediately
        initDarkMode();
    </script>
</head>

<body class="antialiased bg-gray-50 dark:bg-gray-900 transition-colors duration-300">

    <header class="bg-white dark:bg-gray-800 shadow-sm sticky top-0 z-50 transition-colors duration-300" 
            x-data="{ 
                open: false, 
                darkMode: localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches),
                toggleDarkMode() {
                    this.darkMode = !this.darkMode;
                    if (this.darkMode) {
                        document.documentElement.classList.add('dark');
                        localStorage.theme = 'dark';
                    } else {
                        document.documentElement.classList.remove('dark');
                        localStorage.theme = 'light';
                    }
                }
            }">
        <div class="container flex items-center justify-between px-4 py-4 mx-auto">
            {{-- Brand Link --}}
            <h1 class="text-xl font-bold text-gray-800 dark:text-white">
                <a href="{{ route('home') }}" class="flex items-center space-x-2">
                    <i class="text-primary-600 dark:text-primary-500 fa-solid fa-graduation-cap"></i>
                    <span>Zeni</span>
                </a>
            </h1>

            {{-- Desktop Navigation --}}
            <nav class="items-center hidden space-x-6 text-sm font-medium text-gray-700 dark:text-gray-300 md:flex">
                <a href="{{ route('courses.index') }}" class="flex items-center hover:text-primary-600 dark:hover:text-primary-500 transition-colors">
                    <i class="mr-1 fa-solid fa-book"></i> Courses
                </a>

                @auth
                    {{-- Dashboard Link based on Role --}}
                    @if (auth()->user()->role === 'student')
                        <a href="{{ route('user.dashboard') }}" class="flex items-center hover:text-primary-600 dark:hover:text-primary-500 transition-colors">
                            <i class="mr-1 fa-solid fa-user-graduate"></i> Dashboard
                        </a>
                    @elseif (auth()->user()->role === 'instructor')
                        <a href="{{ route('instructor.dashboard') }}" class="flex items-center hover:text-primary-600 dark:hover:text-primary-500 transition-colors">
                            <i class="mr-1 fa-solid fa-chalkboard-user"></i> Dashboard
                        </a>
                    @elseif (auth()->user()->role === 'admin')
                        <a href="/admin" class="flex items-center hover:text-primary-600 dark:hover:text-primary-500 transition-colors">
                            <i class="mr-1 fa-solid fa-user-shield"></i> Dashboard
                        </a>
                    @endif

                    {{-- Profile Link for Authenticated Users --}}
                    <a href="{{ route('user.profile', ['username' => auth()->user()->username]) }}"
                        class="flex items-center hover:text-primary-600 dark:hover:text-primary-500 transition-colors">
                        <i class="mr-1 fa-solid fa-user"></i> Profile
                    </a>

                    {{-- Logout Form/Button --}}
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="flex items-center hover:text-red-500 transition-colors">
                            <i class="mr-1 fa-solid fa-right-from-bracket"></i> Logout
                        </button>
                    </form>
                @endauth

                @guest
                    <a href="{{ route('register') }}" class="flex items-center hover:text-primary-600 dark:hover:text-primary-500 transition-colors">
                        <i class="mr-1 fa-solid fa-user-plus"></i> Register
                    </a>
                    <a href="{{ route('login') }}" class="flex items-center hover:text-primary-600 dark:hover:text-primary-500 transition-colors">
                        <i class="mr-1 fa-solid fa-right-to-bracket"></i> Login
                    </a>
                @endguest

                {{-- Dark Mode Toggle (Desktop) --}}
                <button @click="toggleDarkMode()" 
                    class="p-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors"
                    aria-label="Toggle dark mode">
                    <i class="fa-solid fa-moon text-gray-700 dark:text-gray-300" x-show="!darkMode"></i>
                    <i class="fa-solid fa-sun text-gray-700 dark:text-gray-300" x-show="darkMode" x-cloak></i>
                </button>
            </nav>

            {{-- Mobile Menu Button and Dark Mode Toggle --}}
            <div class="flex items-center space-x-2 md:hidden">
                {{-- Dark Mode Toggle (Mobile) --}}
                <button @click="toggleDarkMode()" 
                    class="p-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors"
                    aria-label="Toggle dark mode">
                    <i class="fa-solid fa-moon text-gray-700 dark:text-gray-300" x-show="!darkMode"></i>
                    <i class="fa-solid fa-sun text-gray-700 dark:text-gray-300" x-show="darkMode" x-cloak></i>
                </button>

                <button @click="open = !open" class="p-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors" aria-label="Toggle menu">
                    <i class="fa-solid fa-bars text-gray-700 dark:text-gray-300"></i>
                </button>
            </div>
        </div>

        <div class="md:hidden" x-show="open" x-transition x-cloak>
            <nav class="px-4 pt-2 pb-4 space-y-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
                <a href="{{ route('courses.index') }}" class="flex items-center block hover:text-primary-600 dark:hover:text-primary-500 transition-colors">
                    <i class="mr-1 fa-solid fa-book"></i> Courses
                </a>

                @auth
                    @if (auth()->user()->role === 'student')
                        <a href="{{ route('user.dashboard') }}" class="flex items-center block hover:text-primary-600 dark:hover:text-primary-500 transition-colors">
                            <i class="mr-1 fa-solid fa-user-graduate"></i> Dashboard
                        </a>
                    @elseif (auth()->user()->role === 'instructor')
                        <a href="{{ route('instructor.dashboard') }}" class="flex items-center block hover:text-primary-600 dark:hover:text-primary-500 transition-colors">
                            <i class="mr-1 fa-solid fa-chalkboard-user"></i> Dashboard
                        </a>
                    @elseif (auth()->user()->role === 'admin')
                        <a href="/admin" class="flex items-center block hover:text-primary-600 dark:hover:text-primary-500 transition-colors">
                            <i class="mr-1 fa-solid fa-user-shield"></i> Dashboard
                        </a>
                    @endif

                    {{-- Profile Link for Authenticated Users --}}
                    <a href="{{ route('user.profile', ['username' => auth()->user()->username]) }}"
                        class="flex items-center block hover:text-primary-600 dark:hover:text-primary-500 transition-colors">
                        <i class="mr-1 fa-solid fa-user"></i> Profile
                    </a>

                    {{-- Logout Form/Button --}}
                    <form method="POST" action="{{ route('logout') }}" class="block">
                        @csrf
                        <button type="submit" class="flex items-center w-full text-left hover:text-red-500 transition-colors">
                            <i class="mr-1 fa-solid fa-right-from-bracket"></i> Logout
                        </button>
                    </form>
                @endauth

                @guest
                    <a href="{{ route('register') }}" class="flex items-center block hover:text-primary-600 dark:hover:text-primary-500 transition-colors">
                        <i class="mr-1 fa-solid fa-user-plus"></i> Register
                    </a>
                    <a href="{{ route('login') }}" class="flex items-center block hover:text-primary-600 dark:hover:text-primary-500 transition-colors">
                        <i class="mr-1 fa-solid fa-right-to-bracket"></i> Login
                    </a>
                @endguest
            </nav>
        </div>
    </header>

    <main class="{{ isset($fullWidth) && $fullWidth ? '' : 'container px-4 py-8 mx-auto' }}">
        {{ $slot }}
    </main>

    <footer class="mt-12 text-white bg-gray-900 dark:bg-gray-950 transition-colors duration-300">
        <div
            class="container flex flex-col items-center justify-between px-4 py-8 mx-auto space-y-4 text-center md:flex-row md:space-y-0 md:text-left">
            <p class="text-sm">
                &copy; {{ date('Y') }} Zeni. All rights reserved.
            </p>

            {{-- Footer links (if you add them later) could also have icons --}}
            {{-- <div class="flex space-x-4 text-sm">
                    <a href="#" class="transition hover:text-primary-400">Privacy Policy</a>
                    <a href="#" class="transition hover:text-primary-400">Terms</a>
                    <a href="#" class="transition hover:text-primary-400">Contact</a>
                </div> --}}
        </div>
    </footer>


    @livewireScripts
    @vite('resources/js/app.js')
</body>

</html>
