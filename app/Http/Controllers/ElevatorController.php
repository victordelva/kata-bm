<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller as BaseController;
use App\Http\Services\ElevatorService;
use App\Http\Services\SequencesService;
use Illuminate\Http\Request;

class ElevatorController extends BaseController
{
    public function turnOn(Request $request, ElevatorService $elevatorService)
    {
        $elevatorService->turnOnAll();
    }
}
