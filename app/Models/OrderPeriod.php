<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPeriod extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $appends = [];
    protected $hidden = [];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
