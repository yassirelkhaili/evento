<?php

namespace App\Providers;

use App\Repositories\EventRepository;
use App\Repositories\EventRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(EventRepositoryInterface::class, EventRepository::class);
    }
}