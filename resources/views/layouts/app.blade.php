<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Santa Cruz Reporta</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        .bg-sc-verde { background-color: #0f5132; }
        .text-sc-verde { color: #0f5132; }
    </style>
</head>
<body class="font-sans antialiased bg-[#f4f7f6]">
    <div class="min-h-screen">
        
        <header class="bg-sc-verde text-white shadow-md sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 h-20 flex justify-between items-center">
                
                <div class="flex items-center gap-4">
                    @if(!request()->routeIs('dashboard'))
                        <a href="javascript:history.back()" class="p-2 hover:bg-white/10 rounded-full transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                        </a>
                    @endif
                    
                    <img src="{{ asset('img/Santacruz_reporta_logo3.png') }}" 
                         alt="Logo" 
                         class="h-12 md:h-14 w-auto object-contain pointer-events-none">
                </div>

                <div class="hidden md:flex gap-8 items-center font-bold">
                    <a href="/dashboard" class="hover:text-green-200 transition text-sm">INICIO</a>
                    <a href="/reportes" class="hover:text-green-200 transition text-sm">MIS REPORTES</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="bg-white text-sc-verde px-5 py-2 rounded-xl text-xs font-black shadow-sm">SALIR</button>
                    </form>
                </div>
            </div>
        </header>

        <main class="pb-24 pt-4">
            {{ $slot }}
        </main>

        <nav class="md:hidden fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 px-6 py-3 flex justify-between items-center z-50 shadow-lg">
            <a href="/dashboard" class="{{ request()->routeIs('dashboard') ? 'text-sc-verde' : 'text-gray-400' }} flex flex-col items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span class="text-[10px] font-bold mt-1 uppercase">Inicio</span>
            </a>
            
            <a href="/crear-reporte" class="flex flex-col items-center">
                <div class="bg-sc-verde p-4 rounded-full -mt-12 shadow-xl border-4 border-[#f4f7f6] text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                </div>
                <span class="text-[10px] font-bold text-sc-verde mt-1 uppercase">Reportar</span>
            </a>

            <a href="/reportes" class="{{ request()->is('reportes*') ? 'text-sc-verde' : 'text-gray-400' }} flex flex-col items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                <span class="text-[10px] font-bold mt-1 uppercase">Reportes</span>
            </a>
        </nav>
    </div>
</body>
</html>
