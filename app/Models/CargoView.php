<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CargoView extends BaseModel
{
    /**
     * Get the cargo associated with the order.
     */
    public function cargo(): BelongsTo
    {
        return $this->belongsTo(Cargo::class);
    }

    /**
     * Get the user that owns the Cargo
     */
    public function driver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'driver_id', 'id');
    }
}
