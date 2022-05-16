<?php

namespace App\Observers;

use App\Models\Venue;

class VenueObserver
{
    /**
     * Handle the Venue "created" event.
     *
     * @param  \App\Models\Venue  $venue
     * @return void
     */
    public function created(Venue $venue)
    {
        //
    }

    /**
     * Handle the Venue "updated" event.
     *
     * @param  \App\Models\Venue  $venue
     * @return void
     */
    public function updated(Venue $venue)
    {
        //
    }

    /**
     * Handle the Venue "deleted" event.
     *
     * @param  \App\Models\Venue  $venue
     * @return void
     */
    public function deleted(Venue $venue)
    {
        //
    }

    /**
     * Handle the Venue "restored" event.
     *
     * @param  \App\Models\Venue  $venue
     * @return void
     */
    public function restored(Venue $venue)
    {
        //
    }

    /**
     * Handle the Venue "force deleted" event.
     *
     * @param  \App\Models\Venue  $venue
     * @return void
     */
    public function forceDeleted(Venue $venue)
    {
        //
    }
}
