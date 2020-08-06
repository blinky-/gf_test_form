<?php

namespace App\Src\Tariffs\Models;

use Illuminate\Database\Eloquent\Model;

class Tariff extends Model
{
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'name',
        'price',
        'delivery_days',
    ];

    protected $casts = [
        'delivery_days' => 'array',
        'price' => 'float',
    ];
}