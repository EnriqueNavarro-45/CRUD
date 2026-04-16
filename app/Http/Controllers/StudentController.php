<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Career; 
use Illuminate\Http\Request;

class StudentController extends Controller
{

    public function index()
    {

        $students = Student::with('career')->get();

        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $careers = Career::all();

        return view('students.create', compact('careers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre'     => 'required|string|max:255',
            'correo'     => 'required|email|unique:students,correo',
            'career_id'  => 'required|exists:careers,id', // 👈 CAMBIO
            'semestre'   => 'required|string|max:50',
        ]);

        Student::create($request->all());

        return redirect()->route('students.index')
                         ->with('success', '¡Estudiante registrado correctamente!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        $careers = Career::all(); 

        return view('students.edit', compact('student', 'careers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'nombre'     => 'required|string|max:255',
            'correo'     => 'required|email|unique:students,correo,' . $student->id,
            'career_id'  => 'required|exists:careers,id', 
            'semestre'   => 'required|string|max:50',
        ]);

        $student->update($request->all());

        return redirect()->route('students.index')
                         ->with('success', '¡Estudiante actualizado correctamente!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')
                         ->with('success', '¡Estudiante eliminado correctamente!');
    }
}