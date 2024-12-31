<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Teacher;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('classrooms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $request->validate(['nr_sala'=>'required|max:25']);
        Classroom::create($request->only('nr_sala'));

        $classrooms = Classroom::all();

        return redirect()->route('classrooms.create')->with('classsrooms', $classrooms);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classroom $classroom)
    {
        $classroom->teachers()->detach(); // Remove associações com salas de aula
        $classroom->delete(); // Exclui o professor

        return redirect()->route('classrooms.create')->with('success', 'Sala removida com sucesso.');
    }
}
