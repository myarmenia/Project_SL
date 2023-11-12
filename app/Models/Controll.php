<?php

namespace App\Models;

use App\Models\Bibliography\Bibliography;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Controll extends Model
{
    use HasFactory;
    protected $table='control';
    protected $guarded=[];


    public function bibliography(){
        return $this->belongsTo(Bibliography::class,'bibliography_id');
    }
    public function unit(){
        return $this->belongsTo(Agency::class,'unit_id');
    }
    public function doc_category(){
        return $this->belongsTo(DocCategory::class,'doc_category_id');
    }
    public function act_unit(){
        return $this->belongsTo(Agency::class,'act_unit_id');
    }
    public function sub_act_unit(){
        return $this->belongsTo(Agency::class,'sub_act_unit_id');
    }
    public function controll_result(){
        return $this->belongsTo(ControlResult::class,'result_id');
    }





}
