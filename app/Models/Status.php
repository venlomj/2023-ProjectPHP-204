<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $appends = [];
    protected $hidden = [];

    public function user_series()
    {
        return $this->belongsTo(UserSeries::class)->withDefault();
    }
}
