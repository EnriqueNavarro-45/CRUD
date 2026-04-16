<?php

namespace App\Http\Controllers;

use App\Models\Career;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    public function index()
    {
        $careers = Career::with('students')->get();
        return view('careers.index', compact('careers'));
    }
    public function create()
    {
        return view('careers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:careers,nombre'
        ]);

        Career::create($request->all());

        return redirect()->route('careers.index')
            ->with('success', '¡Carrera creada correctamente!');
    }

    public function edit(Career $career)
    {
        return view('careers.edit', compact('career'));
    }

    public function update(Request $request, Career $career)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:careers,nombre,' . $career->id
        ]);

        $career->update($request->all());

        return redirect()->route('careers.index')
            ->with('success', '¡Carrera actualizada correctamente!');
    }
    public function destroy(Career $career)
    {
        $career->delete();

        return redirect()->route('careers.index')
            ->with('success', '¡Carrera eliminada correctamente!');
    }
}