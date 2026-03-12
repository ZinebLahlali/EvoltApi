<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Reservation extends Model
{
    /** @use HasFactory<\Database\Factories\ReservationFactory> */
    use HasFactory;
    protected $fillable = [
        'user_id',
        'borne_id',
        'date',
        'heure',
        'stauts',
    ];

    public function users():BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function borne(): BelongsTo
    {
        return $this->belongsTo(Borne::class);
    }
}
