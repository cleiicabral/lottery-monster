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

    public function create(string $ticketCode, bool $isDrawn): ?LotteryTicket
    {
        try {
            $result = $this->model::create($ticketCode, $isDrawn);

            return $result;
        } catch (\Throwable $th) {
            return null;
        }
    }
}
