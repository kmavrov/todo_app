<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('users')->delete();
        DB::table('users')->insert([
            'name' => 'kmavrov',
            'email' => 'mavrov@gmail.com',
            'password' => bcrypt('123456'),
            'admin' => true,
            'created_at' => new DateTime,
            'updated_at' => new DateTime,
        ]);
        DB::table('users')->insert([
            'name' => 'regular',
            'email' => 'regular_user@gmail.com',
            'password' => bcrypt('123456'),
            'admin' => false,
            'created_at' => new DateTime,
            'updated_at' => new DateTime,
        ]);
    }
}
