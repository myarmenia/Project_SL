<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MiddleName extends Model
{
    use HasFactory;

    protected $table = 'middle_name';

    protected $fillable = [
        'middle_name',
    ];

    public static function addMiddleName($name): int|bool
    {
        $middleNameVal = MiddleName::where('middle_name', $name)->first();
        if($middleNameVal){
            return $middleNameVal->id;
        }

        return MiddleName::create(['middle_name' => $name])->id;

    }

}
