<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;
    protected $table = 'genres';
    protected $fillable = [
        'slug',
        'title',
        'description',
    ];

    public function genres()
    {
        return $this->belongsToMany(Artist::class,'artist_genres','genre_id','artist_id');
    }
}
