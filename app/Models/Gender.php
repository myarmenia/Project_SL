<?php

namespace App\Models;

use App\Models\Man\Man;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;


class Gender extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'gender';

    protected $fillable = [
        'name',
    ];

    public function man(): HasMany
    {
        return $this->hasMany(Man::class);
    }
}
