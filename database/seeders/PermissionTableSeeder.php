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
            ],
            'agency' => [
                'agency-list',
                'agency-create',
                'agency-edit',
                'agency-delete',
            ],
            'doc_category' => [
                'doc_category-list',
                'doc_category-create',
                'doc_category-edit',
                'doc_category-delete',
            ],
            'access_level' => [
                'access_level-list',
                'access_level-create',
                'access_level-edit',
                'access_level-delete',
            ],
            'gender' => [
                'gender-list',
                'gender-create',
                'gender-edit',
                'gender-delete',
            ],
            'nation' => [
                'nation-list',
                'nation-create',
                'nation-edit',
                'nation-delete',
            ],
            'country' => [
                'country-list',
                'country-create',
                'country-edit',
                'country-delete',
            ],
            'country_ate' => [
                'country_ate-list',
                'country_ate-create',
                'country_ate-edit',
                'country_ate-delete',
            ],
            'language' => [
                'language-list',
                'language-create',
                'language-edit',
                'language-delete',
            ],
            'religion' => [
                'religion-list',
                'religion-create',
                'religion-edit',
                'religion-delete',
            ],
            'region' => [
                'region-list',
                'region-create',
                'region-edit',
                'region-delete',
            ],
            'street' => [
                'street-list',
                'street-create',
                'street-edit',
                'street-delete',
            ],
            'locality' => [
                'locality-list',
                'locality-create',
                'locality-edit',
                'locality-delete',
            ],
            'operation_category' => [
                'operation_category-list',
                'operation_category-create',
                'operation_category-edit',
                'operation_category-delete',
            ],
            'education' => [
                'education-list',
                'education-create',
                'education-edit',
                'education-delete',
            ],
            'party' => [
                'party-list',
                'party-create',
                'party-edit',
                'party-delete',
            ],
            'relation_type' => [
                'relation_type-list',
                'relation_type-create',
                'relation_type-edit',
                'relation_type-delete',
            ],
            'sign' => [
                'sign-list',
                'sign-create',
                'sign-edit',
                'sign-delete',
            ],
            'character' => [
                'character-list',
                'character-create',
                'character-edit',
                'character-delete',
            ],
            'car_category' => [
                'car_category-list',
                'car_category-create',
                'car_category-edit',
                'car_category-delete',
            ],
            'car_mark' => [
                'car_mark-list',
                'car_mark-create',
                'car_mark-edit',
                'car_mark-delete',
            ],
            'goal' => [
                'goal-list',
                'goal-create',
                'goal-edit',
                'goal-delete',
            ],
            'action_goal' => [
                'action_goal-list',
                'action_goal-create',
                'action_goal-edit',
                'action_goal-delete',
            ],
            'action_qualification' => [
                'action_qualification-list',
                'action_qualification-create',
                'action_qualification-edit',
                'action_qualification-delete',
            ],
            'duration' => [
                'duration-list',
                'duration-create',
                'duration-edit',
                'duration-delete',
            ],
            'terms' => [
                'terms-list',
                'terms-create',
                'terms-edit',
                'terms-delete',
            ],
            'aftermath' => [
                'aftermath-list',
                'aftermath-create',
                'aftermath-edit',
                'aftermath-delete',
            ],
            'event_qualification' => [
                'event_qualification-list',
                'event_qualification-create',
                'event_qualification-edit',
                'event_qualification-delete',
            ],
            'worker_post' => [
                'worker_post-list',
                'worker_post-create',
                'worker_post-edit',
                'worker_post-delete',
            ],
            'organization_category' => [
                'organization_category-list',
                'organization_category-create',
                'organization_category-edit',
                'organization_category-delete',
            ],
            'signal_qualification' => [
                'signal_qualification-list',
                'signal_qualification-create',
                'signal_qualification-edit',
                'signal_qualification-delete',
            ],
            'resource' => [
                'resource-list',
                'resource-create',
                'resource-edit',
                'resource-delete',
            ],
            'signal_result' => [
                'signal_result-list',
                'signal_result-create',
                'signal_result-edit',
                'signal_result-delete',
            ],
            'control_result' => [
                'control_result-list',
                'control_result-create',
                'control_result-edit',
                'control_result-delete',
            ],
            'taken_measure' => [
                'taken_measure-list',
                'taken_measure-create',
                'taken_measure-edit',
                'taken_measure-delete',
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
