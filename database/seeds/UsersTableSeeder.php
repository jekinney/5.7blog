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
        \App\User::create([
        	'name' => 'Jason Kinney',
        	'email' => 'jekinneys@yahoo.com',
        	'password' => bcrypt('aubreys1'),
        	'is_admin' => true,
        	'is_author' => true,
        ]);
    }
}
