<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Reporte - Santa Cruz Reporta</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        #mapa { height: 350px; width: 100%; border-radius: 12px; }
    </style>
</head>
<body class="bg-[#f4f7f6] text-slate-800">

    <header class="bg-[#1f6f5b] text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <a href="/dashboard" class="text-2xl">⬅️</a>
                <h1 class="text-lg font-extrabold">Nuevo Reporte Urbano</h1>
            </div>
            <span class="text-sm font-medium">Santa Cruz de la Sierra</span>
        </div>
    </header>

    <main class="max-w-4xl mx-auto px-6 py-10">
        <div class="bg-white p-8 rounded-2xl shadow-xl">
            
            <form action="{{ url('/guardar-reporte') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div class="grid md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-bold mb-2">Título del Problema</label>
                            <input type="text" name="titulo" placeholder="Ej: Bache profundo en la calle..." 
                                   class="w-full border p-3 rounded-xl focus:ring-2 focus:ring-green-500 outline-none" required>
                        </div>

                        <div>
                            <label class="block text-sm font-bold mb-2">Categoría</label>
                            <select name="id_tipo" class="w-full border p-3 rounded-xl outline-none" required>
                                <option value="1">Baches / Pavimento</option>
                                <option value="2">Alumbrado Público</option>
                                <option value="3">Limpieza y Basura</option>
                                <option value="4">Vandalismo</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-bold mb-2">Descripción</label>
                            <textarea name="descripcion" rows="4" placeholder="Describe brevemente el incidente..." 
                                      class="w-full border p-3 rounded-xl outline-none" required></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-bold mb-2">Fotografía de Evidencia</label>
                            <input type="file" name="imagen" accept="image/*" 
                                   class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100" required>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <label class="block text-sm font-bold mb-2">Ubicación Geográfica (Haz clic en el mapa)</label>
                        <div id="mapa" class="shadow-inner border border-gray-200"></div>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="text-xs text-gray-400">Latitud</label>
                                <input type="text" id="latitud" name="latitud" class="w-full bg-gray-100 p-2 rounded text-sm" readonly required>
                            </div>
                            <div>
                                <label class="text-xs text-gray-400">Longitud</label>
                                <input type="text" id="longitud" name="longitud" class="w-full bg-gray-100 p-2 rounded text-sm" readonly required>
                            </div>
                        </div>
                        <p class="text-xs text-blue-600">📍 Puedes mover el marcador azul para ajustar la ubicación exacta.</p>
                    </div>
                </div>

                <div class="pt-6 border-t">
                    <button type="submit" class="w-full bg-[#1f6f5b] text-white py-4 rounded-xl font-bold text-lg hover:bg-[#145a4a] transition-all shadow-lg">
                        Enviar Reporte Ciudadano
                    </button>
                </div>
            </form>
        </div>
    </main>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        // Coordenadas iniciales (Centro de Santa Cruz de la Sierra)
        const sczCoords = [-17.7833, -63.1821];
        
        // Inicializar Mapa
        const mapa = L.map('mapa').setView(sczCoords, 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(mapa);

        // Crear Marcador movible
        let marcador = L.marker(sczCoords, { draggable: true }).addTo(mapa);

        // Función para actualizar los inputs de latitud y longitud
        function actualizarInputs(lat, lng) {
            document.getElementById('latitud').value = lat.toFixed(6);
            document.getElementById('longitud').value = lng.toFixed(6);
        }

        // Al iniciar, poner las coordenadas por defecto
        actualizarInputs(sczCoords[0], sczCoords[1]);

        // Evento al mover el marcador manualmente
        marcador.on('dragend', function (e) {
            const posicion = marcador.getLatLng();
            actualizarInputs(posicion.lat, posicion.lng);
        });

        // Evento al hacer clic en cualquier parte del mapa
        mapa.on('click', function (e) {
            marcador.setLatLng(e.latlng);
            actualizarInputs(e.latlng.lat, e.latlng.lng);
        });
    </script>
</body>
</html>