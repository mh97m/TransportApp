<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'mobile',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'mobile_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the details owned by the user.
     */
    public function details(): HasOne
    {
        if ($this->hasRole('owner')) {
            $relation = $this->hasOne(OwnerDetail::class);
        } elseif ($this->hasRole('driver')) {
            $relation = $this->hasOne(DriverDetail::class);
        }
        return $relation ;
    }

    /**
     * Get the cargos owned by the user.
     */
    public function cargos(): HasMany
    {
        return $this->hasMany(Cargo::class);
    }

    /**
     * Get the user associated with the plan.
     */
    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    /**
     * Get the orders where the user is the driver.
     */
    public function driverOrders(): HasMany
    {
        return $this->hasMany(Order::class, 'driver_id');
    }

    /**
     * Ratings given by the user.
     */
    public function ratingsGiven()
    {
        return $this->hasMany(Rating::class, 'rater_id');
    }

    /**
     * Ratings received by the user.
     */
    public function ratingsReceived()
    {
        return $this->hasMany(Rating::class, 'ratee_id');
    }
}
