<?php

namespace App\Src\Clients\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'phone',
        'name',
    ];
}