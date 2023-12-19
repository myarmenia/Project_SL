<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = User::where('email', 'admin@gmail.com')->first();

        if(!$user){
            $user = User::updateOrCreate([
            'username' => 'admin',
            'first_name' => 'firstname',
            'last_name' => 'lastname',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456')
            ]);
        }



        $role = Role::updateOrCreate(['name' => 'Admin']);

        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
    }
}
