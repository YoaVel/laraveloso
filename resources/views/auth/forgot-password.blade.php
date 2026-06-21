<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        <i class="fas fa-info-circle text-indigo-400 mr-1"></i>
        ¿Olvidaste tu contraseña? No hay problema. Simplemente ingresa tu correo electrónico y te enviaremos un enlace para restablecerla.
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
        @csrf

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Correo electrónico')" class="text-gray-700 font-medium flex items-center gap-2">
                <i class="fas fa-envelope text-sm text-indigo-400"></i>
            </x-input-label>
            <x-text-input id="email" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 shadow-sm" type="email" name="email" :value="old('email')" required autofocus placeholder="ejemplo@correo.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Botón -->
        <div class="flex items-center justify-end">
            <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg shadow-md transition-all hover:shadow-lg">
                <i class="fas fa-paper-plane"></i>
                Enviar enlace de restablecimiento
            </button>
        </div>

        <!-- Volver al login -->
        <p class="text-center text-sm text-gray-600 mt-4">
            <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-800 font-medium hover:underline">
                <i class="fas fa-arrow-left mr-1"></i>
                Volver al inicio de sesión
            </a>
        </p>
    </form>
</x-guest-layout>