<?php

namespace App\Models\Log;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;
    protected $table = 'log';

    protected $fillable=[
        'user_id',
        'user_ip',
        'type',
        'tb_name',
        'tb_id',
        'second_tb_id',
        'data'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }




}
