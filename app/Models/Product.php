<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'product_type_id', 'measurement_id', 'name','is_active'];
    public function measurement()
    {
        return $this->belongsTo(Measurement::class)->withDefault();
    }

    public function product_type()
    {
        return $this->belongsTo(ProductType::class)->withDefault();
    }

    public function product_prices()
    {
        return $this->hasMany(ProductPrice::class);  // a use has many orders
    }

    public function orderlines()
    {
        return $this->hasMany(Orderline::class);  // a use has many orders
    }


    protected function measureName(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                $measure = Measurement::find($attributes['measurement_id']);
                return "{$measure->name} ";
            }
        );
    }

    protected function productTypeName(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                $productType = ProductType::find($attributes['product_type_id']);
                return "{$productType->name} ";
            }
        );
    }
    protected $appends = ['measure_name', 'product_type_name'];
}
