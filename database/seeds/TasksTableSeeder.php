<?php

use Illuminate\Database\Seeder;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('tasks')->delete();
 
        $tasks = array(
            ['id' => 1, 'name' => 'Sub-Task 1', 'project_id' => 1, 'completed' => false, 'description' => 'Sample task 1 for project 1', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['id' => 2, 'name' => 'Sub-Task 2', 'project_id' => 1, 'completed' => false, 'description' => 'Sample task 2 for project 1', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['id' => 3, 'name' => 'Sub-Task 3', 'project_id' => 2, 'completed' => false, 'description' => 'Sample task 1 for project 2', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['id' => 4, 'name' => 'Sub-Task 4', 'project_id' => 2, 'completed' => true, 'description' => 'Sample task 2 for project 2', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['id' => 5, 'name' => 'Sub-Task 5', 'project_id' => 2, 'completed' => true, 'description' => 'Sample task 3 for project 2', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['id' => 6, 'name' => 'Sub-Task 6', 'project_id' => 3, 'completed' => true, 'description' => 'Sample task 1 for project 3', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['id' => 7, 'name' => 'Sub-Task 7', 'project_id' => 3, 'completed' => false, 'description' => 'Sample task 2 for project 3', 'created_at' => new DateTime, 'updated_at' => new DateTime],
        );
 
        // Uncomment the below to run the seeder
        DB::table('tasks')->insert($tasks);
    }
}
