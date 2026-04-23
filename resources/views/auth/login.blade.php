<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- CORREO -->
        <div>
            <x-input-label for="correo_electronico" :value="'Correo electrónico'" />

            <x-text-input 
                id="correo_electronico" 
                class="block mt-1 w-full" 
                type="email" 
                name="correo_electronico" 
                :value="old('correo_electronico')" 
                required 
                autofocus 
            />

            <x-input-error :messages="$errors->get('correo_electronico')" class="mt-2" />
        </div>

        <!-- PASSWORD -->
        <div class="mt-4">
            <x-input-label for="password" :value="'Contraseña'" />

            <x-text-input 
                id="password" 
                class="block mt-1 w-full"
                type="password"
                name="password"
                required 
            />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- RECORDAR -->
        <div class="block mt-4">
            <label for="remember" class="inline-flex items-center">
                <input 
                    id="remember" 
                    type="checkbox" 
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" 
                    name="remember"
                >
                <span class="ms-2 text-sm text-gray-600">Recordarme</span>
            </label>
        </div>

        <!-- BOTÓN -->
        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-3">
                Iniciar sesión
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>