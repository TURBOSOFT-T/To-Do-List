<?php

namespace App\Exports;

use App\Models\Task;
use Maatwebsite\Excel\Concerns\FromCollection;


use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\Auth;
class TasksExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {


        if (Auth::user()->role=='admin') {
            // L'administrateur voit toutes les tâches
            $tasks = Task::latest()->paginate(5);
        } else {
            // Les utilisateurs réguliers ne voient que leurs tâches
            $tasks = Auth::user()->tasks()->latest()->paginate(5);
        }
        return $tasks;
    }

    public function headings(): array
    {
        return [
            'ID', 
            'Titre', 
            'Auteur', 
            'Description', 
            'Status', 
            'Date d\'échéance'
        ];
    }
}
