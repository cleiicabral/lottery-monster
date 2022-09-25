<?php

namespace App\Repositories\LotteryPlayerNumber;

use App\Models\LotteryPlayerNumber;
use App\Repositories\Interfaces\LotteryPlayerNumber\LotteryPlayerNumberRepositoryInterface;

class LotteryPlayerNumberRepository implements LotteryPlayerNumberRepositoryInterface
{

    private LotteryPlayerNumber $model;

    public function __construct(LotteryPlayerNumber $model)
    {
        $this->model = $model;
    }

    public function create(string $lotteryPlayerId, string $lotteryTicketId, int $numberTicket): ?LotteryPlayerNumber
    {
        try {
            $result = $this->model::create([
                'lottery_player_id'=> $lotteryPlayerId,
                'lottery_ticket_id' => $lotteryTicketId,
                'number_ticket' => $numberTicket]);

            return $result;
        } catch (\Throwable $th) {
            return null;
        }
    }
}
