<?php

namespace App\Domain;

use Illuminate\Database\Eloquent\Model;

class ElevatorRequest extends Model
{
    protected $guarded = [];

    public function getOrigin()
    {
        return $this->from_floor_id;
    }

    public function getDestiny()
    {
        return (int)$this->to_floor_ids;
    }
}
