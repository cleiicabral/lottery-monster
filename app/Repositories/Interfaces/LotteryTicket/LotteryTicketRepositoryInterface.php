<?php

namespace App\Repositories\Interfaces\LotteryTicket;

use App\Models\LotteryTicket;

interface LotteryTicketRepositoryInterface
{
    public function create(String $ticketCode, bool $isDrawn): ?LotteryTicket;
}
