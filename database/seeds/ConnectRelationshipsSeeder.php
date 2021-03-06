<?php

use Illuminate\Database\Seeder;

class ConnectRelationshipsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Get Available Permissions.
         */
        $permissions = config('roles.models.permission')::all();

        /**
         * Attach Permissions to Roles.
         */
        $roleAdmin = config('roles.models.role')::where('slug', '=', 'admin')->first();
        foreach ($permissions as $permission) {
            $roleAdmin->attachPermission($permission);
        }

        $perm = config('roles.models.permission')::where('slug', '=', 'unverified')->get();
        $roleOthers = config('roles.models.role')::where('slug', '!=', 'admin')->get();
        foreach ($roleOthers as $role) {
            $role->attachPermission($perm);
        }
    }
}
