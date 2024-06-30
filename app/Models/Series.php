<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class   Series extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $hidden = [];

    public function contest()
    {
        return $this->belongsTo(Contest::class)->withDefault();
    }
    public function distance()
    {
        return $this->belongsTo(Distance::class)->withDefault();
    }
    public function stroke()
    {
        return $this->belongsTo(Stroke::class)->withDefault();
    }
    public function sex()
    {
        return $this->belongsTo(Sex::class)->withDefault();
    }
    public function userseries()
    {
        return $this->hasMany(UserSeries::class,'series_id', 'id');
    }

}
