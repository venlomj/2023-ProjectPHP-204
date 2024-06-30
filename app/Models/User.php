<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;




//    public function coach()
//    {
//        return $this->belongsTo(Coach::class)->withDefault();
//    }




    public function sex()
    {
        return $this->belongsTo(Sex::class)->withDefault();
    }
    public function userseries()
    {
        return $this->hasMany(UserSeries::class,'user_id','id' );
    }

    public function trainings()
    {
        return $this->hasMany(Training::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function user_supplements()
    {
        return $this->hasMany(UserSupplement::class);
    }

    public function user_series()
    {
        return $this->hasMany(UserSeries::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }



    public function getFullNameAttribute()
    {
        return ucfirst($this->first_name) . ' ' . ucfirst($this->last_name);
    }

    public function scopeSearchLastNameOrFirstName($query, $search = '%')
    {
        return $query->where('last_name', 'like', "%{$search}%")
            ->orWhere('first_name', 'like', "%{$search}%");
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
//        'first_name',
//        'last_name',
//        'email',
//        'phone_number',
//        'birth_date',
//        'password',
//        'active',
//        'is_admin',
//        'is_coach',
//        'is_swimmer',
//        'is_financial_administrator'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */


    //Ik probeer dit even.
    protected $guarded = ["id"];
    protected function userName(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                $name = User::find($attributes['id']);
                return "{$name->first_name} {$name->last_name}";
            }
        );
    }
    protected $appends = ['user_name'];
}
