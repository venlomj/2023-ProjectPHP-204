<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSeries extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $appends = [];
    protected $hidden = [];



    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }
    public function series()
    {
        return $this->belongsTo(Series::class, 'series_id','id');
    }


    public function status()
    {
        return $this->belongsTo(Status::class)->withDefault();
    }
}
