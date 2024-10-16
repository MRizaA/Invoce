<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {

        $user = User::find(1); 
        //$user = User::where('email', 'mra474188@gmail.com')->first();
        $user->assignRole('admin');

        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'create invoices']);
        Permission::create(['name' => 'read invoices']);
        Permission::create(['name' => 'update invoices']);
        Permission::create(['name' => 'delete invoices']);
        Permission::create(['name' => 'manage users']);

        // create roles and assign created permissions
        $role = Role::create(['name' => 'user'])
            ->givePermissionTo(['read invoices']);

        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(Permission::all());
    }
}
