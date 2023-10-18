<?php

namespace App\Models;

use App\Models\Man\Man;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class NickName extends Model
{
    
    use HasFactory;

    protected $table = 'nickname';

    protected $fillable = [
        'name',
    ];

    public function man(): BelongsToMany
    {
        return $this->belongsToMany(Man::class, 'man_has_nickname');
    }
}
