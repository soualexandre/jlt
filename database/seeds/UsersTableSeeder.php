<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        User::create([
            'name'     => 'Alexandre Souza dos Santos',
            'email'    => 'alexandre@gmail.com  ',
            'password' => bcrypt('password'),
            'is_admin' => true
        ]);
        User::create([
            'name'     => 'Alexandre Santos',
            'email'    => 'xande@gmail.com  ',
            'password' => bcrypt('password'),
            'is_admin' => false
        ]);
    }
}
