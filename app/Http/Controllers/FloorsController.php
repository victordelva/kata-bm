<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller as BaseController;
use App\Http\Services\ElevatorService;
use App\Http\Services\FloorsService;
use App\Http\Services\SequencesService;
use Illuminate\Http\Request;

class FloorsController extends BaseController
{
    public function getAll(Request $request, FloorsService $floorsService)
    {
        return $floorsService->getAll();
    }
}
