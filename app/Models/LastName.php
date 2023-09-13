<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LastName extends Model
{
    use HasFactory;

    protected $table = 'last_name';

    protected $fillable = [
        'last_name',
    ];

    public static function addLastName($lastname): int
    {
        $lastNameId = LastName::create(['last_name' => $lastname])->id;
        return $lastNameId;  
    }

}
