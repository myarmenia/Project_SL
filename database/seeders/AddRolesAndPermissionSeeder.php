<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AddRolesAndPermissionSeeder extends Seeder
{
    private $allPermissionInStart = [
        'man-list',
        'man-create',
        'man-edit',
        'man-delete',
        'bibliography-list',
        'bibliography-create',
        'bibliography-edit',
        'bibliography-delete',
        'external_signs-list',
        'external_signs-create',
        'external_signs-edit',
        'external_signs-delete',
        'phone-list',
        'phone-create',
        'phone-edit',
        'phone-delete',
        'email-list',
        'email-create',
        'email-edit',
        'email-delete',
        'weapon-list',
        'weapon-create',
        'weapon-edit',
        'weapon-delete',
        'car-list',
        'car-create',
        'car-edit',
        'car-delete',
        'address-list',
        'address-create',
        'address-edit',
        'address-delete',
        'work_activity-list',
        'work_activity-create',
        'work_activity-edit',
        'work_activity-delete',
        'man_beann_country-list',
        'man_beann_country-create',
        'man_beann_country-edit',
        'man_beann_country-delete',
        'objects_relation-list',
        'objects_relation-create',
        'objects_relation-edit',
        'objects_relation-delete',
        'action-list',
        'action-create',
        'action-edit',
        'action-delete',
        'event-list',
        'event-create',
        'event-edit',
        'event-delete',
        'signal-list',
        'signal-create',
        'signal-edit',
        'signal-delete',
        'organization-list',
        'organization-create',
        'organization-edit',
        'organization-delete',
        'keep_signal-list',
        'keep_signal-create',
        'keep_signal-edit',
        'keep_signal-delete',
        'criminal_case-list',
        'criminal_case-create',
        'criminal_case-edit',
        'criminal_case-delete',
        'control-list',
        'control-create',
        'control-edit',
        'control-delete',
        'mia_summary-list',
        'mia_summary-create',
        'mia_summary-edit',
        'mia_summary-delete',
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleViewer = Role::updateOrCreate(['name' => 'viewer']);
        $roleEditor = Role::updateOrCreate(['name' => 'editor']);
        Role::updateOrCreate(['name' => 'forsearch']);

        $roleArr = [$roleViewer, $roleEditor];

        foreach ($roleArr as $key => $role) {
            $permissionsId = Permission::whereIn('name', $this->allPermissionInStart)->pluck('id');
            $role->syncPermissions($permissionsId);
        }

    }
}
