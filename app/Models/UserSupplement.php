<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSupplement extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $appends = [];
    protected $hidden = [];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }
    public function supplement()
    {
        return $this->belongsTo(Supplement::class)->withDefault();

    }
}
