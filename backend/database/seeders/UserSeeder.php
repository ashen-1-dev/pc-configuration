<?php

namespace Database\Seeders;

use App\Models\User\User;
use Hash;
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
        $admin = [
            'first_name' => 'Никита',
            'last_name' => 'Лепейкин',
            'email' => 'alen2014@gmail.com',
            'password' => Hash::make('123123'),
        ];

        (User::firstOrCreate($admin))->addRoles(['admin', 'user']);
    }
}
