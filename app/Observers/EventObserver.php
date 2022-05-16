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
        if(Event::where('slug',\Str::slug($event->title))->exists())
        {
            $event_double = Event::where('slug',\Str::slug($event->title))->first();

            $event->slug = \Str::slug($event->title).'-'.$event_double->id;
        }
        elseif (empty($event->slug)){
            $event->slug = \Str::slug($event->title);
        }
    }
}
