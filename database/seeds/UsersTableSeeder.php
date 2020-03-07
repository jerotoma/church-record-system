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
    public function run()
    {
        DB::table('users')->insert([
            'confirmed' => false,
            'enabled' => false,
            'locked' => false,
            'username' => 'otomang',
            'password' => Hash::make('vimmak'),
        ]);

        factory(App\User::class, 2)->create();
    }
}
