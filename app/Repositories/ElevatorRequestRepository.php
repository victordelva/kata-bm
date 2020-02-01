<?php

namespace App\Repositories;

use App\Domain\ElevatorRequest;
use Illuminate\Support\Facades\DB;

class ElevatorRequestRepository implements ElevatorRequestRepositoryContract
{
    public function store($params)
    {
        return (new ElevatorRequest($params))->save();
    }


    public function all()
    {
        return ElevatorRequest::all()->sortBy("time");
    }

    public function allOrderedByTime()
    {
        return DB::table('elevator_requests')
            ->select('*')
            ->orderBy('time', 'ASC')->get();
    }

    public function update(array $data, $id)
    {
        return DB::table('elevator_requests')
            ->where('id', $id)
            ->update($data);
    }

    public function getStatus($id)
    {
        return DB::table('elevator_statuses')
            ->where('request_id', $id)
            ->get();
    }
}
