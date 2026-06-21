<section>
    <header class="mb-6">
        <h2 class="text-lg font-medium text-gray-900 flex items-center gap-2">
            <i class="fas fa-key text-red-500"></i>
            Actualizar contraseña
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            Asegúrate de usar una contraseña larga y aleatoria para mantener tu cuenta segura.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-5">
        @csrf
        @method('put')

        <!-- Contraseña actual -->
        <div>
            <x-input-label for="update_password_current_password" :value="__('Contraseña actual')" class="text-gray-700 font-medium flex items-center gap-2">
                <i class="fas fa-lock text-sm text-red-400"></i>
            </x-input-label>
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full rounded-lg border-gray-300 focus:border-red-500 focus:ring-2 focus:ring-red-200 shadow-sm" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <!-- Nueva contraseña -->
        <div>
            <x-input-label for="update_password_password" :value="__('Nueva contraseña')" class="text-gray-700 font-medium flex items-center gap-2">
                <i class="fas fa-key text-sm text-red-400"></i>
            </x-input-label>
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full rounded-lg border-gray-300 focus:border-red-500 focus:ring-2 focus:ring-red-200 shadow-sm" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <!-- Confirmar contraseña -->
        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirmar contraseña')" class="text-gray-700 font-medium flex items-center gap-2">
                <i class="fas fa-check-circle text-sm text-red-400"></i>
            </x-input-label>
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full rounded-lg border-gray-300 focus:border-red-500 focus:ring-2 focus:ring-red-200 shadow-sm" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Botón -->
        <div class="flex items-center justify-end gap-3 pt-2 border-t border-gray-200">
            <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg shadow-md transition-all hover:shadow-lg">
                <i class="fas fa-save"></i>
                Actualizar contraseña
            </button>

            @if (session('status') === 'password-updated')
                <p class="text-sm text-emerald-600 flex items-center gap-1">
                    <i class="fas fa-check-circle"></i>
                    Contraseña actualizada
                </p>
            @endif
        </div>
    </form>
</section>