<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FirstName extends Model
{
    use HasFactory;

    protected $table = 'first_name';

    protected $fillable = [
        'first_name',
    ];

    public static function addFirstName($name): int
    {
        return FirstName::create(['first_name' => $name])->id;
    }

}
