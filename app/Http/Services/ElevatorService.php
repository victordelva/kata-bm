<?php

namespace App\Http\Services;

use App\Domain\Elevator;
use App\Domain\ElevatorRequest;
use App\Domain\ElevatorStatus;
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
            $bestElevator = $this->getBestElevator($request->getOrigin());
            $elevators = $this->elevatorRepository->all();

            foreach ($elevators as $elevator) {
                $this->elevatorRepository->saveStatus([
                    'elevator_id' => $elevator->id,
                    'floor_id' => $elevator->current_floor_id,
                    'request_id' => $request->id,
                ]);
            }

            $floorsRequest = abs($bestElevator->current_floor_id - $request->getOrigin());
            $floorsDestiny = abs($request->getOrigin() - $request->getDestiny());

            $this->elevatorRepository->update([
                "current_floor_id" => $request->getDestiny(),
            ], $bestElevator->id);

            $this->elevatorRequestRepository->update([
                "elevator_id" => $bestElevator->id,
                "floors_on_request" => $floorsRequest,
                "floors_on_movement" => $floorsDestiny,
            ], $request->id);
        }
    }

    public function getBestElevator($origin)
    {
        return new Elevator($this->elevatorRepository->closest($origin));
    }

    public function getRequestStatus($id)
    {
        return $this->elevatorRequestRepository->getStatus($id);
    }
}
