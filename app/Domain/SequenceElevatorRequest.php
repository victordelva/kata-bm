<?php

namespace App\Domain;

use Illuminate\Database\Eloquent\Model;

class SequenceElevatorRequest extends Model
{
    public function destinations()
    {
        return $this->hasMany(Floor::class, 'id');
    }

    public function getStart()
    {
        return $this->start;
    }

    public function getEnd()
    {
        return $this->end;
    }

    public function getInterval()
    {
        return $this->seconds_interval;
    }

    public function getOriginFloor()
    {
        return $this->origin_floor_id;
    }

    public function getDestinationFloor()
    {
        return $this->destination_floor_id;
    }

}
