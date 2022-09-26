<?php

namespace App\Repositories\Interfaces\LotteryTicket;

use App\Models\LotteryTicket;

interface LotteryTicketRepositoryInterface
{
    public function create(string $ticketCode,string $lotterPlayerId,string $drawCode, bool $isWinner = false): ?LotteryTicket;
    public function show(string $ticketCode): ?LotteryTicket;
    public function findById(string $lotteryTicketId): ?LotteryTicket;
    public function updateIsWinner(string $lotteryTicketId, bool $isWinner): ?LotteryTicket;
}
