<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mapa de Reportes</title>

    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
</head>
<body>

<div id="mapa" style="height: 100vh;"></div>

<script>
    var mapa = L.map('mapa').setView([-17.7833, -63.1821], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: 'Map data © OpenStreetMap'
    }).addTo(mapa);

    var reportes = @json($reportes ?? []);

    // ICONOS
    var iconoRojo = L.icon({
        iconUrl: 'https://maps.google.com/mapfiles/ms/icons/red-dot.png'
    });

    var iconoVerde = L.icon({
        iconUrl: 'https://maps.google.com/mapfiles/ms/icons/green-dot.png'
    });

    reportes.forEach(r => {
        if (r.latitud && r.longitud) {

            var icono = (r.id_estado == 1) ? iconoRojo : iconoVerde;

            var imagenHTML = '';

            if (r.ruta_imagen) {
                imagenHTML = "<br><img src='/img/" + r.ruta_imagen + "' width='150'>";
            }

            L.marker([r.latitud, r.longitud], { icon: icono })
                .addTo(mapa)
                .bindPopup(
                    "<b>" + r.titulo + "</b><br>" +
                    r.descripcion + "<br>" +
                    "<b>Estado:</b> " + (r.id_estado == 1 ? "Pendiente" : "Atendido") +
                    imagenHTML
                );
        }
    });
</script>

</body>
</html>