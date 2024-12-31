<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Classroom;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::with('classrooms')->get();

        return view('teachers.index', compact('teachers'));

        //compact("teachers') = ['teachers => $teachers]
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $classroom = Classroom::all();
        return view('teachers.create', compact('classroom'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //recebe e valida os dados
        $request->validate([
            'name'=>'required|max:100',
            'subject'=>'required|max:20',
        ]);

        //o only limita apenas aos campos informados ou pode usar o request->all() para todos.
        $teacher = Teacher::create($request->only('name', 'subject'));

        //sicronizar com as salas
        $teacher->classrooms()->sync($request->classroom);


        return redirect()->route('teachers.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        return view('teachers.show', compact('teacher')); //o professor acessivel na visao com base no id passado pela url
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
        $classroom = Classroom::all();

        return view('teachers.edit', compact('teacher', 'classroom'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teacher $teacher)
    {
        $request->validate([
            'name' => 'required|max:100',
            'subject' => 'required|max:20',
            'classroom' => 'required|array', // Validação para garantir que 'classroom' seja um array
            'classroom.*' => 'exists:classrooms,id', // Validação para garantir que cada ID de sala exista no banco
        ]);

        // Encontra o professor
        $teacher = Teacher::findOrFail($teacher->id);

        // Atualiza os dados do professor
        $teacher->update($request->only('name', 'subject'));

        // Sincroniza as salas associadas
        $teacher->classrooms()->sync($request->classroom);

        // Redireciona para a lista de professores
       // return redirect()->route('teachers.index');
        //}

        return redirect()->route('teachers.index')->with('success', 'Professor actualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        $teacher->classrooms()->detach(); // Remove associações com salas de aula
        $teacher->delete(); // Exclui o professor

        return redirect()->route('teachers.index')->with('success', 'Professor removido com sucesso.');
    }
}
