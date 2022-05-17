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
        if(Artist::where('slug',\Str::slug($artist->nickname))->exists())
        {
            $artist_double = Artist::where('slug',\Str::slug($artist->nickname))->first();
            $artist->slug = \Str::slug($artist->nickname).'-'.$artist_double->id;
        }
        elseif (empty($genre->slug)){
            $artist->slug = \Str::slug($artist->nickname);
        }
    }
}
