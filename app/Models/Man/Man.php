<?php

namespace App\Models\Man;

use App\Models\Address;
use App\Models\Country;

use App\Models\Education;
use App\Models\File\File;
use App\Models\FirstName;
use App\Models\Language;
use App\Models\Gender;

use App\Models\LastName;
use App\Models\ManExternalSignHasSignPhoto;
use App\Models\MiddleName;

use App\Models\MoreData;
use App\Models\Nation;
use App\Models\Nickname;
use App\Models\OperationCategory;
use App\Models\Party;
use App\Models\Photo;
use App\Models\Religion;
use App\Models\Resource;
use App\Traits\FilterTrait;


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

    use HasFactory, Searchable, ModelRelationTrait, FilterTrait;


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

    // protected $relationFields = ['religion', 'resource', 'gender', 'passport'];

    protected $tableFields = ['id', 'occupation', 'start_wanted'];

    protected $hasRelationFields = ['first_name', 'last_name', 'middle_name'];

    protected $addressFields = ['country_ate', 'region', 'locality'];

    protected $mecer = ['entry_date'];

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

    public function bornAddress(): BelongsTo
    {
        return $this->belongsTo(Address::class,'born_address_id');
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


    public function address(): BelongsToMany
    {
        return $this->belongsToMany(Address::class, 'man_has_address');
    }



    public function country(): BelongsToMany
    {
        return $this->belongsToMany(Country::class, 'man_belongs_country');
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

    public function resource() {
        return $this->belongsTo(Resource::class, 'resource_id');
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class, 'gender_id');
    }


    public function nation()
    {
        return $this->belongsTo(Nation::class, 'nation_id');
    }

    public function knows_languages() {
        return $this->belongsToMany(Language::class, 'man_knows_language');
    }

    public function more_data()
    {
        return $this->hasOne(MoreData::class, 'man_id');
    }

    public function religion()
    {
        return $this->belongsTo(Religion::class, 'religion_id');
    }

    public function search_country()
    {
        return $this->belongsToMany(Country::class, 'country_search_man');
    }

    public function operation_category()
    {
        return $this->belongsToMany(OperationCategory::class, 'man_has_operation_category');
    }

    public function education()
    {
        return $this->belongsToMany(Education::class, 'man_has_education');
    }

    public function party()
    {
        return $this->belongsToMany(Party::class, 'man_has_party');
    }


    public function photo_count() {
        return $this->belongsToMany(Photo::class, 'man_external_sign_has_photo')->count();
    }

    // filter relations

    public function first_name()
    {
        return $this->belongsToMany(FirstName::class, 'man_has_first_name');
    }

    public function last_name()
    {
        return $this->belongsToMany(LastName::class, 'man_has_last_name');
    }

    public function middle_name()
    {
        return $this->belongsToMany(MiddleName::class, 'man_has_middle_name');
    }

}

