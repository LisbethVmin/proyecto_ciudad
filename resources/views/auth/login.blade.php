<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-black">

<!-- FONDO -->
<div class="relative h-screen">

    <img src="{{ asset('img/mi-fondo.jpg') }}"
         class="absolute w-full h-full object-cover">

    <div class="absolute w-full h-full bg-black/50"></div>

    <!-- CONTENIDO -->
    <div class="relative z-10 flex h-full items-center justify-center">

        <div class="bg-white p-8 rounded-2xl shadow-2xl w-[400px]">

            <h2 class="text-2xl font-bold text-center text-[#0f5132] mb-6">
                Iniciar Sesión
            </h2>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <input type="email" name="correo_electronico"
                    placeholder="Correo electrónico"
                    class="w-full border p-2 mb-4 rounded"
                    required>

                <input type="password" name="password"
                    placeholder="Contraseña"
                    class="w-full border p-2 mb-4 rounded"
                    required>

                <button class="w-full bg-[#198754] text-white py-2 rounded-lg font-bold hover:bg-[#146c43]">
                    Ingresar
                </button>

            </form>

            <p class="mt-4 text-sm text-center">
                ¿No tienes cuenta?
                <a href="{{ route('register') }}" class="text-green-600 font-semibold">
                    Regístrate
                </a>
            </p>

        </div>

    </div>
</div>

</body>
</html>