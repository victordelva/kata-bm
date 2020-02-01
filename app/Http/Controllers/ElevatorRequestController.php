<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller as BaseController;
use App\Http\Services\SequencesService;
use Illuminate\Http\Request;

class ElevatorRequestController extends BaseController
{
    public function transformSequences(Request $request, SequencesService $sequencesService)
    {
        $sequencesService->transformSequences();
    }

    public function getAll(Request $request, SequencesService $sequencesService)
    {
        return $sequencesService->getAllElevatorRequest();
    }
}
