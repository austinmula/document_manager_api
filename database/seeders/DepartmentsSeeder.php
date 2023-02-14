<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $departments = [
            ['id' => 1, 'name' => 'Technology Department'],
            ['id' => 2, 'name' => 'Real Estate and Development Department'],
            ['id' => 3, 'name' => 'Finance Department'],
            ['id' => 4, 'name' => 'Risk Department']
        ];

        foreach ($departments as $department) {
            Department::updateOrCreate(['id' => $department['id']], $department);
        }
    }
}
