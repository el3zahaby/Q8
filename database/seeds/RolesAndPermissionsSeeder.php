<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{

    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create Roles
        $admin = Role::create(['name' => 'admin']);
        $designer = Role::create(['name' => 'designer']);
        $user = Role::create(['name' => 'user']);


        $permissions = [

            ['id' => 1, 'name' => 'user_management'],



            // design
            ['id' => 2, 'name' => 'design_create',],
            ['id' => 3, 'name' => 'design_edit',],
            ['id' => 4, 'name' => 'design_view',], // users and de
            ['id' => 5, 'name' => 'design_delete',], // admin


        ];

        foreach ($permissions as $item) {
            Permission::create($item);
        }


        $designer_permissions = [2,3,4];

//        $user_permission = [4];


        $admin->syncPermissions(Permission::all());
        $designer->syncPermissions($designer_permissions);
    //   $user->syncPermissions($user_permission);

    }
}
