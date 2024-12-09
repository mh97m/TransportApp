<?php

namespace App\Models;

class DriverDetail extends BaseModel
{
    /**
     * Get the user associated with the rating.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
