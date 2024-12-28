<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Cargo extends BaseModel
{
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->ulid = Str::ulid()->toString();
        });
    }

    public function getRouteKeyName(): string
    {
        return 'ulid';
    }

    // protected $appends = [
    //     'viewsCount',
    // ];

    // public function viewsCount(): Attribute
    // {
    //     return new Attribute(
    //         get: fn () => CargoView::where([
    //             'cargo_id' => $this->id,
    //         ])->count(),
    //     );
    // }

    public function description(): Attribute
    {
        return new Attribute(
            get: fn ($value) => Str::limit($value, 30, preserveWords: true),
        );
    }

    /**
     * Get the owner of the cargo.
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the orders associated with this cargo.
     */
    public function orders(): HasMany
    {
        return $this->HasMany(Order::class);
    }

    /**
     * Get the cargoType that owns the Cargo
     */
    public function cargoType(): BelongsTo
    {
        return $this->belongsTo(CargoType::class, 'cargo_type_id', 'id');
    }

    /**
     * Get the carType that owns the Cargo
     */
    public function carType(): BelongsTo
    {
        return $this->belongsTo(CarType::class, 'car_type_id', 'id');
    }

    /**
     * Get the loaderType that owns the Cargo
     */
    public function loaderType(): BelongsTo
    {
        return $this->belongsTo(LoaderType::class, 'loader_type_id', 'id');
    }

    /**
     * Get the destinationProvince that owns the Cargo
     */
    public function destinationProvince(): BelongsTo
    {
        return $this->belongsTo(Province::class, 'destination_province_id', 'id');
    }

    /**
     * Get the destinationCity that owns the Cargo
     */
    public function destinationCity(): BelongsTo
    {
        return $this->belongsTo(City::class, 'destination_city_id', 'id');
    }

    /**
     * Get the originProvince that owns the Cargo
     */
    public function originProvince(): BelongsTo
    {
        return $this->belongsTo(Province::class, 'origin_province_id', 'id');
    }

    /**
     * Get the originCity that owns the Cargo
     */
    public function originCity(): BelongsTo
    {
        return $this->belongsTo(City::class, 'origin_city_id', 'id');
    }

    /**
     * Get the user that owns the Cargo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
