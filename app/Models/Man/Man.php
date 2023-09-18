<?php

namespace App\Models\Man;

use App\Models\FirstName;
use App\Models\LastName;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Laravel\Scout\Searchable;

class Man extends Model
{
    use HasFactory, Searchable;

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

    public $asYouType = true;

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

    // public function firstName()
    // {
    //     return $this->hasOne(ManHasFirstName::class, 'man_id', 'id');
    // }

    public function fullName()
    {
        $firstName = $this->firstName(); 
        $firstName = $firstName->first()->first_name;

        $lastName = $this->lastName(); 
        $lastName = $lastName->first()->last_name;

        return $firstName . " " . $lastName;
    }

    public function firstName(): HasOneThrough
    {
        return $this->hasOneThrough(
            FirstName::class, 
            ManHasFirstName::class, 
            'man_id', 
            'id', 
            'id', 
            'first_name_id'
        );
    }

    public function lastName(): HasOneThrough
    {
        return $this->hasOneThrough(
            LastName::class, 
            ManHasLastName::class, 
            'man_id', 
            'id', 
            'id', 
            'last_name_id'
        );
    }

    public function toSearchableArray()
    {
        return [
            'full_name' => $this->fullName(),
        ];
    }

    


}

