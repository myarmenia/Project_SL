<?php

namespace App\Models\Bibliography;

use App\Models\AccessLevel;
use App\Models\Action;
use App\Models\Agency;
use App\Models\Controll;
use App\Models\Country;
use App\Models\CriminalCase;
use App\Models\DocCategory;
use App\Models\Event;
use App\Models\File\File;
use App\Models\Man\Man;
use App\Models\Organization;
use App\Models\Signal;
use App\Models\User;
use App\Traits\FilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Bibliography extends Model
{
    use HasFactory, FilterTrait;

    protected $table = "bibliography";

    protected $fillable = [
        "title",
        "user_id",
        "category_id",
        "access_level_id",
        "source_agency_id",
        "from_agency_id",
        "source",
        "short_desc",
        "related_year",
        "country_id",
        "theme",
        "source_address",
        "worker_name",
        "reg_number",
        "reg_date",
        "video"
    ];


    protected $relationFields = ['user', 'agency', 'doc_category', 'access_level', 'source_agency'];

    protected $tableFields = ['id', 'reg_number', 'worker_name', 'source_address', 'short_desc', 'related_year', 'source', 'theme', 'title', 'video'];

    protected $manyFilter = ['created_at', 'reg_date'];

    protected $hasRelationFields = ['country'];

    protected $addressFields = [];

    protected $count = ['files_count1'];

    public $modelRelations = ['man',  'organization', 'signal', 'criminal_case', 'event', 'action', 'controll'];


    public $relation = [
        'user',
        'agency',
        'doc_category',
        'access_level',
        'source_agency',
        'country',
        'files_count1',
    ];

    public $relationColumn = [
        'id',
        'user',
        'created_at',
        'agency',
        'doc_category',
        'access_level',
        'reg_number',
        'reg_date',
        'worker_name',
        'source_agency',
        'source_address',
        'short_desc',
        'related_year',
        'source',
        'country',
        'theme',
        'title',
        'files_count1',
        'video'
    ];

    public static function addBibliography($authUserId): int
    {
        $id = Bibliography::create([
            'user_id' => $authUserId
        ])->id;

        return $id;
    }


    // public static function getBibliography()
    // {
    //    $row_biblography = Bibliography::find(self::addBibliography(Auth::id()));

    public static function getBibliography()
    {
        $row_biblography = Bibliography::find(self::addBibliography(Auth::id()));

        return $row_biblography;
    }

    public static function updateBibliography($request, $id)
    {

        $bibliography = Bibliography::find($id);
        $bibliography->update($request);

        if (isset($request['country'])) {
            $bibliography->country_id = $request['country'];
            BibliographyHasCountry::bindBibliographyCountry($bibliography->id, $request['country']);
            $bibliography->save();
        }
        return  $bibliography;
    }


    // public static function tag(){


    // }
    // ========== relations=============
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function agency()
    {
        return $this->belongsTo(Agency::class, 'from_agency_id');
    }

    public function doc_category()
    {
        return $this->belongsTo(DocCategory::class, 'category_id');
    }

    public function access_level()
    {
        return $this->belongsTo(AccessLevel::class, 'access_level_id');
    }

    public function source_agency()
    {
        return $this->belongsTo(Agency::class, 'source_agency_id');
    }

    public function country()
    {
        return  $this->belongsToMany(Country::class, 'bibliography_has_country');
    }

    public function files()
    {
        return  $this->belongsToMany(File::class, 'bibliography_has_file');
    }

    public function man()
    {
        return  $this->belongsToMany(Man::class, 'man_has_bibliography');
    }

    public function files_count1()
    {
        return $this->belongsToMany(File::class, 'bibliography_has_file');
    }

    // filter relations


    public function user()
    {
        return $this->users();
    }

    public function controll(){
        return $this->hasMany(Controll::class);
    }


    public function organization()
    {
        return $this->belongsToMany(Organization::class, 'organization_has_bibliography');
    }

    public function signal(){
        return $this->hasMany(Signal::class);
    }

    public function criminal_case(){
        return $this->hasMany(CriminalCase::class);
    }

    public function event(){
        return $this->hasMany(Event::class);
    }

    public function action(){
        return $this->hasMany(Action::class);
    }


    public function relation_field()
    {
        return [
            __('content.date_and_time') => $this->created_at ?? null,
            __('content.organ') => $this->agency ? $this->agency->name : null,
            __('content.document_category')  => $this->doc_category ? $this->doc_category->name : null,
            __('content.access_level')  => $this->access_level ? $this->access_level->name : null,
            __('content.created_user')  => $this->users ? $this->users->username  : null,
            __('content.reg_document') => $this->reg_number ?? null,
            __('content.reg_date') => $this->reg_date ?? null,
            __('content.source_agency') => $this->source_agency ? $this->source_agency->name : null,
            __('content.source_address') => $this->source_address ?? null,
            __('content.short_desc') => $this->short_desc ?? null,
            __('content.worker_take_doc') => $this->worker_name ?? null,
            __('content.related_year') => $this->related_year ?? null,
            __('content.source_inf') => $this->source ?? null,

        ];
    }

}
