<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CriminalCaseWorker extends Model
{
    use HasFactory;

    protected $table = 'criminal_case_worker';
    protected $guarded = [];

}
