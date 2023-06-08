<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $tasks = Task::latest()->get();

        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        Task::create($request->all());

        return redirect()->route('tasks.index')->with('success', 'Tarefa adicionada com sucesso.');
    }

    public function edit(Task $task)
    {
        return view('tasks.form', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $task->update($request->all());

        return redirect()->route('tasks.index')->with('success', 'Tarefa atualizada com sucesso.');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Tarefa excluída com sucesso.');
    }
}