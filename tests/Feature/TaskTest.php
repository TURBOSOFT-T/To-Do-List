<?php

// tests/Feature/TaskTest.php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_allows_an_authenticated_user_to_create_a_task()
    {
       
        $user = User::factory()->create();

        // Se connecter en tant qu'utilisateur
        $this->actingAs($user);

        // Envoyer une requête POST pour créer une tâche
        $response = $this->post('/tasks', [
            'title' => 'Nouvelle Tâche',
            'description' => 'Description de la tâche',
            'due_date' => '2024-12-31',
        ]);

        // Vérifier la réponse
        $response->assertStatus(302); // Redirection après la création
        $this->assertDatabaseHas('tasks', [
            'title' => 'Nouvelle Tâche',
            'description' => 'Description de la tâche',
        ]);
    }


    /** @test */
public function it_shows_a_list_of_tasks_for_an_authenticated_user()
{
    // Créer un utilisateur avec des tâches
    $user = User::factory()->create();
    Task::factory()->count(3)->create(['user_id' => $user->id]);

    // Se connecter en tant qu'utilisateur
    $this->actingAs($user);

    // Accéder à la liste des tâches
    $response = $this->get('/tasks');

    // Vérifier que les tâches sont affichées
    $response->assertStatus(200)
             ->assertSee(Task::first()->title);
}
/** @test */
public function it_allows_an_authenticated_user_to_delete_a_task()
{
    // Créer un utilisateur et une tâche associée
    $user = User::factory()->create();
    $task = Task::factory()->create(['user_id' => $user->id]);

    // Se connecter en tant qu'utilisateur
    $this->actingAs($user);

    // Envoyer une requête DELETE
    $response = $this->delete("/tasks/{$task->id}");

    // Vérifier que la tâche est supprimée
    $response->assertStatus(302);
    $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
}
/** @test */
public function it_prevents_unauthenticated_users_from_accessing_tasks()
{
    // Accéder à la liste des tâches sans être connecté
    $response = $this->get('/tasks');

    // Vérifier que l'utilisateur est redirigé vers la page de connexion
    $response->assertRedirect('/login');
}



}

