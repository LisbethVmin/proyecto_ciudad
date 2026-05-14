<x-app-layout>
    <div class="max-w-3xl mx-auto px-4 pt-6 pb-24">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-3xl font-black text-gray-800 tracking-tighter uppercase italic">Lista de Reportes</h2>
                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-[0.2em] mt-1">Santa Cruz de la Sierra</p>
            </div>
            <a href="/crear-reporte" class="hidden md:block bg-[#1f6f5b] text-white px-6 py-3 rounded-2xl font-black text-xs shadow-lg hover:bg-black transition-all">
                NUEVO REPORTE
            </a>
        </div>

        @forelse($reportes as $r)
            <div class="bg-white rounded-[2.5rem] p-6 mb-6 shadow-sm border border-gray-100 transition-all">
                
                <div class="flex justify-between items-start mb-4">
                    <div class="flex flex-col">
                        <span class="w-fit text-[10px] font-black uppercase px-3 py-1 bg-gray-100 rounded-lg text-gray-500 tracking-widest">
                            {{ $r->tipo }}
                        </span>
                        <h3 class="text-xl font-bold text-gray-900 mt-2 leading-tight">{{ $r->titulo }}</h3>
                    </div>

                    @php
                        $statusColor = 'bg-yellow-100 text-yellow-700';
                        if($r->estado == 'Solucionado') $statusColor = 'bg-green-100 text-green-700';
                        if($r->estado == 'En proceso') $statusColor = 'bg-blue-100 text-blue-700';
                    @endphp
                    <span class="text-[10px] font-black uppercase px-4 py-2 {{ $statusColor }} rounded-2xl shadow-sm">
                        {{ $r->estado }}
                    </span>
                </div>

                <p class="text-gray-600 text-sm mb-5 leading-relaxed font-medium">
                    {{ $r->descripcion }}
                </p>

                @php
                    $img = DB::table('imagen')->where('id_reporte', $r->id_reporte)->first();
                @endphp

                @if($img)
                    <div class="relative w-full h-56 md:h-80 overflow-hidden rounded-[2rem] mb-5 shadow-inner border border-gray-50">
                        <img src="{{ asset('storage/' . $img->ruta_imagen) }}" 
                             class="absolute w-full h-full object-cover" 
                             alt="Evidencia">
                    </div>
                @endif

                <div class="flex items-center justify-between text-[11px] text-gray-400 font-bold uppercase tracking-wider pb-6 border-b border-gray-50">
                    <span>📍 Santa Cruz, Bolivia</span>
                    <span>📅 {{ date('d/m/Y', strtotime($r->fecha)) }}</span>
                </div>

                <div class="mt-6">
                    <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-4">Conversación</h4>
                    
                    <div class="space-y-3 mb-6">
                        @php
                            $comentarios = DB::table('comentario')
                                ->join('usuario', 'comentario.id_usuario', '=', 'usuario.id_usuario')
                                ->where('comentario.id_reporte', $r->id_reporte)
                                ->select('comentario.*', 'usuario.nombre as user_name')
                                ->orderBy('id_comentario', 'asc')
                                ->get();
                        @endphp

                        @forelse($comentarios as $c)
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 bg-[#1f6f5b]/10 rounded-full flex-shrink-0 flex items-center justify-center text-[10px] font-black text-[#1f6f5b]">
                                    {{ substr($c->user_name, 0, 1) }}
                                </div>
                                <div class="bg-gray-50 px-4 py-2 rounded-2xl rounded-tl-none border border-gray-100">
                                    <p class="text-[10px] font-black text-[#1f6f5b] uppercase">{{ $c->user_name }}</p>
                                    <p class="text-xs text-gray-600 mt-0.5 leading-snug">{{ $c->contenido }}</p>
                                </div>
                            </div>
                        @empty
                            <p class="text-[10px] text-gray-400 italic ml-2">Sin comentarios aún.</p>
                        @endforelse
                    </div>

                    <form method="POST" action="{{ route('comentarios.store') }}" class="flex gap-2">
                        @csrf
                        <input type="hidden" name="id_reporte" value="{{ $r->id_reporte }}">
                        <input type="text" name="contenido" placeholder="Aportar información..." 
                               class="flex-1 bg-gray-50 border-none rounded-2xl p-3 text-xs focus:ring-2 focus:ring-[#1f6f5b]" required>
                        <button class="bg-[#1f6f5b] text-white p-3 rounded-2xl shadow-lg hover:scale-105 active:scale-95 transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                            </svg>
                        </button>
                    </form>
                </div>

                @if(auth()->user()->rol == 'admin')
                    <div class="mt-6 pt-6 border-t border-gray-100 flex items-center justify-between">
                        <span class="text-[9px] font-black text-red-400 uppercase tracking-[0.2em]">Gestión Municipal</span>
                        <form method="POST" action="/estado" class="flex gap-2">
                            @csrf
                            <input type="hidden" name="id_reporte" value="{{ $r->id_reporte }}">
                            <select name="id_estado" class="bg-gray-100 border-none rounded-xl text-[10px] font-black uppercase p-2 focus:ring-2 focus:ring-[#1f6f5b]">
                                <option value="1" {{ $r->id_estado == 1 ? 'selected' : '' }}>Pendiente</option>
                                <option value="2" {{ $r->id_estado == 2 ? 'selected' : '' }}>En proceso</option>
                                <option value="3" {{ $r->id_estado == 3 ? 'selected' : '' }}>Solucionado</option>
                            </select>
                            <button class="bg-gray-800 text-white px-4 py-2 rounded-xl text-[10px] font-black hover:bg-black transition-all">OK</button>
                        </form>
                    </div>
                @endif

            </div>
        @empty
            <div class="bg-white rounded-[2.5rem] p-12 text-center shadow-sm border border-gray-100">
                <div class="text-5xl mb-4">🌳</div>
                <h3 class="text-xl font-bold text-gray-800">No hay reportes todavía</h3>
                <p class="text-gray-500 text-sm mt-2 leading-relaxed">¡Sé el primero en reportar algo!</p>
            </div>
        @endforelse

        <a href="/crear-reporte" class="md:hidden fixed bottom-6 right-6 bg-[#1f6f5b] text-white w-16 h-16 rounded-full shadow-2xl flex items-center justify-center text-3xl z-50 animate-bounce">
            +
        </a>
    </div>
</x-app-layout>