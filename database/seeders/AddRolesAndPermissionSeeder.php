<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AddRolesAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = Permission::all();

        $roleViewer = Role::updateOrCreate(['name' => 'viewer']);
        $roleEditor = Role::updateOrCreate(['name' => 'editor']);
        $roleSearcher = Role::updateOrCreate(['name' => 'searcher']);
        $roleTyper = Role::updateOrCreate(['name' => 'typer']);
        $roleSearcher = Role::updateOrCreate(['name' => 'forsearch']);

        $roleArr = [$roleViewer, $roleEditor, $roleSearcher, $roleTyper];

        foreach ($roleArr as $key => $role) {

            if($role->name == "viewer"){
                $permissionsId = Permission::where('name', 'LIKE', '%list%')->pluck('id');
                $role->syncPermissions($permissionsId);
            } elseif ($role->name == "editor") {
                $permissionsId = Permission::where('name', 'LIKE', '%edit%')->pluck('id');
                $role->syncPermissions($permissionsId);
            } elseif ($role->name == "searcher") {
                $permissionsId = Permission::where('name', 'LIKE', '%list%')->pluck('id');
                $role->syncPermissions($permissionsId);
            } elseif ($role->name == "typer") {
                $permissionsId = Permission::where('name', 'LIKE', '%create%')->pluck('id');
                $role->syncPermissions($permissionsId);
            }

        }

    }
}
