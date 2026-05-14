<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Santa Cruz Reporta - Tutorial de Uso</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.bunny.net/css?family=figtree:400,600,800&display=swap" rel="stylesheet" />

    <style>
        body { font-family: 'Figtree', sans-serif; }
        .bg-sc-verde { background-color: #0f5132; }
        .text-sc-verde { color: #0f5132; }
        
        .hero-section {
            position: relative;
            background-image: linear-gradient(rgba(15, 81, 50, 0.8), rgba(0, 0, 0, 0.6)), url("{{ asset('img/santa-cruz-hero.jpg') }}");
            background-size: cover;
            background-position: center;
            min-height: 85vh;
            display: flex;
            align-items: center;
        }

        /* Prevenir scroll cuando el modal está abierto */
        .overflow-hidden { overflow: hidden; }
    </style>
</head>
<body class="antialiased bg-gray-50 text-gray-900" x-data="{ open: false, modalOpen: false }">

    <nav class="bg-sc-verde text-white sticky top-0 z-50 shadow-xl">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-24 items-center">
                
                <div class="flex items-center">
                    <img src="{{ asset('img/Santacruz_reporta_logo3.png') }}" 
                         alt="Santa Cruz Reporta" 
                         class="h-16 md:h-20 w-auto object-contain pointer-events-none">
                </div>

                <div class="hidden md:flex items-center space-x-8 font-bold text-sm">
                    <button @click="modalOpen = true" class="hover:text-green-200 transition uppercase tracking-widest text-xs">
                        ¿Cómo funciona?
                    </button>
                    
                    @auth
                        <a href="{{ url('/dashboard') }}" class="bg-white text-sc-verde px-8 py-3 rounded-full hover:bg-green-50 transition shadow-lg uppercase">Panel de Control</a>
                    @else
                        <a href="{{ route('login') }}" class="hover:text-green-200 uppercase tracking-widest text-xs">Ingresar</a>
                        <a href="{{ route('register') }}" class="bg-white text-sc-verde px-8 py-3 rounded-full hover:bg-green-50 transition shadow-lg uppercase tracking-widest text-xs text-center">Registrarse</a>
                    @endauth
                </div>

                <div class="md:hidden flex items-center">
                    <button @click="open = !open" class="text-white focus:outline-none p-2 bg-white/10 rounded-xl">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div x-show="open" x-cloak
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             class="md:hidden bg-sc-verde border-t border-white/10 px-4 pt-2 pb-6 space-y-2 shadow-2xl">
            
            <button @click="modalOpen = true; open = false" class="block w-full text-left px-4 py-3 text-base font-bold hover:bg-white/10 rounded-xl transition">
                ¿Cómo funciona?
            </button>

            <div class="pt-4 space-y-3">
                @auth
                    <a href="{{ url('/dashboard') }}" class="block w-full text-center bg-white text-sc-verde py-4 rounded-2xl font-black uppercase">Panel de Control</a>
                @else
                    <a href="{{ route('login') }}" class="block w-full text-center border-2 border-white/30 py-4 rounded-2xl font-bold uppercase">Ingresar</a>
                    <a href="{{ route('register') }}" class="block w-full text-center bg-white text-sc-verde py-4 rounded-2xl font-black uppercase">Registrarse</a>
                @endauth
            </div>
        </div>
    </nav>

    <section class="hero-section">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full text-white">
            <div class="max-w-3xl">
                <h1 class="text-6xl md:text-8xl font-extrabold leading-tight tracking-tighter">
                    Tu voz hace una mejor <br>
                    <span class="text-green-400 uppercase">Santa Cruz</span>
                </h1>
                <p class="mt-6 text-xl md:text-3xl opacity-90 font-medium max-w-2xl leading-relaxed">
                    Reporta baches, alumbrado o basura. Unimos a los ciudadanos con las soluciones reales.
                </p>
                
                <div class="mt-10 flex flex-col sm:flex-row gap-5">
                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-12 py-6 text-xl font-black rounded-3xl text-white bg-green-600 hover:bg-green-700 shadow-2xl transition-all hover:-translate-y-2">
                        EMPEZAR A REPORTAR
                    </a>
                    <button @click="modalOpen = true" class="inline-flex items-center justify-center px-10 py-6 text-lg font-bold rounded-3xl text-white border-2 border-white/50 hover:bg-white hover:text-sc-verde transition-all shadow-xl backdrop-blur-sm">
                        <span class="mr-2">▶</span> Ver Tutorial
                    </button>
                </div>
            </div>
        </div>
    </section>

    <div x-show="modalOpen" 
         class="fixed inset-0 z-[100] overflow-y-auto" 
         x-cloak>
        
        <div class="fixed inset-0 bg-black/90 transition-opacity" @click="modalOpen = false"></div>

        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="relative bg-black rounded-3xl overflow-hidden shadow-2xl max-w-4xl w-full"
                 @click.away="modalOpen = false"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-90"
                 x-transition:enter-end="opacity-100 scale-100">
                
                <button @click="modalOpen = false" class="absolute top-4 right-4 z-10 bg-white/20 hover:bg-white text-white hover:text-black p-2 rounded-full transition">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <div class="aspect-video w-full bg-gray-900">
                    <iframe class="w-full h-full" 
                            src="https://www.youtube.com/embed/dQw4w9WgXcQ" 
                            title="Tutorial Santa Cruz Reporta" 
                            frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen>
                    </iframe>
                </div>

                <div class="p-6 bg-sc-verde text-center">
                    <h3 class="text-white font-black text-xl uppercase tracking-widest">Tutorial de Uso - Santa Cruz Reporta</h3>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-[#0a3622] text-white pt-16 pb-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 border-b border-white/10 pb-12 text-center md:text-left">
                
                <div>
                    <h4 class="text-lg font-black uppercase tracking-widest mb-6 text-green-400">Contacto Directo</h4>
                    <ul class="space-y-4 font-medium">
                        <li>📧 <a href="mailto:reportasantacruz@gmail.com">reportasantacruz@gmail.com</a></li>
                        <li>📞 <a href="tel:+59178180003">+591 78180003</a></li>
                        <li>📍 Santa Cruz de la Sierra, Bolivia</li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-lg font-black uppercase tracking-widest mb-6 text-green-400">Síguenos</h4>
                    <div class="flex justify-center md:justify-start gap-4">
                        <a href="#" class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center hover:bg-white hover:text-[#0f5132] transition-all">
                            <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z"/></svg>
                        </a>
                        <a href="https://wa.me/59178180003" class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center hover:bg-green-500 hover:text-white transition-all">
                            <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.407 3.481 2.241 2.242 3.48 5.226 3.481 8.408-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.301 1.658zm10.967-3.942l.288.171c1.588.944 3.423 1.441 5.293 1.442 5.34.002 9.684-4.342 9.686-9.684.001-2.588-1.007-5.023-2.839-6.855-1.833-1.833-4.267-2.842-6.853-2.843-5.342 0-9.686 4.344-9.688 9.685-.001 2.15.561 4.249 1.626 6.079l.21.36-.994 3.628 3.71-.974z"/></svg>
                        </a>
                    </div>
                </div>
            </div>

            <div class="mt-8 text-center text-[10px] font-bold opacity-30 uppercase tracking-[0.4em]">
                &copy; {{ date('Y') }} Santa Cruz Reporta • Gestión Ciudadana
            </div>
        </div>
    </footer>

</body>
</html>