<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Reporte</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
</head>

<body class="bg-black">

<!-- NAVBAR -->
<nav class="bg-[#0f5132] text-white px-8 py-4 flex justify-between items-center">
    <div class="flex items-center gap-3">
        <div class="text-2xl">🏙️</div>
        <div>
            <p class="text-xs opacity-70">SISTEMA DE REPORTES</p>
            <h1 class="font-bold text-lg">SANTA CRUZ DE LA SIERRA</h1>
        </div>
    </div>

    <div class="flex gap-6 text-sm">
        <a href="/" class="hover:underline">Inicio</a>
        <a href="/reportes" class="hover:underline">Mis Reportes</a>
        <a href="#" class="hover:underline">Contacto</a>
    </div>

    <div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="bg-white text-[#0f5132] px-4 py-2 rounded-lg font-semibold">
                Salir
            </button>
        </form>
    </div>
</nav>

<!-- HERO + FORM -->
<div class="relative h-screen">

    <!-- IMAGEN DE FONDO -->
    <img src="{{ asset('img/mi-fondo.jpg') }}"
         class="absolute w-full h-full object-cover">

    <!-- OSCURECER -->
    <div class="absolute w-full h-full bg-black/30"></div>

    <!-- CONTENIDO -->
    <div class="relative z-10 flex h-full items-center justify-between px-16">

        <!-- TEXTO IZQUIERDA -->
        <div class="text-white max-w-xl">
            <h1 class="text-6xl font-extrabold leading-tight">
                CREAR <br> REPORTE
            </h1>

            <p class="mt-4 text-lg opacity-90">
                Juntos construimos una ciudad más segura y transparente
            </p>
        </div>

        <!-- FORMULARIO -->
        <div class="bg-white w-[420px] p-8 rounded-2xl shadow-2xl">

            <h2 class="text-xl font-bold mb-6 text-[#0f5132] flex items-center gap-2">
                📝 Crear Reporte
            </h2>

            <form method="POST" action="/guardar-reporte" enctype="multipart/form-data">
                @csrf

                <!-- TITULO -->
                <label class="text-sm font-semibold">Título</label>
                <input type="text" name="titulo"
                    placeholder="Ingresa el título del reporte"
                    class="w-full border p-2 rounded mt-1 mb-4">

                <!-- DESCRIPCIÓN -->
                <label class="text-sm font-semibold">Descripción</label>
                <textarea name="descripcion"
                    placeholder="Describe el problema o situación..."
                    class="w-full border p-2 rounded mt-1 mb-4"></textarea>

                <!-- TIPO -->
                <label class="text-sm font-semibold">Tipo de Reporte</label>
                <select name="id_tipo"
                    class="w-full border p-2 rounded mt-1 mb-4">
                    <option value="">Selecciona un tipo</option>
                    <option value="1">Basura</option>
                    <option value="2">Bache</option>
                    <option value="3">Alumbrado</option>
                </select>

                <!-- IMAGEN -->
                <label class="text-sm font-semibold">Subir imagen (obligatorio)</label>
                <input type="file" name="imagen"
                    class="w-full border p-2 rounded mt-1 mb-6">

                <!-- BOTÓN -->
                <button
                    class="w-full bg-[#198754] text-white py-3 rounded-lg font-bold hover:bg-[#146c43]">
                    Enviar Reporte
                </button>

                <!-- UBICACIÓN -->
                <label class="text-sm font-semibold">Ubicación</label>

                <div id="mapa" class="w-full h-60 mb-4 rounded"></div>

                <button type="button" onclick="usarUbicacion()" 
                    class="mb-3 bg-blue-500 text-white px-3 py-1 rounded">
                    Usar mi ubicación
                </button>

                <input type="hidden" name="latitud" id="latitud">
                <input type="hidden" name="longitud" id="longitud">

            </form>

        </div>

    </div>
</div>
<script>
    var mapa = L.map('mapa').setView([-17.7833, -63.1821], 13); // Santa Cruz

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: 'Map data © OpenStreetMap'
    }).addTo(mapa);

    var marcador;

    // CLICK EN EL MAPA
    mapa.on('click', function(e) {
        if (marcador) {
            mapa.removeLayer(marcador);
        }

        marcador = L.marker(e.latlng).addTo(mapa);

        document.getElementById('latitud').value = e.latlng.lat;
        document.getElementById('longitud').value = e.latlng.lng;
    });

    // UBICACIÓN REAL
    function usarUbicacion() {
        navigator.geolocation.getCurrentPosition(function(pos) {
            var lat = pos.coords.latitude;
            var lng = pos.coords.longitude;

            mapa.setView([lat, lng], 15);

            if (marcador) {
                mapa.removeLayer(marcador);
            }

            marcador = L.marker([lat, lng]).addTo(mapa);

            document.getElementById('latitud').value = lat;
            document.getElementById('longitud').value = lng;
        });
    }
</script>
</body>
</html>