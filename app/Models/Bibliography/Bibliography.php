<?php

namespace App\Models\Bibliography;

use App\Models\Country;
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
    public static function getBibliography()
    {
       $row_biblography = Bibliography::find(self::addBibliography(Auth::id()));

       return $row_biblography;
    }

    public static function updateBibliography($request,$id){

        $bibliography = Bibliography::find($id);
        $bibliography->update($request);

        if (isset($request['country'])) {
            $bibliography->country_id=$request['country'];
            BibliographyHasCountry::bindBibliographyCountry($bibliography->id,$request['country']);
            $bibliography->save();

        }
        return  $bibliography;

    }


    public static function tag(){


    }






}
