<?php

namespace App\Models;

use App\Models\Man\Man;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoreData extends Model
{
    use HasFactory;

    protected $table = 'more_data_man';

    public function man()
    {
        return $this->belongsTo(Man::class, 'man_id');
    }

}
