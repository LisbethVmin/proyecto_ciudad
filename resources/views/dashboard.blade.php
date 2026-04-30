<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f4f7f6]">

<!-- NAV -->
<nav class="bg-[#1f6f5b] text-white p-4 flex justify-between items-center">
    <h1 class="text-xl font-bold">Sistema de Reportes</h1>

    <div class="flex items-center gap-4">
        <span>Hola, {{ auth()->user()->nombre }}</span>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="bg-red-500 px-3 py-1 rounded">Salir</button>
        </form>
    </div>
</nav>

<!-- CONTENIDO -->
<div class="max-w-6xl mx-auto mt-10">

    <h2 class="text-3xl font-bold mb-6">Panel de Usuario</h2>

    <div class="grid md:grid-cols-3 gap-6">

        <!-- CREAR REPORTE -->
        <div class="bg-white p-6 rounded-2xl shadow">
            <h3 class="text-xl font-bold mb-2"> Crear Reporte</h3>
            <p class="text-gray-500 mb-4">Reporta un problema en tu zona</p>

            <a href="/crear-reporte" class="bg-green-600 text-white px-4 py-2 rounded">
                Crear
            </a>
        </div>

        <!-- VER REPORTES -->
        <div class="bg-white p-6 rounded-2xl shadow">
            <h3 class="text-xl font-bold mb-2"> Mis Reportes</h3>
            <p class="text-gray-500 mb-4">Mira el estado de tus reportes</p>

            <a href="/reportes" class="bg-blue-600 text-white px-4 py-2 rounded">
                Ver
            </a>
        </div>

        <!-- PERFIL -->
        <div class="bg-white p-6 rounded-2xl shadow">
            <h3 class="text-xl font-bold mb-2"> Mi Perfil</h3>
            <p class="text-gray-500 mb-4">Editar tus datos</p>

            <a href="/profile" class="bg-gray-600 text-white px-4 py-2 rounded">
                Ir
            </a>
        </div>

    </div>

</div>

</body>
</html>