<?php

namespace App\Providers\NumberDrawn;

use App\Repositories\Interfaces\NumberDrawn\NumberDrawnRepositoryInterface;
use App\Repositories\NumberDrawn\NumberDrawnRepository;
use Illuminate\Support\ServiceProvider;

class NumberDrawnProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            NumberDrawnRepositoryInterface::class,
            NumberDrawnRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
