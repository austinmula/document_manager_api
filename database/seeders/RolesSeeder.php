<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $roles = [
            ['id' => 1, 'name' => 'intern', 'slug'=>'intern'],
            ['id' => 2, 'name' => 'associate', 'slug'=>'associate'],
            ['id' => 3, 'name' => 'department head', 'slug'=>'department-head']
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(['id' => $role['id']], $role);
        }
    }
}
