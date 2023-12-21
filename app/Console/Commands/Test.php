<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // $data = DB::table('man')->selectRaw("
        //           SUM(IF(passed_signal.end_date IS NULL OR has_signal.end_date IS NULL, 1, 0)) as signalCount,
        //           man.id,
        //           man.birth_day,
        //           man.birth_month,
        //           man.birth_year,
        //           man.start_year,
        //           man.end_year,
        //           man.attention,
        //           man.occupation,
        //           man.start_wanted,
        //           man.entry_date,
        //           man.exit_date,
        //           man.opened_dou,
        //           group_concat(last_name.last_name separator ',') last_name,
        //           group_concat(first_name.first_name separator ',') first_name,
        //           group_concat(middle_name.middle_name separator ',') middle_name,
        //           country_ate.name,
        //           region.name,
        //           locality.name,
        //           group_concat(passport.number separator ',') passport_number,
        //           gender.name,
        //           nation.name,
        //           group_concat(c.name separator ',') country_name,
        //           group_concat(language.name separator ',') language_name,
        //           group_concat(more_data_man.text separator ',') more_data_text,
        //           religion.name,
        //           group_concat(country_search.name separator ',') search_country_name,
        //           group_concat(operation_category.name separator ',') operation_category_name,
        //           group_concat(education.name separator ',') education_name,
        //           group_concat(party.name separator ',') party_name,
        //           group_concat(nickname.name separator ',') nickname_name,
        //           resource.name
        //     ")
        //     ->leftJoin('man_passed_by_signal', 'man.id', '=', 'man_passed_by_signal.man_id')
        //     ->leftJoin('signal as passed_signal', 'man_passed_by_signal.signal_id', '=', 'passed_signal.id')
        //     ->leftJoin('signal_has_man', 'man.id', '=', 'signal_has_man.man_id')
        //     ->leftJoin('signal as has_signal', 'signal_has_man.signal_id', '=', 'has_signal.id')
        //     ->leftJoin('address', 'man.born_address_id', '=', 'address.id')
        //     ->leftJoin('country_ate', 'address.country_ate_id', '=', 'country_ate.id')
        //     ->leftJoin('region', 'address.region_id', '=', 'region.id')
        //     ->leftJoin('locality', 'address.locality_id', '=', 'locality.id')
        //     ->leftJoin('man_has_first_name', 'man.id', '=', 'man_has_first_name.man_id')
        //     ->leftJoin('first_name', 'man_has_first_name.first_name_id', '=', 'first_name.id')
        //     ->leftJoin('man_has_last_name', 'man.id', '=', 'man_has_last_name.man_id')
        //     ->leftJoin('last_name', 'man_has_last_name.last_name_id', '=', 'last_name.id')
        //     ->leftJoin('man_has_middle_name', 'man.id', '=', 'man_has_middle_name.man_id')
        //     ->leftJoin('middle_name', 'man_has_middle_name.middle_name_id', '=', 'middle_name.id')
        //     ->leftJoin('man_has_passport', 'man.id', '=', 'man_has_passport.man_id')
        //     ->leftJoin('passport', 'man_has_passport.passport_id', '=', 'passport.id')
        //     ->leftJoin('gender', 'man.gender_id', '=', 'gender.id')
        //     ->leftJoin('nation', 'man.nation_id', '=', 'nation.id')
        //     ->leftJoin('man_belongs_country', 'man.id', '=', 'man_belongs_country.man_id')
        //     ->leftJoin('country as c', 'man_belongs_country.country_id', '=', 'c.id')
        //     ->leftJoin('man_knows_language', 'man.id', '=', 'man_knows_language.man_id')
        //     ->leftJoin('language', 'man_knows_language.language_id', '=', 'language.id')
        //     ->leftJoin('more_data_man', 'man.id', '=', 'more_data_man.man_id')
        //     ->leftJoin('religion', 'man.religion_id', '=', 'religion.id')
        //     ->leftJoin('country_search_man', 'man.id', '=', 'country_search_man.man_id')
        //     ->leftJoin('country as country_search', 'country_search_man.country_id', '=', 'country_search.id')
        //     ->leftJoin('man_has_operation_category', 'man.id', '=', 'man_has_operation_category.man_id')
        //     ->leftJoin('operation_category', 'man_has_operation_category.operation_category_id', '=', 'operation_category.id')
        //     ->leftJoin('man_has_education', 'man.id', '=', 'man_has_education.man_id')
        //     ->leftJoin('education', 'man_has_education.education_id', '=', 'education.id')
        //     ->leftJoin('man_has_party', 'man.id', '=', 'man_has_party.man_id')
        //     ->leftJoin('party', 'man_has_party.party_id', '=', 'party.id')
        //     ->leftJoin('man_has_nickname', 'man.id', '=', 'man_has_nickname.man_id')
        //     ->leftJoin('nickname', 'man_has_nickname.nickname_id', '=', 'nickname.id')
        //     ->leftJoin('resource', 'man.resource_id', '=', 'resource.id')
        //     ->groupBy('man.id')
        //     ->orderBy('man.id')
        //     ->get()->toArray();

        // file_put_contents('aaaaaa.php', print_r($data, true));

        $fl = [
            "filter" => [
                [
                    "name" => "id",
                    "sort" => "null",
                    "bibliography_id" => null,
                    "actions" => [
                        [
                            "action" => ">=",
                            "value" => "5"
                        ]
                    ],
                    "table_name" => "man",
                    "section_name" => "open"
                ],
                [
                    "name" => "last_name",
                    "sort" => "null",
                    "bibliography_id" => null,
                    "actions" => [
                        [
                            "action" => "%-%",
                            "value" => "ds"
                        ]
                    ],
                    "table_name" => "man",
                    "section_name" => "open"
                ],
                [
                    "bibliography_id" => null,
                    "name" => "first_name",
                    "sort" => "null",
                    "table_name" => "man",
                    "section_name" => "open"
                ],
                [
                    "bibliography_id" => null,
                    "name" => "middle_name",
                    "sort" => "null",
                    "table_name" => "man",
                    "section_name" => "open"
                ],
                [
                    "bibliography_id" => null,
                    "name" => "birth_day",
                    "sort" => "null",
                    "table_name" => "man",
                    "section_name" => "open"
                ],
                [
                    "bibliography_id" => null,
                    "name" => "birth_month",
                    "sort" => "null",
                    "table_name" => "man",
                    "section_name" => "open"
                ],
                [
                    "name" => "birth_year",
                    "sort" => "null",
                    "bibliography_id" => null,
                    "actions" => [
                        [
                            "action" => "=",
                            "value" => "1231"
                        ],
                        [
                            "action" => "=",
                            "value" => "123132"
                        ]
                    ],
                    "query" => "and",
                    "table_name" => "man",
                    "section_name" => "open"
                ],
                [
                    "bibliography_id" => null,
                    "name" => "full_name",
                    "sort" => "null",
                    "table_name" => "man",
                    "section_name" => "open"
                ],
                [
                    "bibliography_id" => null,
                    "name" => "country_ate",
                    "sort" => "null",
                    "table_name" => "man",
                    "section_name" => "open"
                ],
                [
                    "bibliography_id" => null,
                    "name" => "region",
                    "sort" => "null",
                    "table_name" => "man",
                    "section_name" => "open"
                ],
                [
                    "bibliography_id" => null,
                    "name" => "locality",
                    "sort" => "null",
                    "table_name" => "man",
                    "section_name" => "open"
                ],
                [
                    "bibliography_id" => null,
                    "name" => "start_year",
                    "sort" => "null",
                    "table_name" => "man",
                    "section_name" => "open"
                ],
                [
                    "bibliography_id" => null,
                    "name" => "passport",
                    "sort" => "null",
                    "table_name" => "man",
                    "section_name" => "open"

                ],
                [
                    "bibliography_id" => null,
                    "name" => "gender",
                    "sort" => "null",
                    "table_name" => "man",
                    "section_name" => "open"
                ],
                [
                    "name" => "nation",
                    "sort" => "null",
                    "bibliography_id" => null,
                    "actions" => [
                        [
                            "action" => "%-%",
                            "value" => "scas"
                        ]
                    ],
                    "table_name" => "man",
                    "section_name" => "open"
                ],
                [
                    "bibliography_id" => null,
                    "name" => "man_belongs_country",
                    "sort" => "null",
                    "table_name" => "man",
                    "section_name" => "open"
                ],
                [
                    "bibliography_id" => null,
                    "name" => "man_knows_language",
                    "sort" => "null",
                    "table_name" => "man",
                    "section_name" => "open"
                ],
                [
                    "bibliography_id" => null,
                    "name" => "attention",
                    "sort" => "null",
                    "table_name" => "man",
                    "section_name" => "open"
                ],
                [
                    "bibliography_id" => null,
                    "name" => "more_data",
                    "sort" => "null",
                    "table_name" => "man",
                    "section_name" => "open"
                ],
                [
                    "bibliography_id" => null,
                    "name" => "religion",
                    "sort" => "null",
                    "table_name" => "man",
                    "section_name" => "open"
                ],
                [
                    "bibliography_id" => null,
                    "name" => "occupation",
                    "sort" => "null",
                    "table_name" => "man",
                    "section_name" => "open"
                ],
                [
                    "bibliography_id" => null,
                    "name" => "country_search_man",
                    "sort" => "null",
                    "table_name" => "man",
                    "section_name" => "open"
                ],
                [
                    "bibliography_id" => null,
                    "name" => "operation_category",
                    "sort" => "null",
                    "table_name" => "man",
                    "section_name" => "open"
                ],
                [
                    "bibliography_id" => null,
                    "name" => "start_wanted",
                    "sort" => "null",
                    "table_name" => "man",
                    "section_name" => "open"
                ],
                [
                    "bibliography_id" => null,
                    "name" => "entry_date",
                    "sort" => "null",
                    "table_name" => "man",
                    "section_name" => "open"
                ],
                [
                    "bibliography_id" => null,
                    "name" => "exit_date",
                    "sort" => "null",
                    "table_name" => "man",
                    "section_name" => "open"
                ],
                [
                    "bibliography_id" => null,
                    "name" => "education",
                    "sort" => "null",
                    "table_name" => "man",
                    "section_name" => "open"
                ],
                [
                    "bibliography_id" => null,
                    "name" => "party",
                    "sort" => "null",
                    "table_name" => "man",
                    "section_name" => "open"
                ],
                [
                    "bibliography_id" => null,
                    "name" => "nickname",
                    "sort" => "null",
                    "table_name" => "man",
                    "section_name" => "open"
                ],
                [
                    "bibliography_id" => null,
                    "name" => "opened_dou",
                    "sort" => "null",
                    "table_name" => "man",
                    "section_name" => "open"
                ],
                [
                    "bibliography_id" => null,
                    "name" => "resource",
                    "sort" => "null",
                    "table_name" => "man",
                    "section_name" => "open"
                ]
            ],
            "search" => [
                "id" => "48",
                "bibliography_id" => null,
                "first_name" => "asas",
                "last_name" => "",
                "middle_name" => "",
                "full_name" => ""
            ]
        ];

        $query = DB::table('man');


        foreach ($fl['search'] as $col_name => $value) {
            if (trim($value)) {
                $query->where($col_name, '=', $value);
            }
        }

        foreach ($fl['filter'] as $item) {
            if (isset($item['actions'])) {
                $name = $item['name'];
                $actions = $item['actions'];
                if (!empty($actions)) {
                    if (
                        count($actions) === 1
                    ) {
                        $action = $actions[0];
                        $this->build($query, $action, $name);
                    } else {
                        $query->where(function ($q) use ($name, $actions) {
                            foreach ($actions as $action) {
                                $this->build($q, $action, $name);
                            }
                        });
                    }
                }
            }
        }
        dd($query->toSql());
    }

    private function build(Builder &$q, array $action, $col_name): void
    {
        if ($action['action'] == '-%' || $action['action'] == '%-%') {
            $action = str_replace('-', $action['value'], $action['action']);
            $q->where($col_name, 'like', $action);
        } else {
            $q->where($col_name, $action['action'], $action['value']);
        }
    }
}
