<?php

namespace Database\Seeders;

use App\Models\User\User;
use Illuminate\Database\Seeder;


class UserSeeder extends Seeder
{
    public function run()
    {
        User::factory(50)->create();
    }
}
