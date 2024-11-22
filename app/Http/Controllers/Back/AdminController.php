<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\{User, Post, Comment, Contact, Courses, Department};
use Illuminate\Support\Facades\DB;
use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AdminController extends Controller
{
    /**
     * Show the admin dashboard.
     *
     * @return View
     */
    public function index()
    {
        if (Auth::user()->role == 'admin') {
            // L'administrateur voit toutes les tâches
            $tasks = Task::latest()->paginate(5);
            $tasksCount = Task::count(); // Compte toutes les tâches
            $usersCount = User::count(); // Compte tous les utilisateurs$completedTasksCount = Task::where('completed', true)->count(); 
            $completedTasks = Task ::where('is_completed', true)->count(); 
            $Nomcompleted =  Task ::where('is_completed', false)->count();  // Compte les tâches terminées de l'utilisateur


        } else {
            // Les utilisateurs réguliers ne voient que leurs tâches
            $tasks = Auth::user()->tasks()->latest()->paginate(5);
            $tasksCount = Auth::user()->tasks()->count(); // Compte les tâches de l'utilisateur
            $completedTasks = Auth::user()->tasks()->where('completed', true)->count(); // Compte les tâches terminées de l'utilisateur
            $Nomcompleted = Auth::user()->tasks()->where('is_completed', false)->count(); // Compte les tâches terminées de l'utilisateur


        }

        return view('admin.dashboard.index', compact( 'tasksCount','usersCount', 'completedTasks', 'Nomcompleted' ));
    }

    /**
     * Get the unread notifications.
     *
     * @return boolean
     */
    protected function getUnreads($model, $instructor = null)
    {
        $query = $instructor ?
            $model->whereHas('post.user', function ($query) {
                $query->where('users.id', auth()->id());
            }) :
            $model->newQuery();

        return $query->has('unreadNotifications')->count();
    }

    /**
     * Purge notifications.
     *
     * @param  String $model
     * @return \Illuminate\Http\Response
     */
    public function purge($model)
    {
        $model = 'App\Models\\' . ucfirst($model);

        DB::table('notifications')->where('notifiable_type', $model)->delete();

        return back();
    }
}
