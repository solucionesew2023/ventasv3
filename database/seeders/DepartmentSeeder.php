<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dep1= Department::create(['name' => 'ANTIOQUIA']);
        $dep2= Department::create(['name' => 'NORTE DE SANTANDER']);
    }
}
