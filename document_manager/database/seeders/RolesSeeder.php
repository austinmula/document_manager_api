<?php

namespace Database\Seeders;

use App\Models\Permission;
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
        $permisssions = [
            [ 'id'=> 1, 'name'=> 'Create user', 'slug' => 'create-user',],
            [ 'id' =>  2, 'name'=> 'Upload file', 'slug'=> 'upload-file',],
            [ 'id'=> 3, 'name'=> 'Delete user', 'slug'=> 'delete-user',],
            [ 'id'=> 4, 'name'=> 'Delete file', 'slug'=> 'delete-file',],
            [ 'id' => 5, "name" => 'Edit user', 'slug' => 'edit-user',],
            ['id'=> 6, "name"=> 'View users', 'slug'=> 'view-users',],
            ['id'=> 7, "name"=> 'Provide access to file', 'slug'=> 'provide-access-to-file',],
            ['id'=> 8, "name"=> 'Revoke access to file', 'slug'=> 'revoke-access-to-file',],
            ['id'=> 9, "name"=> 'View files', 'slug'=> 'view-files',]
        ];

        foreach ($permisssions as $permission) {
            Permission::updateOrCreate(['id' => $permission['id']], $permission);
        }

        $roles = [
            ['id' => 1, 'name' => 'intern', 'slug'=>'intern'],
            ['id' => 2, 'name' => 'associate', 'slug'=>'associate'],
            ['id' => 3, 'name' => 'department head', 'slug'=>'department-head'],
            ['id' => 4, 'name' => 'admin', 'slug'=> 'admin']
        ];

        $admin_permission = Permission::all();
        $intern_permission = Permission::where('slug', 'view-files')->first();
        $associte_permissions = Permission::whereIn('id',[ 2, 9])->get();
        $hod_permissions = Permission::whereIn('id', [ 2,4,7,8,9])->get();

//
        Role::updateOrCreate(['id'=> 4],[ 'name' => 'admin', 'slug'=>'admin'])->permissions()->attach($admin_permission);
        Role::updateOrCreate(['id'=> 1],[ 'name' => 'intern', 'slug'=>'intern'])->permissions()->attach($intern_permission);
        Role::updateOrCreate(['id'=> 2],[ 'name' => 'associate', 'slug'=>'associate'])->permissions()->attach($associte_permissions);
        Role::updateOrCreate(['id'=> 3],[ 'name' => 'department head', 'slug'=>'department-head'])->permissions()->attach($hod_permissions);



//        foreach ($roles as $role) {
//            Role::updateOrCreate(['id' => $role['id']], $role);
//        }


    }
}
