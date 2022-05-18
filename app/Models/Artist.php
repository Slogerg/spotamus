<?php

namespace App\Models;

use AhmedAliraqi\LaravelMediaUploader\Entities\Concerns\HasUploader;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use LaravelInteraction\Vote\Concerns\Voteable;
use LaravelInteraction\Vote\Concerns\Voter;
use Spatie\MediaLibrary\InteractsWithMedia;

class Artist extends Model
{
    use InteractsWithMedia, HasUploader;
    use HasFactory;


    protected $table = 'artists';
    protected $fillable = [
      'slug',
      'nickname',
      'image',
      'description',
      'from',
      'upvotes',
      'created_at',
      'updated_at',
    ];

}
