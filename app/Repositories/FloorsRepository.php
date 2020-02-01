<?php

namespace App\Repositories;

use App\Domain\ElevatorRequest;
use App\Domain\Floor;
use Illuminate\Support\Facades\DB;

class FloorsRepository implements FloorsRepositoryContract
{
    public function all()
    {
        return Floor::all();
    }
}
