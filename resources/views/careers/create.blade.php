@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto">
    <a href="{{ route('careers.index') }}" class="inline-flex items-center text-sm font-bold text-gray-400 hover:text-black mb-6 transition group">
        <i class="fas fa-chevron-left mr-2 group-hover:-translate-x-1 transition-transform"></i> 
        GESTIÓN DE CARRERAS
    </a>

    <div class="bg-white rounded-[2.5rem] shadow-xl p-10 border border-gray-100 relative overflow-hidden">
        <div class="absolute -top-10 -right-10 w-32 h-32 bg-indigo-50 rounded-full opacity-50"></div>

        <div class="relative z-10">
            <div class="flex items-center gap-4 mb-8">
                <div class="w-12 h-12 bg-blue-900 text-white rounded-2xl flex items-center justify-center text-xl shadow-lg shadow-blue-200">
                    <i class="fas fa-plus-circle"></i>
                </div>
                <h2 class="text-3xl font-black text-gray-800 tracking-tighter">Nueva Carrera</h2>
            </div>

            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-r-2xl flex gap-3 items-center animate-shake">
                    <i class="fas fa-exclamation-triangle text-red-500"></i>
                    <ul class="text-red-700 text-xs font-bold">
                        @foreach ($errors->all() as $error)
                            <li>{{ str_replace('The nombre has already been taken.', 'Esta carrera ya existe en el sistema.', $error) }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('careers.store') }}" method="POST">
                @csrf
                <div class="space-y-6">
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2 ml-1">
                            Nombre oficial de la carrera
                        </label>
                        <input type="text" name="nombre"
                               class="w-full px-5 py-4 bg-gray-50 border {{ $errors->has('nombre') ? 'border-red-500' : 'border-gray-100' }} rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-900
                                focus:bg-white transition-all text-gray-700 font-medium"
                               placeholder="Ej: Ingeniería en Sistemas/Informática"
                               value="{{ old('nombre') }}" required>
                    </div>

                    <div class="flex gap-4 pt-4">
                        <button type="submit"
                                class="flex-[2] bg-black text-white py-4 rounded-2xl font-black uppercase tracking-widest hover:bg-blue-900 transition-all shadow-lg hover:shadow-blue-200">
                            Guardar Carrera
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