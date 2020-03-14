<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        factory(App\User::class, 10)->create()->each(function ($user) {
            $role = config('roles.models.role')::where('name', '=', 'User')->first();  //choose the default role upon user creation.
            $user->attachRole($role);
        });;
    }
}
