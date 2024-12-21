<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Province extends BaseModel
{
    /**
     * Get the cities within the province.
     */
    public function cities(): HasMany
    {
        return $this->hasMany(City::class);
    }
}
