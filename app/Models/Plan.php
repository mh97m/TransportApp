<?php

namespace App\Models;

class Plan extends BaseModel
{
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'expire_at' => 'datetime',
        ];
    }
}
