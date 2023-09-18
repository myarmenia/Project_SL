<?php

namespace App\Models\Man;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Man extends Model
{
    use HasFactory;

    protected $table = 'man';

    // protected $fillable = [
    //     'gender_id',
    //     'nation_id',
    //     'born_address_id',
    //     'knowen_man_id',
    //     'birthday',
    //     'start_year',
    //     'end_year',
    //     'attention',
    //     'religion_id',
    //     'occupation',
    //     'opened_dou',
    //     'start_wanted',
    //     'entry_date',
    //     'exit_date',
    //     'fixing_moment',
    //     'resource_id',
    //     'fixing_moment',
    //     'fixing_moment',
    // ];

    protected $guarded = [];

    public static function addUser($man)
    {
    
        $newUser = Man::create([
            'birthday_str' => isset($man['birthday_str']) ? $man['birthday_str'] : null,
            'birth_day' => isset($man['birth_day']) ? $man['birth_day'] : null,
            'birth_month' => isset($man['birth_month']) ? $man['birth_month'] : null,
            'birth_year' => isset($man['birth_year']) ? $man['birth_year'] : null,
        ]);

        return $newUser->id;
    }


}

