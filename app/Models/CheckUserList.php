<?php

namespace App\Models;

use App\Models\Man\Man;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckUserList extends Model
{
    use HasFactory;
    protected $table = 'check_user_lists';
    protected $guarded = ['birth_day', 'birth_month', 'birth_year'];


    public function man()
    {
        return $this->belongsToMany(Man::class, 'check_user_list_man')->withPivot(['check_user_list_id', 'man_id', 'procent']);
    }
}
