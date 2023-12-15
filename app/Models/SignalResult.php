<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SignalResult extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "signal_result";
    protected $guarded = [];
}
