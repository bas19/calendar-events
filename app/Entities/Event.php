<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $with = ['events'];

    protected $fillable = ['title', 'start_date', 'end_date'];

    protected $dates = ['start_date', 'end_date'];

    public function events()
    {
        return $this->hasMany('App\Entities\Event', 'event_id');
    }
}
