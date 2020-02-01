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
        $requests = $this->elevatorRequestRepository->all();
        /** @var ElevatorRequest $request */
        foreach ($requests as $request) {
            $elevator = $this->getBestElevator($request->getOrigin());

            $floorsRequest = abs($elevator->current_floor_id - $request->getOrigin());
            $floorsDestiny = abs($request->getOrigin() - $request->getDestiny());

            $this->elevatorRepository->update([
                "current_floor_id" => $request->getDestiny(),
            ], $elevator->id);

            $this->elevatorRequestRepository->update([
                "elevator_id" => $elevator->id,
                "floors_on_request" => $floorsRequest,
                "floors_on_movement" => $floorsDestiny,
            ], $request->id);
        }
    }

    public function getBestElevator($origin)
    {
        return new Elevator($this->elevatorRepository->closest($origin));
    }
}
