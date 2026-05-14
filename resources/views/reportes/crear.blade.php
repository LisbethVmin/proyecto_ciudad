<x-app-layout>
    <div class="max-w-2xl mx-auto px-4 py-8">
        <div class="bg-white rounded-[2.5rem] shadow-xl p-8 border border-gray-100">
            <h2 class="text-2xl font-black text-gray-800 mb-6 italic uppercase tracking-tighter">Crear Nuevo Reporte</h2>
            
            @if($tipos->isEmpty())
                <div class="bg-red-100 text-red-600 p-4 rounded-2xl mb-4 text-xs font-bold uppercase">
                    ⚠️ Error: No hay categorías en la base de datos (tabla tipo_problema)
                </div>
            @endif

            <form action="/guardar-reporte" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                
                <div>
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-2">¿Qué está pasando?</label>
                    <input type="text" name="titulo" placeholder="Ej: Bache peligroso..." class="w-full bg-gray-50 border-none rounded-2xl p-4 mt-1 focus:ring-2 focus:ring-[#1f6f5b]" required>
                </div>

                <div>
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-2">Categoría del problema</label>
                    <select name="id_tipo" class="w-full bg-gray-50 border-none rounded-2xl p-4 mt-1 focus:ring-2 focus:ring-[#1f6f5b]" required>
                        <option value="">Selecciona una opción...</option>
                        @foreach($tipos as $t)
                            <option value="{{ $t->id_tipo }}">{{ $t->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-2">Descripción detallada</label>
                    <textarea name="descripcion" rows="3" placeholder="Más detalles aquí..." class="w-full bg-gray-50 border-none rounded-2xl p-4 mt-1 focus:ring-2 focus:ring-[#1f6f5b]" required></textarea>
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-2">Ubicación (Haz clic en el mapa)</label>
                    <div id="mapa" class="w-full h-64 rounded-[2rem] border-4 border-gray-50"></div>
                    <input type="hidden" name="latitud" id="latitud">
                    <input type="hidden" name="longitud" id="longitud">
                </div>

                <div>
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-2">Evidencia Fotográfica</label>
                    <input type="file" name="foto" class="w-full text-xs text-gray-500 mt-1" required>
                </div>

                <button type="submit" class="w-full bg-[#1f6f5b] text-white py-5 rounded-2xl font-black shadow-xl hover:bg-black transition active:scale-95">
                    PUBLICAR REPORTE
                </button>
            </form>
        </div>
    </div>

    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        var mapa = L.map('mapa').setView([-17.7833, -63.1821], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(mapa);
        var marcador;
        mapa.on('click', function(e) {
            if (marcador) mapa.removeLayer(marcador);
            marcador = L.marker(e.latlng).addTo(mapa);
            document.getElementById('latitud').value = e.latlng.lat;
            document.getElementById('longitud').value = e.latlng.lng;
        });
    </script>
</x-app-layout>