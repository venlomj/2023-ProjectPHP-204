<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $hidden = [];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }
    public function training_type()
    {
        return $this->belongsTo(TrainingType::class)->withDefault();
    }

    public function location()
    {
        return $this->belongsTo(Location::class)->withDefault();
    }
    protected function trainingstypeName(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                $trainingsType = TrainingType::find($attributes['training_type_id']);
                return "{$trainingsType->name} ";
            }
        );
    }

    protected function swimmerName(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                $zwemmer = User::find($attributes['user_id']);
                return "{$zwemmer->first_name} {$zwemmer->last_name}";
            }
        );
    }
    protected function locationName(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                $location = Location::find($attributes['location_id']);
                return "{$location->name}";
            }
        );
    }
    protected $appends = ['trainings_type_name', 'swimmer_name', 'location_name'];
}

