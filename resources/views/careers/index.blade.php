@extends('layouts.app')

@section('content')
<div class="flex flex-col md:flex-row justify-between items-end mb-10 px-4 gap-4">
    <div>
        <h2 class="text-4xl font-black text-gray-900 tracking-tighter">Lista de Carreras</h2>
        <p class="text-gray-400 text-sm font-medium italic mt-1">Control de registros por programa académico</p>
    </div>
    
    <a href="{{ route('careers.create') }}"
       class="group relative bg-black text-white pl-6 pr-8 py-4 rounded-2xl font-bold transition-all duration-300 hover:pr-10 hover:shadow-2xl hover:shadow-black/20 flex items-center gap-3">
        <span class="bg-white/20 w-8 h-8 rounded-lg flex items-center justify-center group-hover:rotate-90 transition-transform duration-500">
            <i class="fas fa-plus"></i>
        </span>
        <span class="uppercase tracking-widest text-xs">Nueva Carrera</span>
    </a>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
    <!-- Card Estudiantes -->
    <div class="relative overflow-hidden bg-white p-1 rounded-[2.5rem] shadow-sm border border-gray-100 group">
        <div class="bg-gradient-to-br from-white to-gray-50 p-7 rounded-[2.3rem] flex items-center gap-6 transition-all duration-500 group-hover:scale-[1.01]">
            <div class="w-16 h-16 bg-black text-white rounded-2xl flex items-center justify-center text-3xl shadow-xl shadow-gray-200">
                <i class="fas fa-users"></i>
            </div>
            <div>
                <p class="text-gray-400 text-[10px] font-black uppercase tracking-[0.2em] mb-1">Total Alumnos</p>
                <h4 class="text-4xl font-black text-gray-900 leading-none">
                    {{ $careers->sum(fn($c) => $c->students->count()) }}
                    <span class="text-sm font-medium text-gray-400 ml-1 italic">Alumnos</span>
                </h4>
            </div>
        </div>
        <div class="absolute -right-4 -bottom-4 opacity-[0.03] text-8xl transform -rotate-12">
            <i class="fas fa-users"></i>
        </div>
    </div>

    <!-- Card Carreras -->
    <div class="relative overflow-hidden bg-white p-1 rounded-[2.5rem] shadow-sm border border-gray-100 group">
        <div class="bg-gradient-to-br from-white to-indigo-50/30 p-7 rounded-[2.3rem] flex items-center gap-6 transition-all duration-500 group-hover:scale-[1.01]">
            <div class="w-16 h-16 bg-indigo-600 text-white rounded-2xl flex items-center justify-center text-3xl shadow-xl shadow-indigo-100">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <div>
                <p class="text-gray-400 text-[10px] font-black uppercase tracking-[0.2em] mb-1">Total Carreras</p>
                <h4 class="text-4xl font-black text-gray-900 leading-none">
                    {{ $careers->count() }}
                    <span class="text-sm font-medium text-gray-400 ml-1 italic">Carreras</span>
                </h4>
            </div>
        </div>
        <div class="absolute -right-4 -bottom-4 opacity-[0.03] text-8xl transform -rotate-12">
            <i class="fas fa-university"></i>
        </div>
    </div>
</div>

<div class="space-y-10">
    @foreach($careers as $career)
        <div class="bg-white rounded-[3rem] shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl hover:shadow-gray-200/50 transition-all duration-500">
            
            <!-- Header de Carrera -->
            <div class="p-8 flex justify-between items-center bg-gray-50/40 border-b border-gray-50/50">
                <div class="flex items-center gap-5">
                    <div class="w-14 h-14 bg-white text-indigo-600 rounded-2xl flex items-center justify-center font-black text-xl shadow-sm border border-gray-100 transform -rotate-3 group-hover:rotate-0 transition-transform">
                        {{ strtoupper(substr($career->nombre, 0, 1)) }}
                    </div>
                    <div>
                        <h3 class="text-2xl font-black text-gray-800 tracking-tight uppercase">
                            {{ $career->nombre }}
                        </h3>
                        <span class="text-[10px] font-bold text-indigo-500 uppercase tracking-widest">
                            {{ $career->students->count() }} Estudiantes Inscritos
                        </span>
                    </div>
                </div>

                <div class="flex gap-3">
                    <a href="{{ route('careers.edit', $career) }}"
                       class="w-10 h-10 flex items-center justify-center bg-white text-gray-400 rounded-xl hover:bg-black hover:text-white transition-all shadow-sm border border-gray-100 hover:border-black" title="Editar">
                        <i class="fas fa-pen text-xs"></i>
                    </a>
                    
                    <form action="{{ route('careers.destroy', $career) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar esta carrera?')">
                        @csrf @method('DELETE')
                        <button type="submit" 
                                class="w-10 h-10 flex items-center justify-center bg-white text-red-400 rounded-xl hover:bg-red-500 hover:text-white transition-all shadow-sm border border-gray-100 hover:border-red-500" title="Eliminar">
                            <i class="fas fa-trash-alt text-xs"></i>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Tabla de Alumnos -->
            <div class="p-10">
                @if($career->students->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="text-gray-400 text-[10px] font-black uppercase tracking-[0.2em] border-b border-gray-50">
                                    <th class="pb-6 px-4">Información del Estudiante</th>
                                    <th class="pb-6 px-4 text-center">Correo</th>
                                    <th class="pb-6 px-4 text-right">Semestre</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50/60">
                                @foreach($career->students as $student)
                                    <tr class="group hover:bg-indigo-50/30 transition-all duration-300">
                                        <td class="py-5 px-4">
                                            <div class="flex items-center gap-4">
                                                <div class="relative">
                                                    <div class="w-11 h-11 rounded-full bg-gradient-to-tr from-gray-100 to-gray-200 flex items-center justify-center text-xs font-bold text-gray-600 border-2 border-white shadow-sm overflow-hidden">
                                                        {{ strtoupper(substr($student->nombre, 0, 2)) }}
                                                    </div>
                                                    <div class="absolute -bottom-0.5 -right-0.5 w-3.5 h-3.5 border-white rounded-full"></div>
                                                </div>
                                                <div>
                                                    <span class="block font-bold text-gray-800 group-hover:text-indigo-700 transition-colors">{{ $student->nombre }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-5 px-4 text-sm text-gray-500 text-center font-medium italic select-all">{{ $student->correo }}</td>
                                        <td class="py-5 px-4 text-right">
                                            <span class="inline-block px-4 py-1.5 bg-white border border-gray-100 text-indigo-600 rounded-full text-[10px] font-black uppercase tracking-tighter shadow-sm group-hover:border-indigo-200 transition-all">
                                                {{ $student->semestre }} SEMESTRE
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <!-- Estado Vacío Mejorado -->
                    <div class="py-16 flex flex-col items-center justify-center text-center">
                        <div class="relative mb-6">
                            <div class="w-24 h-24 bg-gray-50 rounded-[2rem] flex items-center justify-center border border-dashed border-gray-200 text-gray-200 transform rotate-6 transition-transform hover:rotate-0">
                                <i class="fas fa-user-plus text-4xl"></i>
                            </div>
                            <div class="absolute -top-2 -right-2 w-8 h-8 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-600 text-xs">
                                <i class="fas fa-info"></i>
                            </div>
                        </div>
                        <h5 class="text-gray-800 font-bold mb-1 uppercase tracking-tight">Curso Vacio</h5>
                        <p class="text-gray-400 text-xs italic font-medium max-w-[250px] leading-relaxed">No se han detectado registros para esta carrera actualmente.</p>
                        
                        <a href="{{ route('students.create') }}" 
                           class="mt-8 px-8 py-3 bg-indigo-50 text-indigo-600 rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] hover:bg-indigo-600 hover:text-white hover:shadow-xl hover:shadow-indigo-200 transition-all duration-500">
                            + Agregar Estudiante
                        </a>
                    </div>
                @endif
            </div>
        </div>
    @endforeach
</div>

@endsection