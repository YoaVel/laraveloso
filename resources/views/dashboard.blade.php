<x-app-layout>
    <x-slot name="header">
        <i class="fas fa-chart-pie mr-2 text-indigo-500"></i> Panel de Control
    </x-slot>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Tarjeta 1: Bienvenida -->
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-lg border border-gray-100 p-6 transition hover:shadow-xl">
            <div class="flex items-center gap-4">
                <div class="h-16 w-16 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-2xl flex items-center justify-center shadow-lg">
                    <span class="text-white text-2xl font-bold">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </span>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">¡Bienvenido, {{ Auth::user()->name }}! 👋</h2>
                    <p class="text-gray-500 text-sm">
                        <i class="fas fa-calendar-alt mr-1 text-indigo-400"></i>
                        Último acceso: {{ Auth::user()->updated_at->format('d/m/Y H:i') }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Tarjeta 2: Resumen rápido -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 transition hover:shadow-xl">
            <h3 class="text-sm font-medium text-gray-400 uppercase tracking-wider">Resumen</h3>
            <div class="mt-4 space-y-3">
                <div class="flex justify-between items-center">
                    <span class="text-gray-600"><i class="fas fa-sticky-note text-indigo-500 mr-2"></i> Elementos guardados</span>
                    <span class="font-bold text-gray-800" id="dashboardItemCount">0</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600"><i class="fas fa-user text-indigo-500 mr-2"></i> Mi perfil</span>
                    <a href="{{ route('profile.edit') }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">
                        Ver <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600"><i class="fas fa-rocket text-indigo-500 mr-2"></i> Estado</span>
                    <span class="inline-flex items-center gap-1 text-xs text-green-600 bg-green-100 px-2 py-1 rounded-full">
                        <span class="w-1.5 h-1.5 bg-green-600 rounded-full animate-pulse"></span>
                        Activo
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Tarjetas de acceso rápido -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <a href="{{ route('profile.edit') }}" class="group bg-white rounded-2xl shadow-lg border border-gray-100 p-6 transition hover:shadow-xl hover:border-indigo-200 cursor-pointer">
            <div class="flex items-center gap-4">
                <div class="h-12 w-12 bg-indigo-100 rounded-xl flex items-center justify-center group-hover:bg-indigo-200 transition">
                    <i class="fas fa-user-cog text-indigo-600 text-xl"></i>
                </div>
                <div>
                    <h4 class="font-semibold text-gray-800">Mi Perfil</h4>
                    <p class="text-sm text-gray-500">Editar datos personales</p>
                </div>
            </div>
        </a>

        <a href="/" class="group bg-white rounded-2xl shadow-lg border border-gray-100 p-6 transition hover:shadow-xl hover:border-indigo-200 cursor-pointer">
            <div class="flex items-center gap-4">
                <div class="h-12 w-12 bg-purple-100 rounded-xl flex items-center justify-center group-hover:bg-purple-200 transition">
                    <i class="fas fa-sticky-note text-purple-600 text-xl"></i>
                </div>
                <div>
                    <h4 class="font-semibold text-gray-800">Mis Notas</h4>
                    <p class="text-sm text-gray-500">Gestionar contenido</p>
                </div>
            </div>
        </a>

        <a href="#" class="group bg-white rounded-2xl shadow-lg border border-gray-100 p-6 transition hover:shadow-xl hover:border-indigo-200 cursor-pointer">
            <div class="flex items-center gap-4">
                <div class="h-12 w-12 bg-green-100 rounded-xl flex items-center justify-center group-hover:bg-green-200 transition">
                    <i class="fas fa-chart-line text-green-600 text-xl"></i>
                </div>
                <div>
                    <h4 class="font-semibold text-gray-800">Estadísticas</h4>
                    <p class="text-sm text-gray-500">Ver reportes</p>
                </div>
            </div>
        </a>
    </div>

    <!-- Script para sincronizar contador con localStorage -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const stored = localStorage.getItem('gestor_dinamico_items');
            const items = stored ? JSON.parse(stored) : [];
            const counterEl = document.getElementById('dashboardItemCount');
            if (counterEl) {
                counterEl.textContent = items.length;
            }
        });
    </script>
</x-app-layout>