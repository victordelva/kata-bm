<?php

namespace App\Http\Services;

use App\Domain\Elevator;
use App\Domain\ElevatorRequest;
use App\Domain\SequenceElevatorRequest;
use App\Events\TurnOnElevators;
use App\Repositories\ElevatorRepositoryContract;
use App\Repositories\ElevatorRequestRepositoryContract;
use App\Repositories\SequenceElevatorRequestRepositoryContract;

class ElevatorService
{
    private $elevatorRepository;
    private $elevatorRequestRepository;

    public function __construct(
        ElevatorRepositoryContract $elevatorRepository,
        ElevatorRequestRepositoryContract $elevatorRequestRepository
    )
    {
        $this->elevatorRepository = $elevatorRepository;
        $this->elevatorRequestRepository = $elevatorRequestRepository;
    }

    /**
     * Run All Elevator Request
     */
    public function turnOnAll()
    {
        $requests = $this->elevatorRequestRepository->allOrderedByTime();
        /** @var ElevatorRequest $request */
        foreach ($requests as $request) {
            $request = new ElevatorRequest((array)$request);
            $elevator = $this->getBestElevator($request->getOrigin());

            $this->elevatorRepository->update([
                "current_floor_id" => $request->getDestiny()
            ], $elevator->id);

            $this->elevatorRequestRepository->update([
                "elevator_id" => $elevator->id
            ], $request->id);
        }
    }

    public function getBestElevator($origin)
    {
        return new Elevator($this->elevatorRepository->closest($origin));
    }
}
