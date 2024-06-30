<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orderline extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $appends = [];
    protected $hidden = [];

    public function order()
    {
        return $this->belongsTo(Order::class)->withDefault();  // a record belongs to a genre
    }

    public function product()
    {
        return $this->belongsTo(Product::class)->withDefault();  // a record belongs to a genre
    }
}
