<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //

    protected $fillable = [
        'type',
        'value_cents',
        'description',
        'proof',
    ];
}
