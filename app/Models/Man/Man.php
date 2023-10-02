<?php

namespace App\Models\Man;

use App\Models\Address;
use App\Models\File\File;
use App\Models\FirstName;
use App\Models\LastName;
use App\Models\ManHasAddress;
use App\Models\MiddleName;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Laravel\Scout\Searchable;
use Illuminate\Support\Facades\Session;

class Man extends Model
{
    use HasFactory, Searchable;

    public function addSessionFullName($fullName)
    {
        session(['fullName' => $fullName]);
    }

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
        'birth_day',
        'birth_month',
        'birth_year',
        'occupation',
        'birthday_str',
        'opened_dou',
        'start_wanted',
        'entry_date',
        'exit_date',
        'fixing_moment',
        'resource_id',
        'fixing_moment',
        'fixing_moment',
    ];

    public $asYouType = true;

    public static function addUser($man)
    {
        $newUser = new Man();
        $newUser['birthday_str'] = isset($man['birthday_str']) ? $man['birthday_str'] : null;
        $newUser['birth_day'] = isset($man['birth_day']) ? $man['birth_day'] : null;
        $newUser['birth_month'] = isset($man['birth_month']) ? $man['birth_month'] : null;
        $newUser['birth_year'] = isset($man['birth_year']) ? $man['birth_year'] : null;
        $fullName = $man['name'] . " " . $man['surname'];
        $newUser->addSessionFullName($fullName);
        $newUser->save();

        if($newUser){

            return $newUser->id;
        }

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

    public function middleName(): HasOneThrough
    {
        return $this->hasOneThrough(
            MiddleName::class,
            ManHasMIddleName::class,
            'man_id',
            'id',
            'id',
            'middle_name_id'
        );
    }
    public function file(): HasOneThrough
    {
        return $this->hasOneThrough(
            File::class,
            ManHasFile::class,
            'man_id',
            'id',
            'id',
            'file_id'
        );
    }
    
    public function addAddres(): HasOneThrough
    {
        return $this->hasOneThrough(
            Address::class,
            ManHasAddress::class,
            'man_id',
            'id',
            'id',
            'address_id'
        );
    }

    public function toSearchableArray()
    {

        //this code is for indexing the original data
        // $firstName = $this->firstName?$this->firstName->first_name:"";
        // $lastName = $this->lastName?$this->lastName->last_name:"";
        // $fullName = $firstName . " " . $lastName;


        return [
            'id' => $this['id'],
            // 'full-name' => $fullName
            'full-name' => Session::get('fullName'),
        ];
    }


}

