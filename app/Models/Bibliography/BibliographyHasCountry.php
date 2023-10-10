<?php

namespace App\Models\Bibliography;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class BibliographyHasCountry extends Model
{
    use HasFactory;

    protected $table = "bibliography_has_country";

    protected $fillable = [
        'bibliography_id',
        'country_id'
    ];

    public $timestamps = false;

    public static function bindBibliographyCountry($bibliographyId, $countryId): bool
    {
        // dd($countryId);
        $bind = BibliographyHasCountry::updateOrCreate([
            ['bibliography_id','=',$bibliographyId],
            ['country_id','=',$countryId]],
            [
            'bibliography_id' => $bibliographyId,
            'country_id' => $countryId
        ]);

        return $bind !== null;
    }
   


}
