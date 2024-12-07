<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class CarType extends BaseModel
{
    /**
     * Get the loader types associated with the car type.
     */
    public function loaderTypes(): HasMany
    {
        return $this->hasMany(LoaderType::class);
    }
}
