<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor Dinámico | Persistencia Local</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: '#FDFDFC',
                        secondary: '#E6E6E6',
                        textMain: '#1b1b1b',
                    }
                }
            }
        }
    </script>
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
                    <a href="#" class="hover:text-indigo-600 transition-colors">Dashboard</a>
                    <a href="#" class="hover:text-indigo-600 transition-colors">Contenido</a>
                    <a href="#" class="hover:text-indigo-600 transition-colors">Acerca de</a>
                </nav>
                <div class="flex items-center gap-2 text-sm text-gray-500 bg-gray-100 px-3 py-1.5 rounded-full">
                    <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                    <span>Modo demo · localStorage</span>
                </div>
            </div>
        </header>

        <!-- MAIN -->
        <main class="flex-grow max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <!-- Hero -->
            <section class="mb-12 text-center md:text-left">
                <div class="bg-gradient-to-r from-indigo-50 to-purple-50 rounded-2xl p-6 md:p-8 border border-indigo-100 shadow-sm">
                    <h2 class="text-3xl md:text-4xl font-extrabold text-gray-800">✍️ Edita tu contenido con persistencia</h2>
                    <p class="text-gray-600 mt-3 max-w-2xl mx-auto md:mx-0">
                        Los datos se guardan automáticamente en tu navegador.
                        <strong class="text-indigo-700">¡Recarga la página y no se pierden!</strong>
                        Más tarde conectaremos a MySQL con Laravel.
                    </p>
                </div>
            </section>

            <!-- Formulario -->
            <section class="mb-12 bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden">
                <div class="bg-gray-50 px-6 py-3 border-b border-gray-200">
                    <h3 class="font-semibold text-gray-700 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                        Panel de edición
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
                            <button type="submit" id="submitBtn" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-6 py-2.5 rounded-lg shadow-md transition flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" /></svg>
                                Guardar elemento
                            </button>
                            <button type="button" id="cancelEditBtn" class="text-gray-500 hover:text-gray-700 bg-gray-100 px-5 py-2.5 rounded-lg transition hidden">Cancelar edición</button>
                        </div>
                    </form>
                </div>
            </section>

            <!-- Lista de elementos -->
            <section>
                <div class="flex justify-between items-center mb-5 flex-wrap gap-2">
                    <h3 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                        📋 Contenido guardado
                        <span id="itemCounter" class="text-sm bg-gray-200 text-gray-700 px-2.5 py-0.5 rounded-full">0</span>
                    </h3>
                    <button id="clearAllBtn" class="text-red-500 hover:text-red-700 text-sm bg-red-50 hover:bg-red-100 px-4 py-1.5 rounded-lg transition">🗑️ Eliminar todo</button>
                </div>
                <div id="itemsContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="col-span-full text-center py-12 text-gray-400">Cargando contenido...</div>
                </div>
            </section>
        </main>

        <!-- FOOTER -->
        <footer class="bg-white border-t border-gray-200 mt-12 py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-gray-500 text-sm">
                <p>🚀 Proyecto base con Laravel + Tailwind | Persistencia local (demo) → Reemplazar por API con MySQL</p>
                <p class="mt-2">Datos guardados en localStorage. Recarga la página y no se pierden.</p>
            </div>
        </footer>
    </div>

    <!-- JavaScript al final del body -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>