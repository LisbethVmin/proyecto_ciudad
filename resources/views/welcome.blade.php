<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Reportes</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#f4f7f6] text-slate-800">

    <!-- NAV -->
    <header class="bg-[#1f6f5b] text-white shadow">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            
            <!-- LOGO -->
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-xl bg-white/15 flex items-center justify-center text-2xl">🏙️</div>
                <div>
                    <p class="text-xs uppercase tracking-[0.25em] text-white/75">Sistema de</p>
                    <h1 class="text-lg font-extrabold">Reportes Santa Cruz</h1>
                </div>
            </div>

            <!-- MENU -->
            <nav class="hidden md:flex items-center gap-8 text-sm font-medium">
                <a href="#inicio" class="hover:text-white">Inicio</a>
                <a href="#reportes" class="hover:text-white">Reportes</a>
                <a href="#estadisticas" class="hover:text-white">Estadísticas</a>
                <a href="#contacto" class="hover:text-white">Contacto</a>
            </nav>

            <!-- LOGIN -->
            <div>
                @auth
                    <a href="/dashboard" class="bg-white text-[#1f6f5b] px-4 py-2 rounded-xl font-semibold">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="bg-white/20 px-4 py-2 rounded-xl hover:bg-white/30">
                        Iniciar sesión
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <!-- HERO -->
    <section id="inicio" class="relative">
        <img src="{{ asset('img/santa-cruz-hero.jpg') }}" class="w-full h-[500px] object-cover">
        <div class="absolute inset-0 bg-black/50"></div>

        <div class="absolute inset-0 flex items-center">
            <div class="max-w-6xl mx-auto px-6 text-white">
                
                <h2 class="text-5xl font-black">
                    Sistema de <span class="text-green-400">Reportes</span>
                </h2>

                <p class="mt-4 text-lg">
                    Mejora tu ciudad reportando problemas fácilmente.
                </p>

                <a href="{{ route('register') }}" 
                   class="mt-6 inline-block bg-green-500 px-6 py-3 rounded-xl font-semibold">
                    Realizar Reporte
                </a>
            </div>
        </div>
    </section>

    <!-- CARDS -->
    <section id="reportes" class="max-w-6xl mx-auto px-6 mt-[-50px] grid md:grid-cols-4 gap-6">

        <div class="bg-white p-6 rounded-2xl shadow">
            <h3 class="font-bold text-lg">Reporte</h3>
            <p class="text-sm text-gray-500 mt-2">Crear reporte ciudadano</p>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow">
            <h3 class="font-bold text-lg">Mis Reportes</h3>
            <p class="text-sm text-gray-500 mt-2">Ver tus reportes</p>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow">
            <h3 class="font-bold text-lg">Estadísticas</h3>
            <p class="text-sm text-gray-500 mt-2">Datos de la ciudad</p>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow">
            <h3 class="font-bold text-lg">Transparencia</h3>
            <p class="text-sm text-gray-500 mt-2">Datos abiertos</p>
        </div>

    </section>

    <!-- STATS -->
    <section id="estadisticas" class="max-w-6xl mx-auto px-6 mt-10 grid md:grid-cols-4 gap-6 text-center">
        <div class="bg-green-100 p-6 rounded-xl">
            <p>Reportes</p>
            <h2 class="text-2xl font-bold">12,456</h2>
        </div>

        <div class="bg-green-100 p-6 rounded-xl">
            <p>En Proceso</p>
            <h2 class="text-2xl font-bold">1,234</h2>
        </div>

        <div class="bg-green-100 p-6 rounded-xl">
            <p>Usuarios</p>
            <h2 class="text-2xl font-bold">8,789</h2>
        </div>

        <div class="bg-green-100 p-6 rounded-xl">
            <p>Tiempo</p>
            <h2 class="text-2xl font-bold">2.4 días</h2>
        </div>
    </section>

    <!-- CTA -->
    <section class="max-w-6xl mx-auto px-6 mt-10 mb-20 grid md:grid-cols-2 gap-6">
        
        <div class="bg-white p-6 rounded-xl shadow">
            <h3 class="font-bold text-xl">¿Cómo funciona?</h3>
            <p class="mt-2 text-gray-600">
                Reporta problemas y haz seguimiento fácilmente.
            </p>
        </div>

        <div class="bg-[#1f6f5b] text-white p-6 rounded-xl shadow">
            <h3 class="font-bold text-xl">Empieza ahora</h3>
            <a href="/crear-reporte" class="block mt-4 bg-white text-[#1f6f5b] px-4 py-2 rounded">
                Registrarse
            </a>
        </div>

    </section>

</body>
</html>