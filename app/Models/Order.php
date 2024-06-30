<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $appends = [];
    protected $hidden = [];

    public function dates()
    {
        return $this->hasMany(Date::class);
    }

    public function orderlines()
    {
        return $this->hasMany(Orderline::class);
    }

    public function order_period()
    {
        return $this->belongsTo(OrderPeriod::class)->withDefault();
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }
}
