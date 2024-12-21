<?php

namespace App\Models;

class Rating extends BaseModel
{
    /**
     * Get the order associated with the rating.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the user who gave the rating.
     */
    public function rater()
    {
        return $this->belongsTo(User::class, 'rater_id');
    }

    /**
     * Get the user who received the rating.
     */
    public function ratee()
    {
        return $this->belongsTo(User::class, 'ratee_id');
    }
}
