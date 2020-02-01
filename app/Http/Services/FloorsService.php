<?php

namespace App\Http\Services;

use App\Repositories\FloorsRepositoryContract;

class FloorsService
{
    private $floorsRepository ;

    public function __construct(
        FloorsRepositoryContract $floorsRepositoryContract
    )
    {
        $this->floorsRepository = $floorsRepositoryContract;
    }

    public function getAll()
    {
        return $this->floorsRepository->all();
    }
}
