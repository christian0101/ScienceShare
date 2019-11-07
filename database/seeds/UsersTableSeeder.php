<?php

use App\User;
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
        // make sure at least one user exists
        $user = new User;
        $user->name = 'admin';
        $user->email = 'cristian9613@live.com';
        $user->password = '@a!dm$in@';
        $user->email_verified_at = now();
        $user->save();

        factory(App\User::class, 3)->create();
    }
}
