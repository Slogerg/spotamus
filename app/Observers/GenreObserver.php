<?php

namespace App\Observers;

use App\Models\Genre;

class GenreObserver
{
    public function creating(Genre $genre)
    {
        $this->setSlug($genre);
    }

    public function updating(Genre $genre)
    {
        $this->setSlug($genre);
    }

    protected function setSlug(Genre $genre)
    {
        if(Genre::where('slug',\Str::slug($genre->title))->exists())
        {
            $genre_double = Genre::where('slug',\Str::slug($genre->title))->first();

            $genre->slug = \Str::slug($genre->title).'-'.$genre_double->id;
        }
        elseif (empty($genre->slug)){
            $genre->slug = \Str::slug($genre->title);
        }
    }
}
