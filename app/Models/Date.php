<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Date extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $appends = [];
    protected $hidden = [];

    public function date_type()
    {
        return $this->belongsTo(DateType::class)->withDefault();
    }

    public function order()
    {
        return $this->belongsTo(Order::class)->withDefault();
    }

}
