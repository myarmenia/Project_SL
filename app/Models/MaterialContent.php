<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialContent extends Model
{
    use HasFactory;

    protected $table = 'material_content';

    protected $fillable = [
        'content'
    ];

    public function action() {
        return $this->belongsToMany(Action::class, 'action_has_material_content');
    }
}
