<?php

namespace App\Models;

use App\Models\Bibliography\Bibliography;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Agency extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'agency';

    protected $fillable = ['name'];

    public $modelRelations = ['bibliography', 'signal', 'controll'];

    public function bibliography(){
        return $this->hasMany(Bibliography::class);
    }
    public function signal(){
        return $this->hasMany(Signal::class);
    }
    public function controll(){
        return $this->hasMany(Controll::class);
    }

}
