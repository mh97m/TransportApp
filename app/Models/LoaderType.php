<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LoaderType extends BaseModel
{
    /**
     * Get the car type the loader type belongs to.
     */
    public function carType(): BelongsTo
    {
        return $this->belongsTo(CarType::class);
    }
}
