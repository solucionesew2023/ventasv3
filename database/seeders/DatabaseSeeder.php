<?php

namespace Database\Seeders;
use Spatie\Permission\Models\Role;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $user = User::factory()->create([
         'name' => 'admin',
         'email' => 'admin@admin.com',
         ]);
        $role = Role::create(['name' => 'Administrador']);
        $user->assignRole($role);

    }
}
