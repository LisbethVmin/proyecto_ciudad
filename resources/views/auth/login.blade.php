<x-guest-layout>
    <div class="w-full max-w-md mb-4 flex items-center">
        <a href="/" class="p-3 bg-white/20 backdrop-blur-md rounded-2xl border border-white/30 text-white hover:bg-white/40 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </a>
        <span class="ml-4 font-black text-white uppercase text-xs tracking-widest">Inicio</span>
    </div>

    <div class="w-full max-w-md bg-white rounded-[3.5rem] shadow-2xl p-10 border border-white/20">
        <div class="flex justify-center mb-8">
            <img src="{{ asset('img/Santacruz_reporta_logo3.png') }}" alt="Logo" class="h-16 w-auto pointer-events-none">
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <div>
                <label class="text-[10px] font-black text-gray-400 ml-4 uppercase tracking-widest">Correo Electrónico</label>
                <input type="email" name="correo_electronico" value="{{ old('correo_electronico') }}" required autofocus
                       class="w-full mt-1 bg-gray-50 border-none rounded-2xl p-4 focus:ring-2 focus:ring-[#0f5132] text-gray-700">
            </div>

            <div>
                <label class="text-[10px] font-black text-gray-400 ml-4 uppercase tracking-widest">Contraseña</label>
                <input type="password" name="password" required
                       class="w-full mt-1 bg-gray-50 border-none rounded-2xl p-4 focus:ring-2 focus:ring-[#0f5132] text-gray-700">
            </div>

            <button type="submit" class="w-full bg-[#0f5132] text-white py-5 rounded-2xl font-black text-lg shadow-xl hover:bg-green-900 transition-all active:scale-95">
                INGRESAR
            </button>
        </form>

        <div class="mt-8 text-center pt-6 border-t border-gray-100">
            <a href="{{ route('register') }}" class="text-[#0f5132] font-black uppercase text-xs tracking-widest hover:underline">¿No tienes cuenta? Regístrate</a>
        </div>
    </div>
</x-guest-layout>