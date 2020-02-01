<?php

namespace App\Repositories;

use App\Domain\Elevator;
use App\Domain\ElevatorRequest;
use Illuminate\Support\Facades\DB;

class ElevatorRepository implements ElevatorRepositoryContract
{

    protected $model;

    public function closest($origin)
    {
        return (array)DB::table('elevators')
            ->orderByRaw('ABS( CAST(coalesce(current_floor_id, 1) as SIGNED) - ? ) ASC', $origin)
            ->get()->first();
    }

    public function update(array $data, $id)
    {
        return DB::table('elevators')
            ->where('id', $id)
            ->update($data);
    }

}
