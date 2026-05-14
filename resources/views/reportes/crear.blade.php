<x-app-layout>
    <div class="max-w-2xl mx-auto px-4">
        <div class="bg-white rounded-[2.5rem] shadow-sm p-8 border border-gray-100">
            <form action="/guardar-reporte" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                
                <div class="space-y-4">
                    <div>
                        <label class="text-xs font-black text-gray-400 ml-2 uppercase">Título del Incidente</label>
                        <input type="text" name="titulo" placeholder="Ej: Fuga de agua en el 4to anillo" 
                               class="w-full bg-gray-50 border-none rounded-2xl p-4 mt-1 focus:ring-2 focus:ring-sc-verde text-gray-700 font-medium" required>
                    </div>

                    <div>
                        <label class="text-xs font-black text-gray-400 ml-2 uppercase">Tipo de Problema</label>
                        <select name="id_tipo" class="w-full bg-gray-50 border-none rounded-2xl p-4 mt-1 focus:ring-2 focus:ring-sc-verde text-gray-700 font-medium" required>
                            <option value="1">Limpieza y Basura</option>
                            <option value="2">Baches y Pavimento</option>
                            <option value="3">Alumbrado Público</option>
                        </select>
                    </div>

                    <div>
                        <label class="text-xs font-black text-gray-400 ml-2 uppercase">Descripción</label>
                        <textarea name="descripcion" rows="3" placeholder="Detalla lo que sucede..." 
                                  class="w-full bg-gray-50 border-none rounded-2xl p-4 mt-1 focus:ring-2 focus:ring-sc-verde text-gray-700 font-medium" required></textarea>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-xs font-black text-gray-400 ml-2 uppercase">Ubicación exacta</label>
                    <div id="mapa" class="w-full h-64 rounded-[2rem] shadow-inner z-0"></div>
                    <input type="hidden" name="latitud" id="latitud">
                    <input type="hidden" name="longitud" id="longitud">
                </div>

                <div>
                    <label class="text-xs font-black text-gray-400 ml-2 uppercase">Evidencia Fotográfica</label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-200 border-dashed rounded-[2rem] bg-gray-50">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-300" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-gray-600">
                                <label class="relative cursor-pointer bg-white rounded-md font-bold text-sc-verde hover:text-green-800">
                                    <span>Subir archivo</span>
                                    <input type="file" name="imagen" class="sr-only" accept="image/*" required>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="w-full bg-sc-verde text-white py-5 rounded-2xl font-black text-lg shadow-xl hover:bg-green-900 transition active:scale-95">
                    ENVIAR REPORTE
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