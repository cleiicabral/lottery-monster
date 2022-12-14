<?php

namespace App\Repositories\LotteryTicket;

use App\Http\Dtos\LotteryTicket\CreateLotteryTicketDto;
use App\Models\LotteryTicket;
use App\Repositories\Interfaces\LotteryTicket\LotteryTicketRepositoryInterface;

class LotteryTicketRepository implements LotteryTicketRepositoryInterface
{
    private LotteryTicket $model;

    public function __construct(LotteryTicket $model)
    {
        $this->model = $model;
    }

    public function create(CreateLotteryTicketDto $lotteryTicketDto): ?LotteryTicket
    {
        try {
            $result = $this->model::create($lotteryTicketDto->toArray());

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

    public function findById(string $lotteryTicketId): ?LotteryTicket
    {
        try {
            $resultFind = $this->model::find($lotteryTicketId);

            return $resultFind;
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function updateIsWinner(string $lotteryTicketId, bool $isWinner): ?LotteryTicket
    {
        try {
            $lotteryTicket = $this->findById($lotteryTicketId);

            if(!$lotteryTicket){
                return null;
            }

            $lotteryTicket->is_winner = $isWinner;

            return $lotteryTicket->save() ? $lotteryTicket : null;
        } catch (\Throwable $th) {
            return null;
        }
    }

}
