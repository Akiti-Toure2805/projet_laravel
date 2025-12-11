<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use Inertia\Inertia;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
{
    $tasks = Task::with(['user', 'status'])->get();

    return Inertia::render('Tasks/Index', [
        'tasks'    => $tasks,
        'statuses' => Status::all(['id', 'name', 'color']), // ✅ pour le <select>
    ]);
}


    public function create()
    {
        return Inertia::render('Tasks/Create', [
            'statuses' => Status::all(['id', 'name', 'color']),
            'users'    => User::all(['id', 'name']),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'status_id'   => 'required|exists:statuses,id',
            'user_id'     => 'nullable|exists:users,id',
            'due_date'    => 'nullable|date',
        ]);

        if (empty($data['user_id'])) {
            $data['user_id'] = Auth::id();
        }

        Task::create($data);

        return redirect()->route('tasks.index')
            ->with('success', 'Tâche créée avec succès.');
    }

    // 🔁 EDIT CORRIGÉ
    public function edit(Task $task)
    {
        return Inertia::render('Tasks/Edit', [
            'task'     => $task->load(['user', 'status']),
            'statuses' => Status::all(['id', 'name', 'color']),
            'users'    => User::all(['id', 'name']),
        ]);
    }

    public function update(Request $request, Task $task)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'status_id'   => 'required|exists:statuses,id',
            'user_id'     => 'required|exists:users,id',
            'due_date'    => 'nullable|date',
        ]);

        $task->update($data);

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Tâche mise à jour avec succès.');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Tâche supprimée avec succès.');
    }


    public function updateStatus(Request $request, Task $task)
{
    $data = $request->validate([
        'status_id' => 'required|exists:statuses,id',
    ]);

    $task->update($data);

    return redirect()
        ->route('tasks.index')
        ->with('success', 'Statut mis à jour avec succès.');
}












}
