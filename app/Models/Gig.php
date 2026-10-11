<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gig extends Model
{
    protected $fillable = [
        'title',
        'city',
        'venue',
        'event_date',
        'poster_image',
        'flyer_image',
        'ticket_price',
        'is_approved',
    ];

    protected function casts(): array
    {
        return [
            'event_date' => 'datetime',
            'is_approved' => 'boolean',
        ];
    }
}
