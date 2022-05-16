<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $table = 'events';

    protected $fillable = [
        'title',
        'slug',
        'event_status_id',
        'venue_id',
        'genre_id',
        'start_date',
        'end_time',
        'image',
        'description',
        'upvotes',
    ];

    public function venue(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        //Стаття належить категоріям
        return $this->belongsTo(Venue::class);
    }

    public function tickets()
    {
        return $this->belongsToMany(Ticket::class);
    }
}
