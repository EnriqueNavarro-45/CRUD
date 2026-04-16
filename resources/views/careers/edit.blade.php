@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto">
    <a href="{{ route('careers.index') }}" class="inline-flex items-center text-sm font-bold text-gray-400 hover:text-black mb-6 transition group">
        <i class="fas fa-chevron-left mr-2 group-hover:-translate-x-1 transition-transform"></i> 
        VOLVER AL LISTADO
    </a>

    <div class="bg-white rounded-[2.5rem] shadow-xl p-10 border border-gray-100 relative overflow-hidden">
        <!-- Decoración de fondo -->
        <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-purple-50 rounded-full opacity-50"></div>

        <div class="relative z-10">
            <div class="flex items-center gap-4 mb-8">
                <div class="w-12 h-12 bg-gradient-to-tr from-indigo-600 to-blue-500 text-white rounded-2xl flex items-center justify-center text-xl shadow-lg">
                    <i class="fas fa-edit"></i>
                </div>
                <div>
                    <h2 class="text-3xl font-black text-gray-800 tracking-tighter leading-none">Editar Carrera</h2>
                    <p class="text-gray-400 text-xs font-bold mt-1 uppercase tracking-tighter">ID: #{{ $career->id }}</p>
                </div>
            </div>

            <!-- Alerta de Error -->
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-r-2xl flex gap-3 items-center">
                    <i class="fas fa-info-circle text-red-500"></i>
                    <ul class="text-red-700 text-xs font-bold">
                        @foreach ($errors->all() as $error)
                            <li>{{ str_replace('The nombre has already been taken.', 'Ese nombre ya está en uso por otra carrera.', $error) }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('careers.update', $career) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2 ml-1">
                            Modificar nombre de la carrera
                        </label>
                        <input type="text" name="nombre"
                               class="w-full px-5 py-4 bg-gray-50 border {{ $errors->has('nombre') ? 'border-red-500' : 'border-gray-100' }} rounded-2xl focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:bg-white transition-all text-gray-700 font-medium"
                               value="{{ old('nombre', $career->nombre) }}" required>
                    </div>

                    <div class="flex gap-4 pt-4">
                        <button type="submit"
                                class="flex-[2] bg-black text-white py-4 rounded-2xl font-black uppercase tracking-widest hover:bg-indigo-600 transition-all shadow-lg hover:shadow-indigo-200">
                            Actualizar Datos
                        </button>

                        <a href="{{ route('careers.index') }}"
                           class="flex-1 text-center border-2 border-gray-100 text-gray-400 py-4 rounded-2xl font-bold hover:bg-gray-50 transition-all">
                            Cancelar
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection