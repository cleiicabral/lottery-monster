<?php

namespace App\Providers\LotteryTicket;

use App\Repositories\Interfaces\LotteryTicket\LotteryTicketRepositoryInterface;
use App\Repositories\LotteryTicket\LotteryTicketRepository;
use Illuminate\Support\ServiceProvider;

class LotteryTicketProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            LotteryTicketRepositoryInterface::class,
            LotteryTicketRepository::class
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
