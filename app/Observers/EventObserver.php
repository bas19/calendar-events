<?php

namespace App\Observers;

use App\Entities\Event;
use Carbon\CarbonPeriod;
use Carbon\Carbon;

class EventObserver
{
    /**
     * Handle the event "created" event.
     *
     * @param  \App\Event  $event
     * @return void
     */
    public function created(Event $event)
    {
        $period = CarbonPeriod::create($event->start_date->addDay(), $event->end_date);

        foreach($period as $date) {
            $date = $date->format('Y-m-d');
            
            $item = new Event();
            $item->title = $event->title;
            $item->start_date = $date;
            $item->end_date = Carbon::create($date)->addDay();
            $item->saveQuietly();

            $event->events()->save($item);
        }
    }

    /**
     * Handle the event "updated" event.
     *
     * @param  \App\Event  $event
     * @return void
     */
    public function updated(Event $event)
    {
        //
    }

    /**
     * Handle the event "deleted" event.
     *
     * @param  \App\Event  $event
     * @return void
     */
    public function deleted(Event $event)
    {
        //
    }

    /**
     * Handle the event "restored" event.
     *
     * @param  \App\Event  $event
     * @return void
     */
    public function restored(Event $event)
    {
        //
    }

    /**
     * Handle the event "force deleted" event.
     *
     * @param  \App\Event  $event
     * @return void
     */
    public function forceDeleted(Event $event)
    {
        //
    }
}
