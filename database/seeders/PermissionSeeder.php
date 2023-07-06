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

        Permission::create(['name' => 'Consult brand']);
        Permission::create(['name' => 'Create brand']);
        Permission::create(['name' => 'Update brand']);
        Permission::create(['name' => 'Delete brand']);

        Permission::create(['name' => 'Consult category']);
        Permission::create(['name' => 'Create category']);
        Permission::create(['name' => 'Update category']);
        Permission::create(['name' => 'Delete category']);

        Permission::create(['name' => 'Consult color']);
        Permission::create(['name' => 'Create color']);
        Permission::create(['name' => 'Update color']);
        Permission::create(['name' => 'Delete color']);

        Permission::create(['name' => 'Consult product']);
        Permission::create(['name' => 'Create product']);
        Permission::create(['name' => 'Update product']);
        Permission::create(['name' => 'Delete product']);

        Permission::create(['name' => 'Consult provider']);
        Permission::create(['name' => 'Create provider']);
        Permission::create(['name' => 'Update provider']);
        Permission::create(['name' => 'Delete provider']);

        Permission::create(['name' => 'Consult purchase']);
        Permission::create(['name' => 'Create purchase']);
        Permission::create(['name' => 'Update purchase']);
        Permission::create(['name' => 'Delete purchase']);

        Permission::create(['name' => 'Consult size']);
        Permission::create(['name' => 'Create size']);
        Permission::create(['name' => 'Update size']);
        Permission::create(['name' => 'Delete size']);

        Permission::create(['name' => 'Consult subcategory']);
        Permission::create(['name' => 'Create subcategory']);
        Permission::create(['name' => 'Update subcategory']);
        Permission::create(['name' => 'Delete subcategory']);

        Permission::create(['name' => 'Consult tax']);
        Permission::create(['name' => 'Create tax']);
        Permission::create(['name' => 'Update tax']);
        Permission::create(['name' => 'Delete tax']);



        $role1 = Role::create(['name' => 'Secretaria']);

        $role1->givePermissionTo([
                                'Create brand',
                                'Update brand',
                                'Consult brand',
                                'Delete brand',
                                'Create category',
                                'Update category',
                                'Consult category',
                                'Delete category',
                                'Create color',
                                'Update color',
                                'Consult color',
                                'Delete color',
                                'Create product',
                                'Update product',
                                'Consult product',
                                'Delete product',
                                'Create provider',
                                'Update provider',
                                'Consult provider',
                                'Delete provider',
                                'Create purchase',
                                'Update purchase',
                                'Consult purchase',
                                'Delete purchase',
                                'Create size',
                                'Update size',
                                'Consult size',
                                'Delete size',
                                'Create subcategory',
                                'Update subcategory',
                                'Consult subcategory',
                                'Delete subcategory',
                                'Create tax',
                                'Update tax',
                                'Consult tax',
                                'Delete tax',
                            ]);


    }
}
