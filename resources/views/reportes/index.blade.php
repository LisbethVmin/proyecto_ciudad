<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reportes Ciudad</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">

    <!-- NAVBAR -->
    <nav class="bg-blue-600 text-white p-4 flex justify-between">
        <h1 class="text-xl font-bold">Sistema de Reportes</h1>

        <div>
            @auth
                <span class="mr-4">Hola, {{ auth()->user()->nombre }}</span>

                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button class="bg-red-500 px-3 py-1 rounded">Salir</button>
                </form>
            @endauth
        </div>
    </nav>

    <!-- CONTENIDO -->
    <div class="max-w-4xl mx-auto mt-6">

        <h2 class="text-2xl font-bold mb-4">Lista de Reportes</h2>

        @foreach($reportes as $r)
            <div class="bg-white shadow-md rounded p-4 mb-4">

                <h3 class="text-lg font-semibold">{{ $r->titulo }}</h3>
                <p class="text-gray-600">{{ $r->descripcion }}</p>

                <div class="mt-2 text-sm text-gray-500">
                    <p><b>Usuario:</b> {{ $r->usuario }}</p>
                    <p><b>Estado:</b> {{ $r->estado }}</p>
                    <p><b>Tipo:</b> {{ $r->tipo }}</p>
                </div>

                @php
                    $img = DB::table('imagen')->where('id_reporte', $r->id_reporte)->first();
                @endphp

                @if($img)
                    <img src="/imagenes/{{ $img->ruta_imagen }}" class="mt-3 rounded w-60">
                @endif

                <!-- ADMIN -->
                @if(auth()->check() && auth()->user()->rol == 'admin')
                    <form method="POST" action="/estado" class="mt-3">
                        @csrf
                        <input type="hidden" name="id_reporte" value="{{ $r->id_reporte }}">

                        <select name="id_estado" class="border p-1 rounded">
                            <option value="1">Pendiente</option>
                            <option value="2">En proceso</option>
                            <option value="3">Solucionado</option>
                        </select>

                        <button class="bg-blue-500 text-white px-3 py-1 rounded">Actualizar</button>
                    </form>
                @endif

                <!-- COMENTARIOS -->
                <h4 class="mt-4 font-semibold">Comentarios:</h4>

                @php
                    $comentarios = DB::table('comentario')
                        ->join('usuario', 'comentario.id_usuario', '=', 'usuario.id_usuario')
                        ->where('comentario.id_reporte', $r->id_reporte)
                        ->select('comentario.*', 'usuario.nombre as usuario')
                        ->get();
                @endphp

                @foreach($comentarios as $c)
                    <p class="text-sm"><b>{{ $c->usuario }}:</b> {{ $c->contenido }}</p>
                @endforeach

                <!-- FORM COMENTAR -->
                <form method="POST" action="/comentarios" class="mt-2 flex gap-2">
                    @csrf
                    <input type="hidden" name="id_reporte" value="{{ $r->id_reporte }}">
                    
                    <input 
                        type="text" 
                        name="contenido" 
                        placeholder="Escribe un comentario"
                        class="border p-1 rounded w-full"
                    >
                    
                    <button class="bg-green-500 text-white px-3 rounded">Enviar</button>
                </form>

            </div>
        @endforeach

    </div>

</body>
</html>