<?php

namespace App\Models;

use App\Models\Man\Man;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LastName extends Model
{
    use HasFactory;

    protected $table = 'last_name';

    protected $fillable = [
        'last_name',
    ];

    public static function addLastName($lastname): int|bool
    {
        $lastNameVal = LastName::where('last_name', $lastname)->first();

        if($lastNameVal){
            return $lastNameVal->id;
        }

        $lastNameId = LastName::create(['last_name' => $lastname])->id;

        return $lastNameId;

    }

    public function man()
    {
        return $this->belongsToMany(Man::class, 'man_has_last_name');
    }


}
