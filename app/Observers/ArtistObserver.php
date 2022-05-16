<?php

namespace App\Observers;

use App\Models\Artist;

class ArtistObserver
{
    public function creating(Artist $artist)
    {
        $this->setSlug($artist);
    }

    public function updating(Artist $artist)
    {
        $this->setSlug($artist);
    }

    protected function setSlug(Artist $artist)
    {
        if (empty($artist->slug)){
            $artist->slug = \Str::slug($artist->nickname);
        }
    }
}
