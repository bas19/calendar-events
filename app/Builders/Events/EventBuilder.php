<?php

namespace App\Builders\Events;

use App\Builders\Events\Event; 

class EventBuilder
{
    protected $start_date;
    protected $end_date;

    public $monday    = false;    
    public $tuesday   = false;    
    public $wednesday = false;    
    public $thursday  = false;    
    public $friday    = false;    
    public $saturday  = false;    
    public $sunday    = false;
    
    public function __construct($start_date, $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    public  function addMonday()
    {
        $this->moday = true;
        return $this;
    }

    public  function addTuesday()
    {
        $this->tuesday = true;
        return $this;
    }

    public  function addWednesday()
    {
        $this->wednesday = true;
        return $this;
    }

    public  function addThursday()
    {
        $this->thursday = true;
        return $this;
    }

    public  function addFriday()
    {
        $this->friday = true;
        return $this;
    }

    public  function addSaturday()
    {
        $this->saturday = true;
        return $this;
    }

    public  function addSunday()
    {
        $this->sunday = true;
        return $this;
    }

    public function create()
    {
        return new Event($this);
    }
}