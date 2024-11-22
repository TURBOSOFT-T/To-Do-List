<!-- resources/views/tasks/pdf.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Tâches</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Liste des Tâches</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Auteur</th>
                <th>Description</th>
                <th>Status</th>
                <th>Date d'échéance</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
            <tr>
                <td>{{ $task->id }}</td>
                <td>{{ $task->title }}</td>
                <td>{{ $task->user->last_name }} {{ $task->user->first_name }}</td>
                <td>{{ $task->description }}</td>
                <td>{{ $task->is_completed ? 'Complété' : 'En cours' }}</td>
                <td>{{ $task->due_date }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
