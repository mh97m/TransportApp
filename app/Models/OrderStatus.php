<?php

namespace App\Models;

use Illuminate\Support\Str;

class OrderStatus extends BaseModel
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
}
