
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($title) ? $title . ' - Laraventory' : 'Laraventory' }}</title>
    <script>
        const stored = localStorage.getItem('laraventory-theme');
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        const isDark = stored ? stored === 'dark' : prefersDark;
        if (isDark) {
            document.documentElement.classList.add('dark');
        }
    </script>
    <link rel="icon" type="image/svg+xml" href="{{ asset('package-open-stroke-rounded.svg') }}">
    <link rel="preconnect" href="<https://fonts.bunny.net>">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="min-h-screen flex flex-col bg-neutral-50 dark:bg-neutral-900 text-neutral-900 dark:text-neutral-100 font-sans">
    <x-navbar />

    <main class="flex-1 container mx-auto px-4 py-8">
        {{ $slot }}
    </main>

    <footer class="text-center p-5 bg-neutral-100 dark:bg-neutral-800 text-neutral-900 dark:text-neutral-100 text-xs">
        <div>
            <p>© {{ date('Y') }} Laraventory - Built with Laravel and ❤️</p>
        </div>
    </footer>
    @livewireScripts
</body>
</html>
