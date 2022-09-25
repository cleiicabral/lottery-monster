<?php

namespace App\Repositories\LotteryTicket;

use App\Models\LotteryTicket;
use App\Repositories\Interfaces\LotteryTicket\LotteryTicketRepositoryInterface;

class LotteryTicketRepository implements LotteryTicketRepositoryInterface
{
    private LotteryTicket $model;

    public function __construct(LotteryTicket $model)
    {
        $this->model = $model;
    }

    public function create(string $ticketCode,string $lotterPlayerId, bool $isDrawn = false): ?LotteryTicket
    {
        try {
            $result = $this->model::create(['ticket_code'=> $ticketCode,
            'lottery_player_id' => $lotterPlayerId,
             'is_drawn' => $isDrawn]);

            return $result;
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function show(string $ticketCode): ?LotteryTicket
    {
        try {
            $resultGetLotteryTicket = $this->model::where('ticket_code',$ticketCode)
                ->with('lotteryPlayerNumber')
                ->with('lotteryPlayer')
                ->first();
           return $resultGetLotteryTicket;
        } catch (\Throwable $th) {
            return null;
        }
    }
}
