<?php

namespace App\Models\Man;

use App\Models\Action;
use App\Models\Address;
use App\Models\Bibliography\Bibliography;
use App\Models\Car;
use App\Models\CheckUserList;
use App\Models\Country;
use App\Models\CriminalCase;
use App\Models\Education;
use App\Models\Email;
use App\Models\Event;
use App\Models\File\File;
use App\Models\FirstName;
use App\Models\Gender;
use App\Models\Language;
use App\Models\LastName;
use App\Models\ManBeanCountry;
use App\Models\ManExternalSignHasSign;
use App\Models\ManExternalSignHasSignPhoto;
use App\Models\MiaSummary;
use App\Models\MiddleName;
use App\Models\MoreData;
use App\Models\Nation;
use App\Models\NickName;
use App\Models\ObjectsRelation;
use App\Models\OperationCategory;
use App\Models\Organization;
use App\Models\OrganizationHasMan;
use App\Models\Party;
use App\Models\Passport;
use App\Models\Phone;
use App\Models\Photo;
use App\Models\Religion;
use App\Models\Resource;
use App\Models\Sign;
use App\Models\Signal;
use App\Models\TempTables\TmpManFindText;
use App\Models\Weapon;
use App\Traits\FilterTrait;
use App\Traits\ModelRelationTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use PhpOffice\PhpSpreadsheet\Calculation\TextData\Concatenate;

class Man extends Model
{

    use HasFactory, Searchable, ModelRelationTrait, FilterTrait, SoftDeletes;


    public function addSessionFullName($name, $surname)
    {
        session(['name' => $name]);
        session(['surname' => $surname]);
    }

    protected $table = 'man';

    protected $fillable = [
        'full_name',
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

    // 'start_wanted', 'entry_date', 'exit_date'

    public $relationFields = ['religion', 'resource', 'gender', 'nation'];

    protected $tableFields = ['id', 'attention', 'occupation', 'opened_dou', 'full_name', 'start_year'];

    protected $manyFilter = ['birth_day', 'birth_mounth', 'birth_year', 'entry_date', 'exit_date', 'start_wanted'];

    protected $hasRelationFields = ['first_name', 'last_name', 'middle_name', 'passport', 'man_belongs_country', 'man_knows_language', 'country_search_man', 'operation_category', 'education', 'party', 'nickname', 'more_data', 'fullName'];

    protected $addressFields = ['country_ate', 'region', 'locality'];

    public $uniqueFields = [
        'gender_id', 'nation_id', 'religion_id',
        'born_address_id', 'knowen_man_id', 'birth_day',
        'birth_month', 'birth_year', 'birthday',
        'exit_date', 'start_wanted', 'entry_date',
        'resource_id', 'occupation', 'attention', 'opened_dou'
    ];

    public $modelRelations = [
        'man',  'address', 'phone', 'organization_has_man', 'organization', 'man_bean_country',
        'sign', 'action', 'event', 'signal', 'man_passed_by_signal', 'criminal_case', 'mia_summary', 'bibliography',
        'car', 'use_car', 'weapon', 'first_object_relation_man', 'second_object_relation_man', 'second_object_relation_organization'
    ];

    public $relation = [
        'bornAddress',
        'first_name',
        'last_name',
        'middle_name',
        'passport',
        'gender',
        'nation',
        'country',
        'knows_languages',
        'more_data',
        'religion',
        'search_country',
        'operation_category',
        'education',
        'party',
        'nickname',
        'resource',
        // 'photo_count1',
    ];

    public $relationColumn = [
        'id',
        'last_name',
        'first_name',
        'middle_name',
        'birth_day',
        'birth_month',
        'birth_year',
        'full_name',
        'countryAte',
        'region',
        'locality',
        'start_year',
        'passport',
        'gender',
        'nation',
        'country',
        'knows_languages',
        'attention',
        'more_data',
        'religion',
        'occupation',
        'search_country',
        'operation_category',
        'start_wanted',
        'entry_date',
        'exit_date',
        'education',
        'party',
        'nickname',
        'opened_dou',
        'resource',
        // 'photo_count1'
    ];


    // public $asYouType = true;

    public static function addUser($man)
    {

        $newUser = new Man();
        $birthDay = null;
        if (isset($man['birthday_str'])) {
            $birthDay = $man['birthday_str'];
        } elseif (isset($man['birthday'])) {
            $birthDay = $man['birthday'];
        }

        $surname = $man['surname'] ? ' ' . $man['surname'] : "";
        $patronymic = $man['patronymic'] ? ' ' . $man['patronymic'] : "";

        $newUser['full_name'] = $man['name'] . $surname . $patronymic;

        $newUser['birthday_str'] = $birthDay;

        $newUser['birth_day'] = isset($man['birth_day']) ? $man['birth_day'] : null;

        $newUser['birth_month'] = isset($man['birth_month']) ? $man['birth_month'] : null;

        $newUser['birth_year'] = isset($man['birth_year']) ? $man['birth_year'] : null;

        $newUser->save();

        if ($newUser) {
            return $newUser->id;
        }
    }

    public function firstName1(): BelongsToMany
    {
        return $this->belongsToMany(FirstName::class, 'man_has_first_name');
    }

    public function bornAddress(): BelongsTo
    {
        return $this->belongsTo(Address::class, 'born_address_id');
    }

    public function lastName1(): BelongsToMany
    {
        return $this->belongsToMany(LastName::class, 'man_has_last_name');
    }

    public function passport(): BelongsToMany
    {
        return $this->belongsToMany(Passport::class, 'man_has_passport');
    }

    public function middleName1(): BelongsToMany
    {
        return $this->belongsToMany(MiddleName::class, 'man_has_middle_name');
    }

    public function nickName(): BelongsToMany
    {
        return $this->belongsToMany(NickName::class, 'man_has_nickname', 'man_id', 'nickname_id');
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

    public function file1(): BelongsToMany
    {
        return $this->belongsToMany(File::class, 'man_has_file');
    }

    public function externalSignHasSignPhoto(): HasMany
    {
        return $this->hasMany(ManExternalSignHasSignPhoto::class, 'man_id');
    }

    public function man_external_sign_has_sign(): HasMany
    {
        return $this->hasMany(ManExternalSignHasSign::class, 'man_id');
    }

    public function signal_has_man(): BelongsToMany
    {
        return $this->belongsToMany(Signal::class, 'signal_has_man');
    }

    public function man_passed_by_signal(): BelongsToMany
    {
        return $this->belongsToMany(Signal::class, 'man_passed_by_signal');
    }

    public function man_has_bibliography(): BelongsToMany
    {
        //        dd(1);
        return $this->belongsToMany(Bibliography::class, 'man_has_bibliography');
    }

    public function bibliography(): BelongsToMany
    {
        return $this->man_has_bibliography();
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

    // public function toSearchableArray()
    // {

    //     //avelacnel sesionic kam relationic
    //     //this code is for indexing the original data
    //     $firstName = $this->firstName?$this->firstName->first_name:null;
    //     $lastName = $this->lastName?$this->lastName->last_name:null;
    //     // $fullName = $firstName . " " . $lastName;
    //     if(Session::has("name")) {
    //         $firstName = Session::get("name");
    //     }

    //     if(Session::has("surname")) {
    //         $firstName = Session::get("surname");
    //     }


    //     // return [
    //     //     'id' => $this['id'],
    //     //     // 'full-name' => $fullName
    //     //     'full-name' => Session::get('fullName'),
    //     // ];

    //     // dd(Session::get('name'));
    //     return [
    //         'id' => $this['id'],
    //         'name' => $firstName,
    //         'lastname' => $lastName,
    //         // 'name' => $this->firstName->first_name,
    //         // 'lastname' => $this->lastName->last_name,
    //         // 'lastname' => Session::get('surname'),
    //         // 'name' => Session::get('name'),
    //     ];

    //     // return $this->only('name', 'surname');


    // }

    public function email()
    {
        return $this->belongsToMany(Email::class, 'man_has_email');
    }

    public function organization()
    {
        return $this->belongsToMany(Organization::class, 'organization_has_man');
    }


    public function organization_has_man()
    {
        return $this->hasMany(OrganizationHasMan::class);
    }

    public function resource()
    {
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

    public function knows_languages()
    {
        return $this->belongsToMany(Language::class, 'man_knows_language');
    }

    public function more_data()
    {
        return $this->hasMany(MoreData::class, 'man_id');
    }

    public function religion()
    {
        return $this->belongsTo(Religion::class, 'religion_id');
    }

    public function search_country()
    {
        return $this->belongsToMany(Country::class, 'country_search_man');
    }

    public function education()
    {
        return $this->belongsToMany(Education::class, 'man_has_education');
    }

    public function party()
    {
        return $this->belongsToMany(Party::class, 'man_has_party');
    }

    public function beanCountry()
    {
        return $this->hasMany(ManBeanCountry::class);
    }

    public function operationCategory()
    {
        return $this->belongsToMany(OperationCategory::class, 'man_has_operation_category');
    }

    public function countrySearch()
    {
        return $this->belongsToMany(Country::class, 'country_search_man');
    }

    // public function photo()
    // {
    //     return $this->belongsToMany(Photo::class, 'man_external_sign_has_photo');
    // }

    public function activity()
    {
    }

    public function photo_count1()
    {
        return $this->belongsToMany(Photo::class, 'man_external_sign_has_photo');
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

    public function sign()
    {
        return $this->belongsToMany(Sign::class, 'man_external_sign_has_sign');
    }

    public function action()
    {
        return $this->belongsToMany(Action::class, 'action_has_man');
    }

    public function criminal_case()
    {
        return $this->belongsToMany(CriminalCase::class, 'criminal_case_has_man');
    }

    public function mia_summary()
    {
        return $this->belongsToMany(MiaSummary::class, 'man_passes_mia_summary');
    }

    public function car()
    {
        return $this->belongsToMany(Car::class, 'man_has_car');
    }

    public function use_car()
    {
        return $this->belongsToMany(Car::class, 'man_use_car');
    }



    public function man_belongs_country(): BelongsToMany
    {
        return $this->belongsToMany(Country::class, 'man_belongs_country');
    }

    public function man_knows_language()
    {
        return $this->belongsToMany(Language::class, 'man_knows_language');
    }

    public function country_search_man()
    {
        return $this->belongsToMany(Country::class, 'country_search_man');
    }

    public function operation_category()
    {
        return $this->belongsToMany(OperationCategory::class, 'man_has_operation_category');
    }

    public function man_bean_country()
    {
        return $this->beanCountry();
    }

    public function phone()
    {
        return $this->belongsToMany(Phone::class, 'man_has_phone');
    }

    public function nick_name(): BelongsToMany
    {
        return $this->nickName();
    }

    public function weapon()
    {
        return $this->belongsToMany(Weapon::class, 'man_has_weapon');
    }

    public function man()
    {
        $relation1 =  $this->belongsToMany(Man::class, 'man_to_man', 'man_id2', 'man_id1');
        $relation2 = $this->belongsToMany(Man::class, 'man_to_man', 'man_id1', 'man_id2');

        return $relation1->union($relation2);
    }

    public function man_to_man()
    {
        return $this->belongsToMany(Man::class, 'man_to_man', 'man_id1', 'man_id2');
    }

    public function organization_relation(): HasMany
    {
        return $this->hasMany(ObjectsRelation::class, 'first_object_id', 'id')->where('second_obejct_type', 'organization');
    }
    public function man_relation(): HasMany
    {
        return $this->hasMany(ObjectsRelation::class, 'first_object_id', 'id')->where('second_obejct_type', 'man');
    }

    public function first_object_relation_man()
    {
        return $this->belongsToMany(Man::class, 'objects_relation', 'first_object_id', 'second_object_id')->where('second_obejct_type', 'man');
    }

    public function second_object_relation_man()
    {
        return $this->belongsToMany(Man::class, 'objects_relation', 'second_object_id', 'first_object_id')->where('second_obejct_type', 'man');
    }

    public function second_object_relation_organization()
    {
        return $this->belongsToMany(Organization::class, 'objects_relation', 'first_object_id', 'second_object_id')->where('first_object_type', 'man');
    }

    public function born_address()
    {
        return $this->belongsToMany(Address::class, 'born_address_id');
    }

    public function event()
    {
        return $this->belongsToMany(Event::class, 'event_has_man');
    }

    public function relation_field()
    {
        return [
            __('content.last_name') => $this->last_name ? implode(', ', $this->last_name->pluck('last_name')->toArray()) : null,
            __('content.first_name') => $this->first_name ? implode(', ', $this->first_name->pluck('first_name')->toArray()) : null,
            __('content.middle_name')  => $this->middle_name ? implode(', ', $this->middle_name->pluck('middle_name')->toArray()) : null,
            __('content.passport_number')  => $this->passport ? implode(', ', $this->passport->pluck('number')->toArray()) : null,
            __('content.citizenship')  => $this->man_belongs_country ? implode(', ', $this->man_belongs_country->pluck('name')->toArray())  : null,
            __('content.knowledge_of_languages') => $this->knows_languages ? implode(', ', $this->knows_languages->pluck('name')->toArray())  : null,
            __('content.date_of_birth') => $this->birthday ? date('d-m-Y', strtotime($this->birthday)) : null,
            __('content.approximate_year') => $this->start_year . '' . $this->end_year,
            __('content.gender') => $this->gender ? $this->gender->name : null,
            __('content.nationality') => $this->nation ? $this->nation->name : null,
            __('content.attention') => $this->attention ?? null,
            __('content.worship') => $this->religion ? $this->religion->name : null,
            __('content.opened_dou') => $this->opened_dou ?? null,
            __('content.education') =>  $this->education ? implode(', ', $this->education->pluck('name')->toArray()) : null,
            __('content.party') => $this->party ? implode(', ', $this->party->pluck('name')->toArray()) : null,
            __('content.alias') => $this->nick_name ? implode(', ', $this->nick_name->pluck('name')->toArray()) : null,
            __('content.occupation') => $this->occupation ?? null,
            __('content.operational_category_person') => $this->operation_category ? implode(', ', $this->operation_category->pluck('name')->toArray()) : null,
            __('content.source_information') => $this->resource ? $this->resource->name : null,
        ];
    }

    public function relation_field1()
    {

        return [
            // 'id' => $this->id,
            'last_name' => $this->last_name ? [$this->last_name->pluck('id', 'last_name')->toArray()] : null,
            'first_name' =>  $this->first_name ? [$this->first_name->pluck('id', 'first_name')->toArray()] : null,
            'middle_name' =>  $this->middle_name ? [$this->middle_name->pluck('id', 'middle_name')->toArray()] : null,
            'birth_day' =>  $this->birth_day ?? null,
            'birth_month' =>  $this->birth_month ?? null,
            'birth_year' =>  $this->birth_year ?? null,
            'birthday' =>  $this->birthday ?? null,
            'born_address_id' => $this->born_address_id ?? null,
            'passport'  => $this->passport ? [$this->passport->pluck('id', 'number')->toArray()] : null,
            'knows_languages' => $this->knows_languages ? [$this->knows_languages->pluck('id', 'name')->toArray()]  : null,
            'gender_id' => $this->gender ? [$this->gender->pluck('id', 'name')->toArray()] : null,
            'nation_id' => $this->nation ? [$this->nation->pluck('id', 'name')->toArray()] : null,
            'country' => $this->country ? [$this->country->pluck('id', 'name')->toArray()] : null,
            'attention' => $this->attention ?? null,
            'more_data' => $this->more_data ? [$this->more_data->pluck('id', 'text')->toArray()] : null,
            'religion_id' => $this->religion ? [$this->religion->pluck('id', 'name')->toArray()] : null,
            'occupation' => $this->occupation ?? null,
            'search_country' => $this->search_country ? [$this->search_country->pluck('id', 'name')->toArray()] : null,
            'operationCategory' => $this->operationCategory ? [$this->operationCategory->pluck('id', 'name')->toArray()] : null,
            'start_wanted' => $this->start_wanted ?? null,
            'entry_date' => $this->entry_date ?? null,
            'exit_date' => $this->exit_date ?? null,
            'education' => $this->education ? [$this->education->pluck('id', 'name')->toArray()] : null,
            'party' => $this->party ? [$this->party->pluck('id', 'name')->toArray()] : null,
            'nickName' => $this->nickName ? [$this->nickName->pluck('id', 'name')->toArray()] : null,
            'opened_dou' => $this->opened_dou ?? null,
            'resource_id' => $this->resource ? [$this->resource->pluck('id', 'name')->toArray()] : null,


            'man' => $this->man ? [$this->man->pluck('id')->toArray()] : null,
            'address' => $this->address ? [$this->address->pluck('id')->toArray()] : null,
            'phone' => $this->phone ? [$this->phone->pluck('id', 'number')->toArray()] : null,
            'organization_has_man' => $this->organization_has_man ? [$this->organization_has_man->pluck('id', 'name')->toArray()] : null,
            'organization' => $this->organization ? [$this->organization->pluck('id', 'name')->toArray()] : null,
            'sign' => $this->sign ? [$this->sign->pluck('id')->toArray()] : null,
            'action' => $this->action ? [$this->action->pluck('id')->toArray()] : null,
            'event' => $this->event ? [$this->event->pluck('id')->toArray()] : null,
            'signal' => $this->signal ? [$this->signal->pluck('id')->toArray()] : null,
            'man_passed_by_signal' => $this->man_passed_by_signal ? [$this->man_passed_by_signal->pluck('id')->toArray()] : null,
            'criminal_case' => $this->criminal_case ? [$this->criminal_case->pluck('id')->toArray()] : null,
            'mia_summary' => $this->mia_summary ? [$this->mia_summary->pluck('id')->toArray()] : null,
            'bibliography' => $this->bibliography ? [$this->bibliography->pluck('id')->toArray()] : null,
            'car' => $this->car ? [$this->car->pluck('id', 'number')->toArray()] : null,

            'use_car' => $this->use_car ? [$this->use_car->pluck('id')->toArray()] : null,
            'weapon' => $this->weapon ? [$this->weapon->pluck('id')->toArray()] : null,
            'first_object_relation_man' => $this->first_object_relation_man ? [$this->first_object_relation_man->pluck('id')->toArray()] : null,
            'second_object_relation_man' => $this->second_object_relation_man ? [$this->second_object_relation_man->pluck('id')->toArray()] : null,
            'second_object_relation_organization' => $this->second_object_relation_organization ? [$this->second_object_relation_organization->pluck('id')->toArray()] : null,

            // 'photo_count1' => $this->photo_count1 ? [ $this->photo_count1->pluck('id')->toArray()] : null,
            // 'birthday' =>  $this->birthday ? date('d-m-Y', strtotime($this->birthday)) : null,
            // 'start_year' =>  date('d-m-Y', (strtotime($this->start_year) - strtotime($this->end_year))),
            // 'address' => $this->born_address ? [$this->born_address->pluck('id')->toArray()] : null,
        ];
    }


    public function signal()
    {
        return $this->belongsToMany(Signal::class, 'signal_has_man');
    }
    public function check_user_lists()
    {
        return $this->belongsToMany(CheckUserList::class, 'check_user_list_man');
    }

    public function tmp_man(){
        return $this->hasMany(TmpManFindText::class,'find_man_id');
    }


    public function signalCount() {
        $passed_signal = $this->man_passed_by_signal->whereNull('end_date')->count();
        $has_signal = $this->signal_has_man->whereNull('end_date')->count();

        return $passed_signal + $has_signal;
    }


}
