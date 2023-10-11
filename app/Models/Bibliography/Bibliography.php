<?php

namespace App\Models\Bibliography;

use App\Models\AccessLevel;
use App\Models\Agency;
use App\Models\Country;
use App\Models\DocCategory;
use App\Models\User;
use App\Models\File\File;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Bibliography extends Model
{
    use HasFactory;

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

    //    return $row_biblography;
    // }

    // public static function updateBibliography($request,$id){

    //     $bibliography = Bibliography::find($id);
    //     $bibliography->update($request);

    //     if (isset($request['country'])) {
    //         $bibliography->country_id=$request['country'];
    //         BibliographyHasCountry::bindBibliographyCountry($bibliography->id,$request['country']);
    //         $bibliography->save();

    //     }
    //     return  $bibliography;

    // }


    // public static function tag(){


    // }
    // ========== relations=============
    public function users(){

        return $this->belongsTo(User::class,'user_id');
    }
    public function agency(){

        return $this->belongsTo(Agency::class,'from_agency_id');
    }
    public function doc_category(){

        return $this->belongsTo(DocCategory::class,'category_id');
    }
    public function access_level(){

        return $this->belongsTo(AccessLevel::class,'access_level_id');
    }
    public function source_agency(){

        return $this->belongsTo(Agency::class,'source_agency_id');
    }

    public function country(){


        return  $this->belongsToMany(Country::class, 'bibliography_has_country');
    }

    public function files(){

        return  $this->belongsToMany(File::class, 'bibliography_has_file');
    }









}
