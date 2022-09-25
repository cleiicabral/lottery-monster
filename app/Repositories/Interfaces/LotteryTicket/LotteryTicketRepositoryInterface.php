<?php

namespace App\Repositories\Interfaces\LotteryTicket;

use App\Models\LotteryTicket;

interface LotteryTicketRepositoryInterface
{
    public function create(string $ticketCode,string $lotterPlayerId, bool $isDrawn = false): ?LotteryTicket;
    public function show(string $ticketCode): ?LotteryTicket;
}
