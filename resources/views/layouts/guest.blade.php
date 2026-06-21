<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Gestor Dinámico') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Tailwind + Font Awesome + tus estilos -->
    <script src="{{ asset('js/tailwind-config.js') }}"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="font-sans text-gray-900 antialiased bg-gradient-to-br from-indigo-50 via-white to-purple-50 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <!-- Logo / Marca -->
        <div class="text-center mb-6">
            <a href="/" class="inline-flex items-center gap-3">
                <div class="h-12 w-12 bg-indigo-600 rounded-2xl flex items-center justify-center shadow-lg">
                    <span class="text-white font-bold text-2xl">G</span>
                </div>
                <span class="text-2xl font-bold bg-gradient-to-r from-indigo-700 to-purple-700 bg-clip-text text-transparent">
                    Gestor Dinámico
                </span>
            </a>
        </div>

        <!-- Tarjeta de contenido -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden transition hover:shadow-2xl">
            <div class="px-6 py-8 sm:px-8">
                {{ $slot }}
            </div>
        </div>

        <!-- Footer mínimo -->
        <p class="text-center text-xs text-gray-400 mt-6">
            &copy; {{ date('Y') }} Gestor Dinámico. Todos los derechos reservados.
        </p>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>