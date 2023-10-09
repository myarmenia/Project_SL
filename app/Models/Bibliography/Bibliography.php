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
        // $bibliography = Bibliography::where('id',$request['bibliography_id'])
        //                             ->update([
        //        'title'=>isset($request['title']) ? $request['title'] : null,
        //        'category_id'=>isset($request['category_id']) ? $request['category_id'] : null,
        //        'access_level_id'=>isset($request['access_level_id']) ? $request['access_level_id'] : null,
        //        'source_agency_id'=>isset($request['source_agency_id']) ? $request['source_agency_id'] : null,
        //        'from_agency_id'=>isset($request['from_agency_id']) ? $request['from_agency_id'] : null,
        //        'source'=>isset($request['source']) ? $request['source'] : null,
        //        'short_desc'=>isset($request['short_desc']) ? $request['short_desc'] : null,
        //        'related_year'=>isset($request['related_year']) ? $request['related_year'] : null,
        //        'country_id'=>isset($request['country_id'])  ? $request['country_id'] : null,
        //        'theme'=>isset($request['theme']) ? $request['theme'] : null,
        //        'source_address'=>isset($request['source_address']) ? $request['source_address'] : null,
        //        'worker_name'=>isset($request['worker_name']) ? $request['worker_name'] : null,
        // ]);
        // $bibliography = Bibliography::where('id',$request['bibliography_id'])->first();
        // $bibliography->
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
