<?php

namespace App\Src\Orders\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'client_id',
        'tariff_id',
        'delivery_since',
        'delivery_address'
    ];

    protected $dates = ['delivery_since'];

    protected $casts = [
        'delivery_address' => 'array',
    ];
}