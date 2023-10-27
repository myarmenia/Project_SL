<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManExternalSignHasSign extends Model
{
    use HasFactory;

    protected $table = 'man_external_sign_has_sign';

    protected $fillable = [
        'sign_id',
        'fixed_date',
    ];

    public $timestamps = false;

    public function sign() {
        return $this->belongsTo(Sign::class, 'sign_id');
    }
}
