<?php

namespace App\Models;

use App\Models\Man\Man;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Address extends Model
{
    use HasFactory;

    protected $table = 'address';
    public $timestamps = false;

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
        $newaddress=New Address();

        $newaddress['country_id'] = isset($address['country_id']) ? $address['country_id'] :null;
        $newaddress['region_id'] = isset($address['region_id']) ? $address['region_id'] :null;
        $newaddress['locality_id'] = isset($address['locality_id']) ? $address['locality_id'] :null;
        $newaddress['street_id'] = isset($address['street_id']) ? $address['street_id'] :null;
        $newaddress['city_id'] = isset($address['city_id']) ? $address['city_id'] :null;
        $newaddress['track'] = isset($address['track']) ? $address['track'] :null;
        $newaddress['home_num'] = isset($address['home_num']) ? $address['home_num'] :null;
        $newaddress['housing_num'] = isset($address['housing_num']) ? $address['housing_num'] :null;
        $newaddress['apt_num'] = isset($address['apt_num']) ? $address['apt_num'] :null;
        $newaddress['country_ate_id'] = isset($address['country_ate_id']) ? $address['country_ate_id'] :null;
        $newaddress['full_address'] = isset($address['full_address']) ? $address['full_address'] :null;

        $newaddress->save();

        return $newaddress->id;
    }

public function man(): BelongsToMany
{
        return $this->belongsToMany(Man::class,'man_has_address');
}

    public function countryAte(): BelongsTo
    {
        return $this->belongsTo(CountryAte::class,'country_ate_id');
    }

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    public function locality(): BelongsTo
    {
        return $this->belongsTo(Locality::class);
    }
}
