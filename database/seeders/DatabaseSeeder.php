<?php

namespace Database\Seeders;
use App\Models\{ User, Category , Task};
use Illuminate\Support\Facades\DB;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run()
    {


        // Users
        User::withoutEvents(function () {
            // Create 1 admin
            User::factory(1)->create([
                'last_name' => 'Administrator',
            'first_name' => 'Administrator', 
             

                'email' => 'admin@gmail.com',
                'password' => bcrypt('123456789'),
                'role' => 'admin',
            ]);
           
            // Create 3 users
            User::factory()->count(10)->create();
        });

      //////////////////////Tasks

      \App\Models\Task::factory(5)->create();



    }
}
