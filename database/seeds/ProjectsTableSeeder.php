<?php

use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('projects')->delete();
 
        $projects = array(
            ['id' => 1, 'user_id' => 2, 'description' => 'Sample Project','name' => 'Sample Project 1', 'created_at' => new DateTime, 'updated_at' => new DateTime, 'start_date' => '2017-03-01', 'due_date' => '2017-03-05', 'delete_pending' => 0 ],
            ['id' => 2, 'user_id' => 2, 'description' => 'Sample Project','name' => 'Sample Project 2', 'created_at' => new DateTime, 'updated_at' => new DateTime, 'start_date' => '2017-03-13', 'due_date' => '2017-03-23', 'delete_pending' => 1 ],
            ['id' => 3, 'user_id' => 2, 'description' => 'Sample Project','name' => 'Sample Project 3', 'created_at' => new DateTime, 'updated_at' => new DateTime, 'start_date' => '2017-03-27', 'due_date' => '2017-03-31', 'delete_pending' => 0 ],
            ['id' => 4, 'user_id' => 1, 'description' => 'Sample Project','name' => 'Sample Project 3', 'created_at' => new DateTime, 'updated_at' => new DateTime, 'start_date' => '2017-03-27', 'due_date' => '2017-03-31', 'delete_pending' => 0 ],
        );
 
        // Uncomment the below to run the seeder
        DB::table('projects')->insert($projects);
    }
}
