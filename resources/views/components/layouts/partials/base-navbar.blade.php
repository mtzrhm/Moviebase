<nav class="sticky top-0 z-50 backdrop-blur-lg bg-white/80 dark:bg-gray-900/80 border-b border-gray-200/20 dark:border-gray-800/30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center">
                    <div class="relative flex items-center justify-center w-10 h-10 rounded-xl bg-gradient-to-br from-purple-600 to-indigo-600 shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19.82 2H4.18C2.97 2 2 2.97 2 4.18v15.64C2 21.03 2.97 22 4.18 22h15.64c1.21 0 2.18-.97 2.18-2.18V4.18C22 2.97 21.03 2 19.82 2Z"></path>
                            <path d="M7 2v20"></path>
                            <path d="M17 2v20"></path>
                            <path d="M2 12h20"></path>
                            <path d="M2 7h5"></path>
                            <path d="M2 17h5"></path>
                            <path d="M17 17h5"></path>
                            <path d="M17 7h5"></path>
                        </svg>
                    </div>
                    <span class="ml-3 text-xl font-bold tracking-tight">Moviebase</span>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-1">
                <a href="{{ route('home') }}" class="px-3 py-2 rounded-lg text-sm font-medium hover:bg-gray-100 dark:hover:bg-gray-800 transition-all duration-200">Home</a>
                @auth
                    <a href="{{ route('ratings.index') }}" class="px-3 py-2 rounded-lg text-sm font-medium hover:bg-gray-100 dark:hover:bg-gray-800 transition-all duration-200">Meine Bewertungen</a>
                @endauth

                <div class="ml-3 flex items-center space-x-2">
                    <button
                        @click="darkMode = !darkMode"
                        class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 transition-all duration-200"
                        aria-label="Toggle dark mode"
                    >
                        <template x-if="darkMode">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="5"></circle>
                                <line x1="12" y1="1" x2="12" y2="3"></line>
                                <line x1="12" y1="21" x2="12" y2="23"></line>
                                <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                                <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                                <line x1="1" y1="12" x2="3" y2="12"></line>
                                <line x1="21" y1="12" x2="23" y2="12"></line>
                                <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                                <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
                            </svg>
                        </template>
                        <template x-if="!darkMode">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                            </svg>
                        </template>
                    </button>
                    @auth
                        <a href="{{ route('settings.profile') }}" class="block px-4 py-2 text-sm font-medium text-purple-600 dark:text-purple-400 hover:bg-gray-100 dark:hover:bg-gray-800">Profile</a>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg transition-all duration-200">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 rounded-lg shadow-md hover:shadow-lg transition-all duration-200">
                            Register
                        </a>
                    @endauth
                </div>
            </div>

            <div class="md:hidden flex items-center">
                <button
                    @click="toggleTheme"
                    class="p-2 rounded-full hover:bg-muted transition"
                    :aria-label="darkMode ? 'Wechsle zu Light Mode' : 'Wechsle zu Dark Mode'"
                >
                    <template x-if="darkMode">
                        <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 3v1m0 16v1m8.485-8.485h-1M4.515 12H3m15.364 4.95l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M12 5a7 7 0 000 14 7 7 0 000-14z"/>
                        </svg>
                    </template>
                    <template x-if="!darkMode">
                        <svg class="w-5 h-5 text-gray-700 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M21 12.79A9 9 0 1111.21 3a7 7 0 009.79 9.79z"/>
                        </svg>
                    </template>
                </button>

                <button
                    type="button"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none transition-all duration-200"
                    x-data="{ open: false }"
                    @click="open = !open"
                    aria-expanded="false"
                    :aria-expanded="open.toString()"
                >
                    <span class="sr-only">Open main menu</span>
                    <svg class="h-6 w-6" x-show="!open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg class="h-6 w-6" x-show="open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true" style="display: none;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>

                    <!-- Mobile menu dropdown -->
                    <div
                        x-show="open"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-95"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-95"
                        class="absolute top-16 right-0 w-48 py-2 mt-2 bg-white dark:bg-gray-900 rounded-lg shadow-xl border border-gray-200 dark:border-gray-800"
                        style="display: none;"
                    >
                        <a href="{{ route('home') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800">Home</a>
                        <div class="border-t border-gray-200 dark:border-gray-800 my-2"></div>
                        @if(Auth::guest())
                            <a href="{{ route('login') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800">Login</a>
                            <a href="{{ route('register') }}" class="block px-4 py-2 text-sm font-medium text-purple-600 dark:text-purple-400 hover:bg-gray-100 dark:hover:bg-gray-800">Register</a>
                        @else
                            <a href="{{ route('settings.profile') }}" class="block px-4 py-2 text-sm font-medium text-purple-600 dark:text-purple-400 hover:bg-gray-100 dark:hover:bg-gray-800">Profile</a>
                        @endif
                    </div>
                </button>
            </div>
        </div>
    </div>
</nav>
