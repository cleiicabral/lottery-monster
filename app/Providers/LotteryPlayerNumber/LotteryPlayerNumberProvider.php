<?php

namespace App\Providers\LotteryPlayerNumber;

use App\Repositories\Interfaces\LotteryPlayerNumber\LotteryPlayerNumberRepositoryInterface;
use App\Repositories\LotteryPlayerNumber\LotteryPlayerNumberRepository;
use Illuminate\Support\ServiceProvider;

class LotteryPlayerNumberProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            LotteryPlayerNumberRepositoryInterface::class,
            LotteryPlayerNumberRepository::class
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
