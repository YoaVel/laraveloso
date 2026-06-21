<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor Dinámico | Persistencia Local</title>

    <!-- Configuración de Tailwind (debe ir ANTES del CDN) -->
    <script src="{{ asset('js/tailwind-config.js') }}"></script>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- CSS local -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="bg-[#FDFDFC] dark:bg-[#E6E6E6] text-[#1b1b1b] font-sans antialiased">

    <div class="flex flex-col min-h-screen w-full">
        <!-- HEADER -->
        <header class="bg-white/80 backdrop-blur-sm border-b border-gray-200 sticky top-0 z-10 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center flex-wrap gap-3">
                <div class="flex items-center space-x-2">
                    <div class="h-8 w-8 bg-indigo-600 rounded-lg flex items-center justify-center shadow-md">
                        <span class="text-white font-bold text-lg">G</span>
                    </div>
                    <h1 class="text-2xl font-bold bg-gradient-to-r from-indigo-700 to-purple-700 bg-clip-text text-transparent">Gestor Dinámico</h1>
                </div>

                <nav class="flex space-x-6 text-gray-600 font-medium">
                    @auth
                        <a href="{{ route('dashboard') }}" class="hover:text-indigo-600 transition-colors">Dashboard</a>
                        <a href="#" class="hover:text-indigo-600 transition-colors">Contenido</a>
                        <a href="#" class="hover:text-indigo-600 transition-colors">Acerca de</a>
                    @endauth
                </nav>

                <div class="flex items-center gap-3">
                    @auth
                        <div class="flex items-center gap-3">
                            <div class="flex items-center gap-2">
                                <div class="user-avatar">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                                <span class="text-sm font-medium text-gray-700">{{ Auth::user()->name }}</span>
                            </div>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="auth-button auth-button-logout">
                                    <i class="fas fa-sign-out-alt mr-1"></i> Cerrar sesión
                                </button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="auth-button auth-button-login">
                            <i class="fas fa-sign-in-alt mr-1"></i> Iniciar sesión
                        </a>
                        <a href="{{ route('register') }}" class="auth-button auth-button-register">
                            <i class="fas fa-user-plus mr-1"></i> Registrarse
                        </a>
                    @endauth

                    <div class="flex items-center gap-2 text-sm text-gray-500 bg-gray-100 px-3 py-1.5 rounded-full">
                        <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                        <span>Modo demo · localStorage</span>
                    </div>
                </div>
            </div>
        </header>

        <!-- MAIN -->
        <main class="flex-grow max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-10">
            @auth
                <div class="mb-6 bg-green-50 border border-green-200 rounded-xl p-4 text-green-700">
                    <p class="font-medium"><i class="fas fa-check-circle mr-2"></i> ¡Bienvenido, {{ Auth::user()->name }}!</p>
                    <p class="text-sm">Puedes gestionar tu contenido desde el panel de control.</p>
                </div>
            @endauth

            <!-- Hero -->
            <section class="mb-12 text-center md:text-left">
                <div class="bg-gradient-to-r from-indigo-50 to-purple-50 rounded-2xl p-6 md:p-8 border border-indigo-100 shadow-sm">
                    <h2 class="text-3xl md:text-4xl font-extrabold text-gray-800"><i class="fas fa-pen-fancy mr-2 text-indigo-500"></i> Edita tu contenido con persistencia</h2>
                    <p class="text-gray-600 mt-3 max-w-2xl mx-auto md:mx-0">
                        Los datos se guardan automáticamente en tu navegador.
                        <strong class="text-indigo-700">¡Recarga la página y no se pierden!</strong>
                        Más tarde conectaremos a MySQL con Laravel.
                    </p>
                    @guest
                        <div class="mt-6 flex gap-4 justify-center md:justify-start">
                            <a href="{{ route('register') }}" class="hero-button hero-button-primary">
                                <i class="fas fa-user-plus mr-2"></i> Crear cuenta
                            </a>
                            <a href="{{ route('login') }}" class="hero-button hero-button-secondary">
                                <i class="fas fa-sign-in-alt mr-2"></i> Iniciar sesión
                            </a>
                        </div>
                    @endguest
                </div>
            </section>

            <!-- Formulario -->
            <section class="mb-12 bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden">
                <div class="bg-gray-50 px-6 py-3 border-b border-gray-200">
                    <h3 class="font-semibold text-gray-700 flex items-center gap-2">
                        <i class="fas fa-edit text-indigo-500"></i> Panel de edición
                    </h3>
                </div>
                <div class="p-6">
                    <form id="itemForm" class="space-y-5">
                        <input type="hidden" id="editId" value="">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Título</label>
                            <input type="text" id="title" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition" placeholder="Ej: Nota importante">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Descripción / Contenido</label>
                            <textarea id="content" rows="3" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition" placeholder="Escribe aquí el detalle..."></textarea>
                        </div>
                        <div class="flex flex-wrap gap-3 items-center">
                            <button type="submit" id="submitBtn" class="btn-primary">
                                <i class="fas fa-save mr-2"></i> Guardar elemento
                            </button>
                            <button type="button" id="cancelEditBtn" class="btn-secondary hidden">
                                <i class="fas fa-times mr-2"></i> Cancelar edición
                            </button>
                        </div>
                    </form>
                </div>
            </section>

            <!-- Lista de elementos -->
            <section>
                <div class="flex justify-between items-center mb-5 flex-wrap gap-2">
                    <h3 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                        <i class="fas fa-list-ul text-indigo-500"></i> Contenido guardado
                        <span id="itemCounter" class="text-sm bg-gray-200 text-gray-700 px-2.5 py-0.5 rounded-full">0</span>
                    </h3>
                    <button id="clearAllBtn" class="btn-danger">
                        <i class="fas fa-trash-alt mr-1"></i> Eliminar todo
                    </button>
                </div>
                <div id="itemsContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="col-span-full text-center py-12 text-gray-400"><i class="fas fa-spinner fa-spin mr-2"></i> Cargando contenido...</div>
                </div>
            </section>
        </main>

        <!-- FOOTER -->
        <footer class="bg-white border-t border-gray-200 mt-12 py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-gray-500 text-sm">
                <p><i class="fas fa-rocket mr-1"></i> Proyecto base con Laravel + Tailwind | Persistencia local (demo) → Reemplazar por API con MySQL</p>
                <p class="mt-2"><i class="fas fa-database mr-1"></i> Datos guardados en localStorage. Recarga la página y no se pierden.</p>
            </div>
        </footer>
    </div>

    <!-- JavaScript al final del body -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>