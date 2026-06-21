<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nombre')" class="text-gray-700 font-medium flex items-center gap-2">
                <i class="fas fa-user text-sm text-indigo-400"></i>
            </x-input-label>
            <x-text-input id="name" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 shadow-sm" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Tu nombre completo" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Correo electrónico')" class="text-gray-700 font-medium flex items-center gap-2">
                <i class="fas fa-envelope text-sm text-indigo-400"></i>
            </x-input-label>
            <x-text-input id="email" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 shadow-sm" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="ejemplo@correo.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Contraseña')" class="text-gray-700 font-medium flex items-center gap-2">
                <i class="fas fa-lock text-sm text-indigo-400"></i>
            </x-input-label>
            <x-text-input id="password" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 shadow-sm" type="password" name="password" required autocomplete="new-password" placeholder="Mínimo 8 caracteres" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirmar contraseña')" class="text-gray-700 font-medium flex items-center gap-2">
                <i class="fas fa-check-circle text-sm text-indigo-400"></i>
            </x-input-label>
            <x-text-input id="password_confirmation" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 shadow-sm" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Repite la contraseña" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Botón Register -->
        <div class="flex items-center justify-end">
            <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg shadow-md transition-all hover:shadow-lg">
                <i class="fas fa-user-plus"></i>
                Registrarse
            </button>
        </div>

        <!-- Login -->
        <p class="text-center text-sm text-gray-600 mt-4">
            ¿Ya tienes cuenta?
            <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-800 font-medium hover:underline">
                Inicia sesión aquí
            </a>
        </p>
    </form>
</x-guest-layout>