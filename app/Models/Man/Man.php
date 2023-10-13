<?php

namespace App\Models\Man;

use App\Models\Address;
use App\Models\File\File;
use App\Models\FirstName;
use App\Models\Gender;
use App\Models\LastName;
use App\Models\ManExternalSignHasSignPhoto;
use App\Models\MiddleName;
use App\Models\Nation;
use App\Models\NickName;
use App\Models\Passport;
use App\Traits\ModelRelationTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Support\Facades\Session;
use Laravel\Scout\Searchable;

class Man extends Model
{

    use HasFactory, Searchable, ModelRelationTrait;


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
        $fullName = $man['name']." ".$man['surname'];
        $newUser->addSessionFullName($fullName);
        $newUser->save();

        if ($newUser) {
            return $newUser->id;
        }
    }

    public function firstName1(): BelongsToMany
    {
        return $this->belongsToMany(FirstName::class,'man_has_first_name');
    }

    public function lastName1(): BelongsToMany
    {
        return $this->belongsToMany(LastName::class,'man_has_last_name');
    }

    public function passport(): BelongsToMany
    {
        return $this->belongsToMany(Passport::class,'man_has_passport');
    }

    public function middleName1(): BelongsToMany
    {
        return $this->belongsToMany(MiddleName::class,'man_has_middle_name');
    }

    public function nickName(): BelongsToMany
    {
        return $this->belongsToMany(NickName::class,'man_has_nickname','man_id','nickname_id');
    }


    public function gender(): BelongsTo
    {
        return $this->belongsTo(Gender::class);
    }

    public function nation(): BelongsTo
    {
        return $this->belongsTo(Nation::class);
    }

    public function address(): BelongsToMany
    {
        return $this->belongsToMany(Address::class, 'man_has_address');
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


    public function externalSignHasSignPhoto(): HasMany
    {
        return $this->hasMany(ManExternalSignHasSignPhoto::class);
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

