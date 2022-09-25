<?php

namespace App\Providers\LotteryPlayer;

use App\Repositories\Interfaces\LotteryPlayer\LotteryPlayerRepositoryInterface;
use App\Repositories\LotteryPlayer\LotteryPlayerRepository;
use Illuminate\Support\ServiceProvider;

class LotteryPlayerProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            LotteryPlayerRepositoryInterface::class,
            LotteryPlayerRepository::class
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
