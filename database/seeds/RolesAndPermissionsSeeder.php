<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * This seeder is used to add roles & permissions for Spatie
     * More info: https://github.com/spatie/laravel-permission#database-seeding
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');
        // create permissions
        Permission::create(['name' => 'manage user']);
        Permission::create(['name' => 'manage company']);
        Permission::create(['name' => 'edit openingTime']);
        Permission::create(['name' => 'edit appointmentType']);
        Permission::create(['name' => 'create myAppointment']);
        Permission::create(['name' => 'modify myAppointment']);

        // create roles and assign created permissions
        $role = Role::create(['name' => 'super-admin']);
        $role->givePermissionTo(Permission::all());

        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(['manage user', 'manage company']);

        $role = Role::create(['name' => 'company']);
        $role->givePermissionTo(['edit openingTime', 'edit appointmentType']);

        $role = Role::create(['name' => 'client']);
        $role->givePermissionTo(['create myAppointment', 'modify myAppointment']);
    }
}
