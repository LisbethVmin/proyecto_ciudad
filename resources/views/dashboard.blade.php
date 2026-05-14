<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 pt-6 pb-10">
        <div class="mb-8">
            <h2 class="text-3xl font-extrabold text-gray-800 leading-tight">Hola, {{ auth()->user()->nombre }} 👋</h2>
            <p class="text-gray-500 font-medium">¿Qué quieres hacer hoy en la ciudad?</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
            <div class="bg-white p-4 rounded-3xl shadow-sm border border-gray-100">
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Total</p>
                <p class="text-2xl font-black text-gray-800">15</p>
            </div>
            <div class="bg-white p-4 rounded-3xl shadow-sm border border-gray-100">
                <p class="text-[10px] font-black text-yellow-500 uppercase tracking-widest">Pendientes</p>
                <p class="text-2xl font-black text-gray-800">03</p>
            </div>
            <div class="bg-white p-4 rounded-3xl shadow-sm border border-gray-100">
                <p class="text-[10px] font-black text-blue-500 uppercase tracking-widest">En Proceso</p>
                <p class="text-2xl font-black text-gray-800">02</p>
            </div>
            <div class="bg-white p-4 rounded-3xl shadow-sm border border-gray-100">
                <p class="text-[10px] font-black text-green-600 uppercase tracking-widest">Listos</p>
                <p class="text-2xl font-black text-gray-800">10</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <a href="/crear-reporte" class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex items-center gap-4 hover:bg-green-50 transition-all active:scale-95">
                <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center text-3xl shadow-inner">📸</div>
                <div>
                    <h3 class="font-bold text-gray-800 text-lg">Crear Reporte</h3>
                    <p class="text-xs text-gray-500 font-medium leading-tight">Informa un bache o basura</p>
                </div>
            </a>

            <a href="/reportes" class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex items-center gap-4 hover:bg-blue-50 transition-all active:scale-95">
                <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center text-3xl shadow-inner">📑</div>
                <div>
                    <h3 class="font-bold text-gray-800 text-lg">Mis Reportes</h3>
                    <p class="text-xs text-gray-500 font-medium leading-tight">Ver avances de mis quejas</p>
                </div>
            </a>

            <a href="/profile" class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex items-center gap-4 hover:bg-purple-50 transition-all active:scale-95">
                <div class="w-16 h-16 bg-purple-100 rounded-2xl flex items-center justify-center text-3xl shadow-inner">⚙️</div>
                <div>
                    <h3 class="font-bold text-gray-800 text-lg">Mi Perfil</h3>
                    <p class="text-xs text-gray-500 font-medium leading-tight">Configurar mi cuenta</p>
                </div>
            </a>
        </div>

        <div class="mt-10 bg-[#1f6f5b] p-8 rounded-[2.5rem] text-white shadow-xl relative overflow-hidden">
            <div class="relative z-10">
                <h4 class="font-black text-xl mb-2 italic">💡 Sabías que...</h4>
                <p class="text-sm opacity-90 leading-relaxed max-w-md">Los reportes con foto tienen un 40% más de probabilidad de ser atendidos rápido por la alcaldía de Santa Cruz.</p>
            </div>
            <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-white/10 rounded-full"></div>
        </div>
    </div>
</x-app-layout>