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
//    public function index(){

//     return Inertia::render('Tasks/Index', [
//         'tasks' => Task::with(['user', 'status'])->get(),
//     ]);


//    }

public function index()
{
    $tasks = Task::with(['user', 'status'])->get();

    // pour vérifier
    // dd($tasks->toArray());

    return Inertia::render('Tasks/Index', [
        'tasks' => $tasks,
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

        // si personne n’est choisi, on assigne à l’utilisateur connecté
        if (empty($data['user_id'])) {
            $data['user_id'] = Auth::id();
        }

        Task::create($data);

        return redirect()->route('tasks.index')
            ->with('success', 'Tâche créée avec succès.');
    }


}
