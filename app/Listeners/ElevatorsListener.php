<?php

namespace App\Listeners;

use App\Http\Services\ElevatorService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ElevatorsListener
{

    private $elevatorService;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(ElevatorService $elevatorService)
    {
        $this->elevatorService = $elevatorService;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $this->elevatorService->turnOnAll();
    }
}
