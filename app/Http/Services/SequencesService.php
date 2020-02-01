<?php

namespace App\Http\Services;

use App\Domain\SequenceElevatorRequest;
use App\Repositories\ElevatorRequestRepositoryContract;
use App\Repositories\SequenceElevatorRequestRepositoryContract;

class SequencesService
{
    private $sequenceRepository;
    private $elevatorRequestRepository;

    public function __construct(
        SequenceElevatorRequestRepositoryContract $sequenceRepository,
        ElevatorRequestRepositoryContract $elevatorRequestRepository
    )
    {
        $this->sequenceRepository = $sequenceRepository;
        $this->elevatorRequestRepository = $elevatorRequestRepository;
    }

    public function transformSequences()
    {
        $all = $this->getAllSequences();

        foreach ($all as $sequence) {
            $this->transformSequence($sequence);
        }
    }

    public function getAllSequences()
    {
        return $this->sequenceRepository->all();
    }

    public function transformSequence(SequenceElevatorRequest $sequenceElevatorRequest)
    {
       $start = $sequenceElevatorRequest->getStart();
       $end = $sequenceElevatorRequest->getEnd();
       $start = new \DateTime($start);
       $end = new \DateTime($end);
       $interval = $sequenceElevatorRequest->getInterval();
       while ($start < $end) {
           $start->modify('+'.$interval.'seconds');
           $this->elevatorRequestRepository->store([
               'from_floor_id' => $sequenceElevatorRequest->getOriginFloor(),
               'to_floor_ids' => $sequenceElevatorRequest->getDestinationFloor(),
               'time' => $start,
           ]);
       }
    }

    public function getAllElevatorRequest()
    {
        return $this->elevatorRequestRepository->all();
    }

}
