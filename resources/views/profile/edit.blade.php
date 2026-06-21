<x-app-layout>
    <x-slot name="header">
        <i class="fas fa-user-edit mr-2 text-indigo-500"></i> Mi Perfil
    </x-slot>

    <div class="space-y-8">
        <!-- Tarjeta de información del perfil -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden transition hover:shadow-xl">
            <div class="bg-gradient-to-r from-indigo-50 to-purple-50 px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                    <i class="fas fa-id-card text-indigo-500"></i>
                    Información de perfil
                </h3>
                <p class="text-sm text-gray-600 mt-1">
                    Actualiza la información de tu cuenta y tu dirección de correo electrónico.
                </p>
            </div>
            <div class="p-6">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <!-- Tarjeta de cambio de contraseña -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden transition hover:shadow-xl">
            <div class="bg-gradient-to-r from-red-50 to-orange-50 px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                    <i class="fas fa-lock text-red-500"></i>
                    Cambiar contraseña
                </h3>
                <p class="text-sm text-gray-600 mt-1">
                    Asegúrate de usar una contraseña larga y aleatoria para mantener tu cuenta segura.
                </p>
            </div>
            <div class="p-6">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <!-- Tarjeta de eliminar cuenta (opcional) -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden transition hover:shadow-xl">
            <div class="bg-gradient-to-r from-red-50 to-pink-50 px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                    <i class="fas fa-trash-alt text-red-500"></i>
                    Eliminar cuenta
                </h3>
                <p class="text-sm text-gray-600 mt-1">
                    Una vez que elimines tu cuenta, todos los datos se perderán permanentemente.
                </p>
            </div>
            <div class="p-6">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>