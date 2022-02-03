<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'viewAll airports']);
        Permission::create(['name' => 'view airports']);
        Permission::create(['name' => 'store airports']);
        Permission::create(['name' => 'update airports']);
        Permission::create(['name' => 'delete airports']);

        Permission::create(['name' => 'viewAll airlines']);
        Permission::create(['name' => 'view airlines']);
        Permission::create(['name' => 'store airlines']);
        Permission::create(['name' => 'update airlines']);
        Permission::create(['name' => 'delete airlines']);

        Permission::create(['name' => 'viewAll flights']);
        Permission::create(['name' => 'view flights']);
        Permission::create(['name' => 'store flights']);
        Permission::create(['name' => 'update flights']);
        Permission::create(['name' => 'delete flights']);

        // this can be done as separate statements
        $role = Role::find(1);
        $role->givePermissionTo('viewAll flights');
        $role->givePermissionTo('view flights');
        $role->givePermissionTo('store flights');
        $role->givePermissionTo('update flights');
        $role->givePermissionTo('delete flights');
    }
}
