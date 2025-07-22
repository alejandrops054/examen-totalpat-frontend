<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="base-url" content="{{ config('api.base_url') }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="min-h-screen bg-gray-100">
    <nav class="bg-white shadow mb-4">
        <div class="max-w-7xl mx-auto px-4 py-2 flex justify-end space-x-4">
            @if (session('token'))
                <a href="#" id="logout-link" class="text-blue-600">Cerrar sesión</a>
            @else
                <a href="{{ route('login') }}" class="text-blue-600">Iniciar sesión</a>
            @endif
        </div>
    </nav>

    {{ $slot }}

    @livewireScripts
@stack('scripts')

    <script>
        const logoutLink = document.getElementById('logout-link');
        if (logoutLink) {
            logoutLink.addEventListener('click', (e) => {
                e.preventDefault();
                localStorage.removeItem('token');
                document.cookie = 'token=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
                window.location.href = "{{ route('logout') }}";
            });
        }
    </script>
</body>
</html>
