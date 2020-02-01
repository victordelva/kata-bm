<?php


namespace App\Repositories;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{

    public function register()
    {
        $this->app->bind(
            SequenceElevatorRequestRepositoryContract::class,
            SequenceElevatorRequestRepository::class
        );

        $this->app->bind(
            ElevatorRequestRepositoryContract::class,
            ElevatorRequestRepository::class
        );

        $this->app->bind(
            ElevatorRepositoryContract::class,
            ElevatorRepository::class
        );

        $this->app->bind(
            FloorsRepositoryContract::class,
            FloorsRepository::class
        );
    }
}
