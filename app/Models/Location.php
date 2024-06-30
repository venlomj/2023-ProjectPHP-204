<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $appends = ['location_name'];
    protected $hidden = [];
    protected $fillable = [
//        'street',
//        'street_number',
//        'city',
//        'postal_code',
//        'country_id',
        // Add other location fields if necessary
    ];


    public function country()
    {
        return $this->belongsTo(Country::class)->withDefault();
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function contest()
    {
        return $this->belongsTo(Contest::class)->withDefault();
    }

    protected function locationName(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                $location = Location::find($attributes['id']);
                return "{$location->name}, {$location->street} {$location->street_number}, {$location->postal_code} {$location->city}";
            }
        );
    }



}
