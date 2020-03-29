<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         * Role Types
         *
         */
        $roleItems = [
            [
                'name'        => 'Unverified',
                'slug'        => 'unverified',
                'description' => 'Unverified Role',
                'level'       => 0,
            ],
            [
                'name'        => 'User',
                'slug'        => 'user',
                'description' => 'User Role',
                'level'       => 1,
            ],

            [
                'name'        => 'Inputer',
                'slug'        => 'inputer',
                'description' => 'User for inputing data to the system',
                'level'       => 2,
            ],
            [
                'name'        => 'View',
                'slug'        => 'view',
                'description' => 'User can view data',
                'level'       => 3,
            ],
            [
                'name'        => 'Admin',
                'slug'        => 'admin',
                'description' => 'Super System Administrator',
                'level'       => 6,
            ],
        ];

        /*
         * Add Role Items
         *
         */
        foreach ($roleItems as $roleItem) {
            $newRoleItem = config('roles.models.role')::where('slug', '=', $roleItem['slug'])->first();
            if ($newRoleItem === null) {
                $newRoleItem = config('roles.models.role')::create([
                    'name'          => $roleItem['name'],
                    'slug'          => $roleItem['slug'],
                    'description'   => $roleItem['description'],
                    'level'         => $roleItem['level'],
                ]);
            }
        }
    }
}
