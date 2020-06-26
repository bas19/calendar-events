<?php

namespace App\Http\Services;

use Carbon\CarbonPeriod;
use Carbon\Carbon;
use App\Entities\Event;

class EventService {

    public function create($event) 
    {
        $day_in_week = [
            'Mon' => $event['monday'],
            'Tue' => $event['tuesday'],
            'Wed' => $event['wednesday'],
            'Thu' => $event['thursday'],
            'Fri' => $event['friday'],
            'Sat' => $event['saturday'],
            'Sun' => $event['sunday'],
        ];

        $new_event = Event::create([
            'title'=> $event['title'],
            'start_date'=> $event['start_date'],
            'end_date'=> $event['end_date'],
        ]);

        $period = CarbonPeriod::create($new_event->start_date, $new_event->end_date);
        
        foreach ($period as $date) {

            $day = $date->format('D');
            
            // check allowed recurring day
            if ($day_in_week[$day]) {
                $date = $date->format('Y-m-d');
                $item = new Event();
                $item->title = $new_event->title;
                $item->start_date = $date;
                $item->end_date = Carbon::create($date)->addDay();
                $new_event->events()->save($item);
            }
        }

        return $this->show($new_event->id);
    }

    public function show($id)
    {
        return Event::findOrFail($id);
    }
}