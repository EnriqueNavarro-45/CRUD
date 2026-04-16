@extends('layouts.app')

@section('content')
<div class="page-transition">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-10">
        <div>
            <h2 class="text-4xl font-extrabold text-slate-900 tracking-tight">Lista de Estudiantes</h2>
            <p class="text-slate-500 font-medium mt-1">Administración académica.</p>
        </div>
        
        <a href="{{ route('students.create') }}" 
           class="group relative bg-black text-white pl-6 pr-8 py-4 rounded-2xl font-bold transition-all duration-300 hover:pr-10 hover:shadow-2xl hover:shadow-black/20 flex items-center gap-3">
        <span class="bg-white/20 w-8 h-8 rounded-lg flex items-center justify-center group-hover:rotate-90 transition-transform duration-500">
            <i class="fas fa-plus"></i>
        </span>
        <span class="uppercase tracking-widest text-xs">Nuevo Estudiante</span>
    </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
        
        <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm flex items-center gap-6 relative overflow-hidden transition-all duration-300 hover:scale-[1.02] hover:shadow-md group">
            <div class="bg-black p-4 rounded-2xl shadow-lg z-10">
                <i class="fas fa-users text-white text-2xl"></i>
            </div>
            <div class="z-10">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em]">Total Alumnos</p>
                <h3 class="text-3xl font-black text-slate-900 leading-none">
                    {{ $students->count() }} 
                    <span class="text-sm font-medium text-slate-400 italic">Alumnos</span>
                </h3>
            </div>
            <i class="fas fa-users absolute -right-6 -bottom-6 text-slate-100 text-9xl rotate-12 transition-transform duration-500 group-hover:scale-110 group-hover:text-slate-200/50"></i>
        </div>

        <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm flex items-center gap-6 relative overflow-hidden transition-all duration-300 hover:scale-[1.02] hover:shadow-md group">
            <div class="bg-blue-600 p-4 rounded-2xl shadow-lg shadow-blue-200 z-10">
                <i class="fas fa-star text-white text-2xl"></i>
            </div>
            <div class="z-10">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em]">Último Registro</p>
                <h3 class="text-sm font-bold text-slate-900">
                    {{ $students->last()->nombre ?? 'Sin registros' }}
                </h3>
            </div>
            <i class="fas fa-graduation-cap absolute -right-6 -bottom-6 text-slate-100 text-9xl rotate-12 transition-transform duration-500 group-hover:scale-110 group-hover:text-slate-200/50"></i>
        </div>
    </div>

    @if ($students->isEmpty())
        <div class="bg-white rounded-[2rem] border border-slate-100 p-20 text-center shadow-sm">
            <i class="fas fa-folder-open text-slate-200 text-6xl mb-4"></i>
            <h3 class="text-xl font-bold text-slate-800">No hay registros</h3>
            <p class="text-slate-400 text-sm mt-2">Comienza agregando un nuevo estudiante al sistema.</p>
        </div>
    @else
        <div class="bg-white rounded-[1.5rem] border border-slate-100 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/80 border-b border-slate-100">
                            <th class="px-8 py-5 text-[11px] font-black uppercase text-slate-400 tracking-widest">Nombre</th>
                            <th class="px-8 py-5 text-[11px] font-black uppercase text-slate-400 tracking-widest">Correo</th>
                            <th class="px-8 py-5 text-[11px] font-black uppercase text-slate-400 tracking-widest">Carrera</th>
                            <th class="px-8 py-5 text-[11px] font-black uppercase text-slate-400 tracking-widest text-center">Semestre</th>
                            <th class="px-8 py-5 text-[11px] font-black uppercase text-slate-400 tracking-widest text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach ($students as $student)
                        <tr class="hover:bg-blue-50/30 transition-colors group/row">
                            <td class="px-8 py-5 text-sm font-bold text-slate-800">
                                {{ $student->nombre }}
                            </td>
                            <td class="px-8 py-5 text-sm text-slate-500 font-medium">
                                {{ $student->correo }}
                            </td>
                            <td class="px-8 py-5">
                                <span class="bg-slate-100 text-slate-600 px-3 py-1 rounded-lg text-[10px] font-black uppercase border border-slate-200 group-hover/row:bg-white transition-colors">
                                    {{ $student->career->nombre ?? 'N/A' }}
                                </span>
                            </td>
                            <td class="px-8 py-5 text-center text-sm font-bold text-slate-700">
                                {{ $student->semestre }}
                            </td>
                            <td class="px-8 py-5">
                                <div class="flex justify-center items-center gap-4">
                                    <a href="{{ route('students.edit', $student) }}" 
                                       class="text-slate-400 hover:text-blue-600 transition-all hover:scale-125">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('students.destroy', $student) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este registro?')">
                                        @csrf @method('DELETE')
                                        <button class="text-slate-400 hover:text-red-500 transition-all hover:scale-125">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>
@endsection