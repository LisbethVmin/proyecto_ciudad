<x-guest-layout>
    <div class="w-full max-w-md mb-4 flex items-center">
        <a href="/" class="p-3 bg-white/20 backdrop-blur-md rounded-2xl border border-white/30 text-white hover:bg-white/40 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </a>
        <span class="ml-4 font-black text-white uppercase text-xs tracking-[0.2em]">Crear Cuenta</span>
    </div>

    <div class="w-full max-w-md bg-white rounded-[3.5rem] shadow-2xl p-10">
        <div class="flex justify-center mb-8">
            <img src="{{ asset('img/Santacruz_reporta_logo3.png') }}" alt="Logo" class="h-12 w-auto pointer-events-none">
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf
            <div>
                <label class="text-[10px] font-black text-gray-400 ml-4 uppercase tracking-widest">Nombre</label>
                <input type="text" name="nombre" required
                       class="w-full mt-1 bg-gray-50 border-none rounded-2xl p-4 focus:ring-2 focus:ring-[#0f5132]">
            </div>

            <div>
                <label class="text-[10px] font-black text-gray-400 ml-4 uppercase tracking-widest">Correo Electrónico</label>
                <input type="email" name="correo_electronico" required
                       class="w-full mt-1 bg-gray-50 border-none rounded-2xl p-4 focus:ring-2 focus:ring-[#0f5132]">
            </div>

            <div>
                <label class="text-[10px] font-black text-gray-400 ml-4 uppercase tracking-widest">Contraseña</label>
                <input type="password" name="contrasena" required
                       class="w-full mt-1 bg-gray-50 border-none rounded-2xl p-4 focus:ring-2 focus:ring-[#0f5132]">
            </div>

            <div>
                <label class="text-[10px] font-black text-gray-400 ml-4 uppercase tracking-widest">Confirmar Contraseña</label>
                <input type="password" name="contrasena_confirmation" required
                       class="w-full mt-1 bg-gray-50 border-none rounded-2xl p-4 focus:ring-2 focus:ring-[#0f5132]">
            </div>

            <button type="submit" class="w-full bg-[#0f5132] text-white py-5 rounded-2xl font-black text-lg shadow-xl hover:bg-green-900 transition mt-4">
                REGISTRARME
            </button>
        </form>
    </div>
</x-guest-layout>