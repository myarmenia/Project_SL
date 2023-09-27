<?php

namespace App\Models\Man;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManHasAddress extends Model
{
    use HasFactory;

    protected $table = 'man_has_address';
    public $timestamps = false;

    protected $fillable = [
        'man_id',
        'address_id',
        'start_date',
        'end_date',
    ];
    public static function bindManAddress($manId, $addressId): bool
    {
        $bind = ManHasAddress::create([
            'man_id' => $manId,
            'address_id' => $addressId
        ]);

        return $bind !== null;
    }

}
