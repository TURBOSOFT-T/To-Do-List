<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Barryvdh\DomPDF\Facade as PDF;
use mPDF;

class TaskController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        if (Auth::user()->role == 'admin') {
            // L'administrateur voit toutes les tâches
            $tasks = Task::latest()->paginate(5);
            $tasksCount = Task::count(); // Compte toutes les tâches
        } else {
            // Les utilisateurs réguliers ne voient que leurs tâches
            $tasks = Auth::user()->tasks()->latest()->paginate(5);
            $tasksCount = Auth::user()->tasks()->count(); // Compte les tâches de l'utilisateur
        }
    
        return view('tasks.index', compact('tasks', 'tasksCount'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    


public function exportPdf()
    {
        // Récupérer toutes les tâches ou celles de l'utilisateur connecté
        if (Auth::user()->role=='admin') {
            // L'administrateur voit toutes les tâches
            $tasks = Task::latest()->paginate(5);
        } else {
            // Les utilisateurs réguliers ne voient que leurs tâches
            $tasks = Auth::user()->tasks()->latest()->paginate(5);
        }

        // Créer un objet mPDF
        $mpdf = new \Mpdf\Mpdf();

        // Charger la vue avec les données des tâches
        $html = view('tasks.pdf', compact('tasks'))->render();

        // Ajouter le HTML au PDF
        $mpdf->WriteHTML($html);

        // Télécharger le PDF généré
        return $mpdf->Output('tasks_list.pdf', 'D'); // D pour téléchargement, I pour affichage dans le navigateur
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasks.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
    ]);

    Auth::user()->tasks()->create([
        'title' => $request->title,
        'description' => $request->description,
        'due_date' => $request->due_date,
        'is_completed' => false,
    ]);

    return redirect()->route('tasks.index')->with('success', 'Tâche ajoutée avec succès');
}

    
    /**
     * Display the specified resource.
     *
     * @param  \App\task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return view('tasks.show',compact('task'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        return view('tasks.edit',compact('task'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403, 'Accès non autorisé');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_completed' => 'nullable|boolean',
        ]);

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'is_completed' => $request->has('is_completed'),
        ]);

        return redirect()->route('tasks.index')->with('success', 'Tâche mise à jour avec succès.');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {

        if ($task->user_id !== Auth::id()) {
            abort(403, 'Accès non autorisé');
        }
        $task->delete();
    
        return redirect()->route('tasks.index')
                        ->with('success','task deleted successfully');
    }



    public function changeStatus($user_id)
    {
        $user = Task::find($user_id);

        if ($user) {
            if ($user->is_completed) {
                $user->is_completed = 0;
            } else {
                $user->is_completed = 1;
            }
            $user->save();
        }

        return redirect()->back()
            ->with('success', 'Status updated successfully');
    }

}
