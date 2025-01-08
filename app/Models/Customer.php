<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'phone',
        'email'
    ];

    public function getShortName(): string
    {
        $name = explode(' ', $this->name);
        return $name[0] . ' ' . $name[count($name) - 1];
    }

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
