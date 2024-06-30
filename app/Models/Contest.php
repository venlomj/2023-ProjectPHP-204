<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contest extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $hidden = [];

    public function location()
    {
        return $this->belongsTo(Location::class)->withDefault();
    }

    public function scopeSearchLastNameOrFirstName($query, $search = '%')
    {
        return $query->where('name', 'like', "%{$search}%");
    }

    protected function locationName(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                $location = Location::find($attributes['location_id']);
                return "{$location->name}, {$location->street} {$location->street_number}, {$location->postal_code} {$location->city}";
            }
        );
    }
    public function countryName(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                $location = Location::with('country')->find($attributes['location_id']);
                return $location->country->name;
            }
        );
    }





    protected $appends = ['location_name', 'country_name'];
}
