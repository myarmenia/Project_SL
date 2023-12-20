<?php

namespace App\Models;

use App\Traits\HelpersTraits;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManExternalSignHasSignPhoto extends Model
{
    use HasFactory;

    protected $table = 'man_external_sign_has_photo';

    protected $fillable = [
        'photo_id',
        'fixed_date',
    ];

    public $timestamps = false;

    public function setFidexDateAttribute($value): void
    {
        $this->attributes['fixed_date'] = HelpersTraits::getDateTimeFormat($value,true);
    }
}
