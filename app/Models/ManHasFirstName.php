<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManHasFirstName extends Model
{
    use HasFactory;

    protected $table = 'man_has_first_name';

    public $timestamps = false;

    protected $fillable = [
        'man_id',
        'first_name_id'
    ];

    public static function bindManFirstName($manId, $firstNameId): bool
    {
        $bind = ManHasFirstName::create([
            'man_id' => $manId,
            'first_name_id' => $firstNameId
        ]);

        return $bind !== null;
    }
}
