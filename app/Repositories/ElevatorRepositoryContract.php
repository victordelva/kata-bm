<?php

namespace App\Repositories;

interface ElevatorRepositoryContract
{
    public function closest($origin);
    public function all();
    public function saveStatus(array $params);
}
