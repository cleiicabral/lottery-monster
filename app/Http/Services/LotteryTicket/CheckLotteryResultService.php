<?php

namespace App\Http\Services\LotteryTicket;

use App\Repositories\LotteryTicket\LotteryTicketRepository;
use Exception;

class CheckLotteryResultService
{
    private LotteryTicketRepository $lotteryTicketRepository;

    public function __construct(LotteryTicketRepository $lotteryTicketRepository)
    {
        $this->lotteryTicketRepository = $lotteryTicketRepository;
    }

    public function execute(string $ticketCode)
    {
        $queryTicketresult = $this->lotteryTicketRepository->show($ticketCode);

        if(!$queryTicketresult){
            throw new Exception('Unable to query ticket');
        }

        return $queryTicketresult;
    }
}
