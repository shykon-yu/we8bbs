<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();
        $user = User::find(1);
        $user->name = 'Sanji';
        $user->email = '28705227@qq.com';
        $user->avatar = 'fakers/avatars/1.png';
        $user->introduction = '宝剑锋从磨砺出';
        $user->save();

        $user = User::find(2);
        $user->name = 'Lily';
        $user->email = 'Lily@qq.com';
        $user->avatar = 'fakers/avatars/2.png';
        $user->introduction = '梅花香自苦寒来';
        $user->save();

        $user = User::find(3);
        $user->name = 'Rose';
        $user->email = 'Rose@qq.com';
        $user->avatar = 'fakers/avatars/3.png';
        $user->introduction = '如果你知道自己要去哪里，全世界都会为你让路';
        $user->save();
    }
}
