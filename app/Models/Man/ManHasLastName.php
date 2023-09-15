<?php

namespace App\Models\Man;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManHasLastName extends Model
{
    use HasFactory;

    protected $table = 'man_has_last_name';

    public $timestamps = false;

    protected $fillable = [
        'man_id',
        'last_name_id'
    ];

    public static function bindManLastName($manId, $lansNameId): bool
    {
        $bind = ManHasLastName::create([
            'man_id' => $manId,
            'last_name_id' => $lansNameId
        ]);
        
        return $bind !== null;
    }
}

