<?php

namespace App\Models\Log;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;
    protected $table = 'log';

    protected $fillable=[
        'user_id',
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
