<?php

namespace App\Builders\Events;

use App\Builders\Events\EventBuilder;

class Event
{
    protected $start_date;
    protected $end_date;

    protected $monday    = false;
    protected $tuesday   = false;
    protected $wednesday = false;
    protected $thursday  = false;
    protected $friday    = false;
    protected $saturday  = false;
    protected $sunday    = false;

    public function __construct(EventBuilder $event)
    {
        $this->start_date = $event->start_date;
        $this->end_date   = $event->end_date;
        
        $this->monday     = $event->monday;
        $this->tuesday    = $event->tuesday;
        $this->wednesday  = $event->wednesday;
        $this->thursday   = $event->thursday;
        $this->friday     = $event->friday;
        $this->saturday   = $event->saturday;
        $this->sunday     = $event->sunday;
    }
}