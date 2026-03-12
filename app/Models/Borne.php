<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Borne extends Model
{
    /** @use HasFactory<\Database\Factories\BorneFactory> */
    use HasFactory;
    protected $fillable = [
        'name',
        'latitude',
        'longitude',
        'connector_type',
        'is_available',
    ];
    public function reservation():HasMany
    { 
       return $this->hasMany(Reservation::class);
    }
}
