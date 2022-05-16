<?php

namespace App\Observers;

use App\Models\Artist;

class ArtistObserver
{
    /**
     * Handle the Artist "created" event.
     *
     * @param  \App\Models\Artist  $artist
     * @return void
     */
    public function creating(Artist $artist)
    {
        $this->setSlug($artist);
    }

    /**
     * Handle the Artist "updated" event.
     *
     * @param  \App\Models\Artist  $artist
     * @return void
     */
    public function updating(Artist $artist)
    {
        //
    }

    /**
     * Handle the Artist "deleted" event.
     *
     * @param  \App\Models\Artist  $artist
     * @return void
     */
    public function deleted(Artist $artist)
    {
        //
    }

    /**
     * Handle the Artist "restored" event.
     *
     * @param  \App\Models\Artist  $artist
     * @return void
     */
    public function restored(Artist $artist)
    {
        //
    }

    /**
     * Handle the Artist "force deleted" event.
     *
     * @param  \App\Models\Artist  $artist
     * @return void
     */
    public function forceDeleted(Artist $artist)
    {
        //
    }
    protected function setSlug(Artist $artist)
    {
        if (empty($artist->slug)){
            $artist->slug = \Str::slug($artist->nickname);
        }
    }
}
