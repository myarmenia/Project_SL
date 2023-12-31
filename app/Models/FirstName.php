<?php

namespace App\Models;

use App\Models\Man\Man;
use App\Models\Man\ManHasFirstName;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FirstName extends Model
{
    use HasFactory;

    protected $table = 'first_name';

    protected $fillable = [
        'first_name',
    ];

    public static function addFirstName($name): int|bool
    {
        $nameVal = FirstName::where('first_name', $name)->first();
        if($nameVal){
            return $nameVal->id;
        }
        $nameId = FirstName::create(['first_name' => $name])->id;

        return $nameId;
    }

    public function man() {
        return $this->belongsToMany(Man::class, 'man_has_first_name');

    }

    public function manHasFirstName()
    {
        return $this->hasMany(manHasFirstName::class);
    }

}
