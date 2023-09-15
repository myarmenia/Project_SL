<?php

namespace App\Models;

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
        $newUser = new Man;
        $newUser['birthday_str'] = $man['birthday'];
        $newUser['birth_day'] = $man['birth_day'];
        $newUser['birth_month'] = $man['birth_month'];
        $newUser['birth_year'] = $man['birth_year'];
        $newUser->save();

        return $newUser->id;
    }


}

