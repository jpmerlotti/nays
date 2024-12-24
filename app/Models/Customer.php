<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'email'
    ];

    public function cares(): HasMany
    {
        return $this->hasMany(Care::class);
    }

    public function anamnesis(): HasMany
    {
        return $this->hasMany(Anamnese::class);
    }

    public function tratments(): HasMany
    {
        return $this->hasMany(Treatment::class);
    }
}
