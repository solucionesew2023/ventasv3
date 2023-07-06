<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $user = User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            ]);
        $role = Role::create(['name' => 'Administrador']);
        $user->assignRole($role);
        
        Permission::create(['name' => 'Create user']);
        Permission::create(['name' => 'Update user']);
        Permission::create(['name' => 'Delete user']);
        Permission::create(['name' => 'Consult user']);

        $role1 = Role::create(['name' => 'Secretaria']);
        $role1->givePermissionTo('Create user');
        $role1->givePermissionTo('Update user');
        $role1->givePermissionTo('Consult user');

        $role2 = Role::create(['name' => 'Vendedor']);
        $role2->givePermissionTo(['Create user','Update user']);





    }
}
