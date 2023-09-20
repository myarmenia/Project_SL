<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'role' => [ 'role-list',
                        'role-create',
                        'role-edit',
                        'role-delete',
                    ],
            'user' => [ 'user-list',
                            'user-create',
                            'user-edit',
                            'user-delete',
                    ],
            'man' => [ 'man-list',
                        'man-create',
                        'man-edit',
                        'man-delete',
                ],
            'search' => [ 'man-allow',

            ],

        ];

        foreach ($permissions as $key => $permission) {
            foreach ($permission as $item) {
                Permission::updateOrCreate([
                    'name' => $item,
                    'title' => $key
                ]);
            }
        }
    }
}
