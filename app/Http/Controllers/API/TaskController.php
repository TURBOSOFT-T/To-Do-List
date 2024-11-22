<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\BaseController as BaseController;

class TaskController extends BaseController
{
    // GET: Récupérer toutes les tâches

   /*  public function __construct()
    {
        // Middleware pour s'assurer que l'utilisateur est authentifié
        $this->middleware('auth:sanctum');
    } */

    public function index()
    {
        $tasks = Task::all();
        return response()->json($tasks);
    }

    // POST: Créer une nouvelle tâche
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'nullable|date',
        ]);

        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'is_completed' => $request->is_completed ?? false,
            'due_date' => $request->due_date,
        ]);

        return response()->json($task, 201);
    }

    // GET: Récupérer une tâche par son ID
    public function show($id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['message' => 'Tâche non trouvée'], 404);
        }

        return response()->json($task);
    }

    // PUT/PATCH: Mettre à jour une tâche
    public function update(Request $request, $id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['message' => 'Tâche non trouvée'], 404);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'nullable|date',
        ]);

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'is_completed' => $request->is_completed ?? $task->is_completed,
            'due_date' => $request->due_date,
        ]);

        return response()->json($task);
    }

    // DELETE: Supprimer une tâche
    public function destroy($id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['message' => 'Tâche non trouvée'], 404);
        }

        $task->delete();

        return response()->json(['message' => 'Tâche supprimée']);
    }
}
