<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      x-data="{
          darkMode: localStorage.getItem('theme') === 'dark' || window.matchMedia('(prefers-color-scheme: dark)').matches,
          toggleTheme() {
              this.darkMode = !this.darkMode;
              if (this.darkMode) {
                  document.documentElement.classList.add('dark');
                  localStorage.setItem('theme', 'dark');
              } else {
                  document.documentElement.classList.remove('dark');
                  localStorage.setItem('theme', 'light');
              }
          }
    }"
    x-init="if(darkMode) document.documentElement.classList.add('dark')"
    :class="{ 'dark': darkMode }"
>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Moviebase') }}</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="min-h-screen font-sans antialiased flex flex-col"
      :class="darkMode ? 'bg-gray-950 text-white' : 'bg-gray-50 text-gray-900'">
    <div class="flex flex-col min-h-screen">
        @include('components.layouts.partials.base-navbar')

        <main class="mb-8">
            {{ $slot }}
        </main>

        @include('components.layouts.partials.base-footer')
    </div>

    @livewireScripts
</body>
</html>
