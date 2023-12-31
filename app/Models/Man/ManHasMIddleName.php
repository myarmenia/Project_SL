<?php

namespace App\Models\Man;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManHasMIddleName extends Model
{
    use HasFactory;

    protected $table = 'man_has_middle_name';

    public $timestamps = false;

    protected $fillable = [
        'man_id',
        'middle_name_id'	
    ];

    public static function bindManMiddleName($manId, $middleNameId): bool
    {
        $bind = ManHasMIddleName::create([
            'man_id' => $manId,
            'middle_name_id' => $middleNameId
        ]);
        
        return $bind !== null;
    }
}
