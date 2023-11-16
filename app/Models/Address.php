<?php

namespace App\Models;

use App\Models\Man\Man;
use App\Traits\FilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Address extends Model
{
    use HasFactory, FilterTrait;

    protected $table = 'address';
    public $timestamps = false;

    protected $tableFields = ['id', 'track', 'home_num', 'housing_num', 'apt_num'];

    protected $relationFields = ['country_ate', 'region', 'locality', 'street'];

    public $modelRelations = ['man', 'man1', 'organization', 'org', 'event', 'action', 'car'];

    public $relation = [
        'country_ate',
        'region',
        'locality',
        'street',
    ];

    public $relationColumn = [
       'id',
       'country_ate',
       'region',
       'locality',
       'street',
       'track',
       'home_num',
       'housing_num',
       'apt_num',
    ];

    protected $fillable = [
        'country_id',
        'region_id',
        'locality_id',
        'street_id',
        'city_id',
        'track',
        'home_num',
        'housing_num',
        'apt_num',
        'country_ate_id',
        'full_address',
    ];


    public static function addAddres($address): int
    {
        // dd($address);
        $newaddress = new Address();

        $newaddress['country_id'] = isset($address['country_id']) ? $address['country_id'] : null;
        $newaddress['region_id'] = isset($address['region_id']) ? $address['region_id'] : null;
        $newaddress['locality_id'] = isset($address['locality_id']) ? $address['locality_id'] : null;
        $newaddress['street_id'] = isset($address['street_id']) ? $address['street_id'] : null;
        $newaddress['city_id'] = isset($address['city_id']) ? $address['city_id'] : null;
        $newaddress['track'] = isset($address['track']) ? $address['track'] : null;
        $newaddress['home_num'] = isset($address['home_num']) ? $address['home_num'] : null;
        $newaddress['housing_num'] = isset($address['housing_num']) ? $address['housing_num'] : null;
        $newaddress['apt_num'] = isset($address['apt_num']) ? $address['apt_num'] : null;
        $newaddress['country_ate_id'] = isset($address['country_ate_id']) ? $address['country_ate_id'] : null;
        $newaddress['full_address'] = isset($address['full_address']) ? $address['full_address'] : null;

        $newaddress->save();

        return $newaddress->id;
    }

    public function man(): BelongsToMany
    {
        return $this->belongsToMany(Man::class, 'man_has_address');
    }

    public function man1()
    {
        return $this->hasMany(Man::class, 'born_address_id');
    }

    public function countryAte(): BelongsTo
    {
        return $this->belongsTo(CountryAte::class, 'country_ate_id');
    }

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    public function locality(): BelongsTo
    {
        return $this->belongsTo(Locality::class, 'locality_id');
    }

    public function country_ate(): BelongsTo
    {
        return $this->belongsTo(CountryAte::class, 'country_ate_id');
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function street(): BelongsTo
    {
        return $this->belongsTo(Street::class, 'street_id');
    }

    public function organization()
    {
        return $this->belongsToMany(Organization::class, 'organization_has_address');
    }

    public function org()
    {
        return $this->hasMany(Organization::class);
    }

    public function car()
    {
        return $this->belongsToMany(Car::class, 'car_has_address');
    }

    public function event()
    {
        return $this->hasMany(Event::class);
    }

    public function action()
    {
        return $this->hasMany(Action::class);
    }


    public function relation_field()
    {
        return [
            __('content.country') => $this->country_ate->name ?? null,
            __('content.region') => $this->region->name ?? null,
            __('content.locality') => $this->locality->name ?? null,
            __('content.street') => $this->street->name ?? null,
            __('content.home_num') => $this->home_num ?? null,
            __('content.housing_num') => $this->housing_num ?? null,
            __('content.apt_num') => $this->apt_num ?? null,
            __('content.track') => $this->track ?? null

        ];
    }
}
