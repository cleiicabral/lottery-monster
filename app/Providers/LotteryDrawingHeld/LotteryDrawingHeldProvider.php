<?php

namespace App\Providers\LotteryDrawingHeld;

use App\Repositories\Interfaces\LotteryDrawingHeld\LotteryDrawingHeldRepositoryInterface;
use App\Repositories\LotteryDrawingHeld\LotteryDrawingHeldRepository;
use Illuminate\Support\ServiceProvider;

class LotteryDrawingHeldProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            LotteryDrawingHeldRepositoryInterface::class,
            LotteryDrawingHeldRepository::class
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
