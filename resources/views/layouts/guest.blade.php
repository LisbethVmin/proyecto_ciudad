<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Santa Cruz Reporta - Acceso</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.bunny.net/css?family=figtree:400,600,800&display=swap" rel="stylesheet" />

    <style>
        body { font-family: 'Figtree', sans-serif; }
        .bg-auth-custom {
            background-image: linear-gradient(rgba(15, 81, 50, 0.8), rgba(0, 0, 0, 0.7)), 
                              url("{{ asset('img/mi-fondo.jpg') }}");
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
    </style>
</head>
<body class="antialiased text-gray-900">
    <div class="min-h-screen bg-auth-custom flex flex-col items-center justify-center p-4">
        {{ $slot }}
    </div>
</body>
</html>
