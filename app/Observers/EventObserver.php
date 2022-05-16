<?php

namespace App\Observers;

use App\Models\Event;

class EventObserver
{
    public function creating(Event $event)
    {
        $this->setSlug($event);
    }

    public function updating(Event $event)
    {
        $this->setSlug($event);
    }

    protected function setSlug(Event $event)
    {
        if (empty($event->slug)){
            $event->slug = \Str::slug($event->title);
        }
    }
}
