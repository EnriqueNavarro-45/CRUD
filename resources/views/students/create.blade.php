@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto">
        <!-- Botón Volver -->
        <a href="{{ route('students.index') }}" class="inline-flex items-center text-sm font-bold text-gray-400 hover:text-black mb-6 transition">
            <i class="fas fa-arrow-left mr-2"></i> VOLVER AL LISTADO
        </a>

        <div class="bg-white rounded-[2.5rem] shadow-xl p-10 border border-gray-100">
            <div class="flex items-center gap-4 mb-8">
                <div class="w-12 h-12 bg-black text-white rounded-2xl flex items-center justify-center text-xl">
                    <i class="fas fa-user-plus"></i>
                </div>
                <h2 class="text-3xl font-black text-gray-800 tracking-tighter">Registrar Estudiante</h2>
            </div>

            @if ($errors->any())
                <div class="mb-8 p-4 bg-red-50 border-l-4 border-red-500 rounded-r-2xl flex gap-3 items-center animate-pulse">
                    <i class="fas fa-exclamation-circle text-red-500 text-xl"></i>
                    <div>
                        <p class="text-red-800 font-bold text-sm">Error en el registro:</p>
                        <ul class="text-red-600 text-xs font-medium">
                            @foreach ($errors->all() as $error)
                                <li>• {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <form action="{{ route('students.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Nombre -->
                    <div class="md:col-span-2">
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Nombre completo</label>
                        <input type="text" name="nombre" 
                               class="w-full px-5 py-4 bg-gray-50 border {{ $errors->has('nombre') ? 'border-red-500' : 'border-gray-200' }} rounded-2xl focus:outline-none focus:ring-2 focus:ring-black focus:bg-white transition"
                               value="{{ old('nombre') }}" placeholder="Nombre del alumno" required>
                    </div>

                    <!-- Correo -->
                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Correo electrónico</label>
                        <input type="email" name="correo" 
                               class="w-full px-5 py-4 bg-gray-50 border {{ $errors->has('correo') ? 'border-red-500' : 'border-gray-200' }} rounded-2xl focus:outline-none focus:ring-2 focus:ring-black focus:bg-white transition"
                               value="{{ old('correo') }}" placeholder="ejemplo@correo.com" required>
                    </div>

                    <!-- Semestre -->
                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Semestre</label>
                        <input type="text" name="semestre" 
                               class="w-full px-5 py-4 bg-gray-50 border {{ $errors->has('semestre') ? 'border-red-500' : 'border-gray-200' }} rounded-2xl focus:outline-none focus:ring-2 focus:ring-black focus:bg-white transition"
                               value="{{ old('semestre') }}" placeholder="Ej: 4TO" required>
                    </div>

                    <!-- Carrera -->
                    <div class="md:col-span-2">
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Carrera Destino</label>
                        <select name="career_id"
                                class="w-full px-5 py-4 bg-gray-50 border {{ $errors->has('career_id') ? 'border-red-500' : 'border-gray-200' }} rounded-2xl focus:outline-none focus:ring-2 focus:ring-black focus:bg-white transition appearance-none"
                                required>
                            <option value="">Selecciona una opción...</option>
                            @foreach($careers as $career)
                                <option value="{{ $career->id }}" {{ old('career_id') == $career->id ? 'selected' : '' }}>
                                    {{ $career->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mt-12 flex flex-col md:flex-row gap-4">
                    <button type="submit"
                            class="flex-[2] bg-black text-white py-4 rounded-2xl font-black uppercase tracking-widest hover:bg-gray-800 transition shadow-lg shadow-gray-200 flex items-center justify-center gap-2">
                        <i class="fas fa-save text-sm"></i> Guardar Registro
                    </button>
                    <a href="{{ route('students.index') }}" 
                       class="flex-1 text-center border-2 border-gray-100 text-gray-400 hover:text-gray-600 hover:bg-gray-50 py-4 rounded-2xl font-bold transition">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection