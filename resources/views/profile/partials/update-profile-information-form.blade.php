<section>
    <header class="mb-6">
        <h2 class="text-lg font-medium text-gray-900 flex items-center gap-2">
            <i class="fas fa-user-circle text-indigo-500"></i>
            Información personal
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            Actualiza tu nombre y correo electrónico.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-5">
        @csrf
        @method('patch')

        <!-- Nombre -->
        <div>
            <x-input-label for="name" :value="__('Nombre')" class="text-gray-700 font-medium flex items-center gap-2">
                <i class="fas fa-user text-sm text-indigo-400"></i>
            </x-input-label>
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 shadow-sm" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Correo electrónico')" class="text-gray-700 font-medium flex items-center gap-2">
                <i class="fas fa-envelope text-sm text-indigo-400"></i>
            </x-input-label>
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 shadow-sm" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="text-sm text-amber-600 flex items-center gap-1">
                        <i class="fas fa-exclamation-triangle"></i>
                        Tu correo no está verificado.
                    </p>
                    <button form="send-verification" class="mt-1 inline-flex items-center gap-1 text-sm text-indigo-600 hover:text-indigo-700 font-medium">
                        <i class="fas fa-envelope"></i>
                        Haz clic aquí para reenviar el correo de verificación
                    </button>
                </div>
            @endif
        </div>

        <!-- Botón -->
        <div class="flex items-center justify-end gap-3 pt-2 border-t border-gray-200">
            <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg shadow-md transition-all hover:shadow-lg">
                <i class="fas fa-save"></i>
                Guardar cambios
            </button>

            @if (session('status') === 'profile-updated')
                <p class="text-sm text-emerald-600 flex items-center gap-1">
                    <i class="fas fa-check-circle"></i>
                    Guardado
                </p>
            @endif
        </div>
    </form>
</section>