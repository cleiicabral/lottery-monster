<?php

namespace App\Repositories\Interfaces\LotteryPlayerNumber;

use App\Models\LotteryPlayerNumber;

interface LotteryPlayerNumberRepositoryInterface
{
    public function create(string $lotteryPlayerId, string $lotteryTicketId, int $numberTicket): ?LotteryPlayerNumber;
}
