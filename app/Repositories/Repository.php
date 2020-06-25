<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\Interfaces\RepositoryInterface;

class Repository implements RepositoryInterface {
    
    protected $model;

    public function __construct(Model $model) {
        $this->model = $model;
    }

    public function all() {
        return $this->model->get();
    }

    public function store($data) {
        return $this->model::create($data);
    }

    public function show($id) {
        return $this->model::findOrFail($id);
    }

    public function update($id, $data) {
        $model = $this->model::find($id);
        $model->fill($data);
        $model->save();
        return $model;
    }

    public function delete($id) {
        return $this->model::where('id', $id)->delete();
    }
}