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
            'role' => [
                'role-list',
                'role-create',
                'role-edit',
                'role-delete',
            ],

            'user' => [
                'user-list',
                'user-create',
                'user-edit',
                'user-delete',
            ],

            'man' => [
                'man-list',
                'man-create',
                'man-edit',
                'man-delete',
            ],

            'search' => [
                'man-allow',

            ],

            'dictionary' => [
                'dictionary-list',
                'dictionary-create',
                'dictionary-edit',
                'dictionary-delete',
            ],

            'log' => [
                'log-list'
            ],

            'bibliography' => [
                'bibliography-list',
                'bibliography-create',
                'bibliography-edit',
                'bibliography-delete',
            ],

            'external_signs' => [
                'external_signs-list',
                'external_signs-create',
                'external_signs-edit',
                'external_signs-delete',
            ],

            'phone' => [
                'phone-list',
                'phone-create',
                'phone-edit',
                'phone-delete',
            ],

            'email' => [
                'email-list',
                'email-create',
                'email-edit',
                'email-delete',
            ],

            'weapon' => [
                'weapon-list',
                'weapon-create',
                'weapon-edit',
                'weapon-delete',
            ],

            'car' => [
                'car-list',
                'car-create',
                'car-edit',
                'car-delete',
            ],

            'address' => [
                'address-list',
                'address-create',
                'address-edit',
                'address-delete',
            ],

            'work_activity' => [
                'work_activity-list',
                'work_activity-create',
                'work_activity-edit',
                'work_activity-delete',
            ],

            'man_beann_country' => [
                'man_beann_country-list',
                'man_beann_country-create',
                'man_beann_country-edit',
                'man_beann_country-delete',
            ],

            'objects_relation' => [
                'objects_relation-list',
                'objects_relation-create',
                'objects_relation-edit',
                'objects_relation-delete',
            ],

            'action' => [
                'action-list',
                'action-create',
                'action-edit',
                'action-delete',
            ],

            'event' => [
                'event-list',
                'event-create',
                'event-edit',
                'event-delete',
            ],

            'signal' => [
                'signal-list',
                'signal-create',
                'signal-edit',
                'signal-delete',
            ],

            'organization' => [
                'organization-list',
                'organization-create',
                'organization-edit',
                'organization-delete',
            ],

            'keep_signal' => [
                'keep_signal-list',
                'keep_signal-create',
                'keep_signal-edit',
                'keep_signal-delete',
            ],

            'criminal_case' => [
                'criminal_case-list',
                'criminal_case-create',
                'criminal_case-edit',
                'criminal_case-delete',
            ],

            'control' => [
                'control-list',
                'control-create',
                'control-edit',
                'control-delete',
            ],

            'mia_summary' => [
                'mia_summary-list',
                'mia_summary-create',
                'mia_summary-edit',
                'mia_summary-delete',
            ]


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
