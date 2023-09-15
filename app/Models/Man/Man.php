<?php

namespace App\Models\Man;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Man extends Model
{
    use HasFactory;

    protected $table = 'man';

    protected $fillable = [
        'gender_id',
        'nation_id',
        'born_address_id',
        'knowen_man_id',
        'birthday',
        'start_year',
        'end_year',
        'attention',
        'religion_id',
        'occupation',
        'opened_dou',
        'start_wanted',
        'entry_date',
        'exit_date',
        'fixing_moment',
        'resource_id',
        'fixing_moment',
        'fixing_moment',
    ];

    public static function addUser($man)
    {
        $newUser = Man::create([
            'birthday_str' => $man['birthday'],
            'birth_day' => $man['birth_day'],
            'birth_month' => $man['birth_month'],
            'birth_year' => $man['birth_year']
        ]);

        return $newUser->id;
    }


}

