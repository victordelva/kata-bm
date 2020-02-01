<?php

namespace App\Repositories;

interface ElevatorRepositoryContract
{
    public function closest($origin);
}
