<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Event as EventRequest;
use App\Entities\Event;
use App\Repositories\Repository;
use Helper;

class EventController extends Controller
{
    protected $repository;

    /**
     * Setup repository 
     */
    public function __construct(Event $event) {
        $this->repository = new Repository($event);
    }

    public function index()
    {
        return $this->repository->all();
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $request)
    {
        $data = $this->repository->store($request->validated());
        return Helper::apiResponse(true, $data, 201);
    }

    /**
     * Get resource in storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->repository->show($id);
    }
}
