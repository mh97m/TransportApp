<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cargo extends BaseModel
{
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
    public function order(): HasMany
    {
        return $this->HasMany(Order::class);
    }

    /**
     * Get the cargoType that owns the Cargo
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cargoType(): BelongsTo
    {
        return $this->belongsTo(CargoType::class, 'cargo_type_id', 'id');
    }

    /**
     * Get the carType that owns the Cargo
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function carType(): BelongsTo
    {
        return $this->belongsTo(CarType::class, 'car_type_id', 'id');
    }

    /**
     * Get the loaderType that owns the Cargo
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function loaderType(): BelongsTo
    {
        return $this->belongsTo(LoaderType::class, 'loader_type_id', 'id');
    }

    /**
     * Get the destinationProvince that owns the Cargo
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function destinationProvince(): BelongsTo
    {
        return $this->belongsTo(Province::class, 'destination_province_id', 'id');
    }

    /**
     * Get the destinationCity that owns the Cargo
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function destinationCity(): BelongsTo
    {
        return $this->belongsTo(City::class, 'destination_city_id', 'id');
    }

    /**
     * Get the originProvince that owns the Cargo
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function originProvince(): BelongsTo
    {
        return $this->belongsTo(Province::class, 'origin_province_id', 'id');
    }

    /**
     * Get the originCity that owns the Cargo
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function originCity(): BelongsTo
    {
        return $this->belongsTo(City::class, 'origin_city_id', 'id');
    }

    /**
     * Get the user that owns the Cargo
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
