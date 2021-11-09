<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->email = 'manager@gmail.com';
        $user->name = 'Manager';
        $user->role = 'manager';
        $user->password = bcrypt('123456');
        $user->avatar = asset('bower_components/admin-lte/dist/img/user2-160x160.jpg');

        $user->save();
    }
}
