<?php

namespace App\Repositories\Interfaces\LotteryTicket;

use App\Http\Dtos\LotteryTicket\CreateLotteryTicketDto;
use App\Models\LotteryTicket;

interface LotteryTicketRepositoryInterface
{
    public function create(CreateLotteryTicketDto $lotteryTicketDto): ?LotteryTicket;
    public function show(string $ticketCode): ?LotteryTicket;
    public function findById(string $lotteryTicketId): ?LotteryTicket;
    public function updateIsWinner(string $lotteryTicketId, bool $isWinner): ?LotteryTicket;
}
