<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DriverDetail extends BaseModel
{
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
     * Get the user associated with the rating.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
