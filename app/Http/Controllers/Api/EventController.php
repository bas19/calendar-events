<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Event as EventRequest;
use App\Entities\Event;
use App\Http\Services\EventService;
use Helper;

class EventController extends Controller
{
    protected $service;

    /**
     * Setup service 
     */
    public function __construct(EventService $service) {
        $this->service = $service;
    }

    /**
     * Store a new event in storage.
     *
     * @param  App\Http\Requests\Event  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $request)
    {
        $data = $this->service->create($request->validated());
        return Helper::apiResponse(true, $data, 201);
    }

}
