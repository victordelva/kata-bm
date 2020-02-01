<?php

namespace App\Repositories;

use App\Domain\SequenceElevatorRequest;

class SequenceElevatorRequestRepository implements SequenceElevatorRequestRepositoryContract
{

    /**
     * Get's all
     *
     * @return mixed
     */
    public function all()
    {
        return SequenceElevatorRequest::all();
    }
}
