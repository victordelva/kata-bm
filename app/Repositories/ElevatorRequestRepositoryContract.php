<?php

namespace App\Repositories;

interface ElevatorRequestRepositoryContract
{
    public function store($params);
    public function all();
}
