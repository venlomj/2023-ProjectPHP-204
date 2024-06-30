<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DateType extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $appends = [];
    protected $hidden = [];

    public function dates()
    {
        return $this->hasMany(Date::class);
    }
}
