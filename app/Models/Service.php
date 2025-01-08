<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'photo',
        'duration'
    ];

    public function casts(): array
    {
        return [
            'name' => 'string',
            'price' => 'int',
            'duration' => 'int'
        ];
    }

    public function tratments(): HasMany
    {
        return $this->hasMany(Treatment::class);
    }
}
