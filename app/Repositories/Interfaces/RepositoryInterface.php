<?php

namespace App\Repositories\Interfaces;

interface RepositoryInterface {
    public function all();
    public function show($id);
    public function store(array $data);
    public function update($id, array $data);
    public function delete($id);
}