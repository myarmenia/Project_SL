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

}
