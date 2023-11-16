<?php

namespace App\Models;

use App\Models\Man\Man;
use App\Traits\FilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory, FilterTrait;

    protected $table = 'car';

    protected $tableFields = ['id', 'number', 'note', 'count'];

    protected $relationFields = ['car_category', 'car_mark', 'car_color'];

    public $relation = [
        'car_category',
        'car_mark',
        'color',
    ];

    public $relationColumn = [
        'id',
        'car_category',
        'car_mark',
        'color',
        'number',
        'count',
        'note',
    ];

    protected $guarded = [];

    public $modelRelations = ['man', 'organization', 'action', 'event', 'address'];

    public function car_category()
    {
        return $this->belongsTo(CarCategory::class, 'category_id');
    }

    public function car_mark()
    {
        return $this->belongsTo(CarMark::class, 'mark_id');
    }

    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }

    public function man()
    {
        return $this->belongsToMany(Man::class, 'man_has_car');
    }

    public function organization()
    {
        return $this->belongsToMany(Organization::class, 'organization_has_car');
    }

    public function action()
    {
        return $this->belongsToMany(Action::class, 'action_has_car');
    }

    public function event()
    {
        return $this->belongsToMany(Event::class, 'event_has_car');
    }

    public function address()
    {
        return $this->belongsToMany(Address::class, 'car_has_address');
    }


    public function relation_field()
    {
        return [
            __('content.car_cat') => $this->car_category->name ?? null,
            __('content.mark') => $this->car_mark->name ?? null,
            __('content.color') =>  $this->color->name ?? null,
            __('content.car_number') => $this->number ?? null,
            __('content.count') => $this->count ?? null,
            __('content.additional_data') => $this->note ?? null

        ];
    }

    // filter relations

    public function car_color()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }
}
