<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(3)->create();

        $admin = Role::where('name', 'admin')->value('id');
        $user = Role::where('name', 'user')->value('id');

        $user1 = new User();
        $user1->name = 'admin';
        $user1->email = 'admin@mail.ru';
        $user1->password = Hash::make(123456);
        $user1->role_id = $admin;
        $user1->save();

        $user2 = new User();
        $user2->name = 'kirill';
        $user2->email = 'user@mail.ru';
        $user2->password = Hash::make(123456);
        $user2->role_id = $user;
        $user2->save();
    }
}
