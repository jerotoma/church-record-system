<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         * Permission Types
         *
         */
        $Permissionitems = [
            [
                'name'        => 'Create',
                'slug'        => 'create',
                'description' => 'Can create entity',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Edit',
                'slug'        => 'edit',
                'description' => 'Can edit entity',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'View',
                'slug'        => 'view',
                'description' => 'Can view data only',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Delete',
                'slug'        => 'delete',
                'description' => 'Can delete entity',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Unverified',
                'slug'        => 'unverified',
                'description' => 'Can not login',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'backup',
                'slug'        => 'backup',
                'description' => 'Access to data export and import',
                'model'       => 'Permission',
            ],
        ];

        /*
         * Add Permission Items
         *
         */
        foreach ($Permissionitems as $Permissionitem) {
            $newPermissionitem = config('roles.models.permission')::where('slug', '=', $Permissionitem['slug'])->first();
            if ($newPermissionitem === null) {
                $newPermissionitem = config('roles.models.permission')::create([
                    'name'          => $Permissionitem['name'],
                    'slug'          => $Permissionitem['slug'],
                    'description'   => $Permissionitem['description'],
                    'model'         => $Permissionitem['model'],
                ]);
            }
        }
    }
}
