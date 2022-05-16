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
        if (empty($genre->slug)){
            $genre->slug = \Str::slug($genre->title);
        }
    }
}
