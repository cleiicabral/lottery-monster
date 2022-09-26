<?php

namespace App\Http\Services\LotteryTicket;

use App\Repositories\Interfaces\LotteryDrawingHeld\LotteryDrawingHeldRepositoryInterface;
use App\Repositories\LotteryTicket\LotteryTicketRepository;
use Exception;

class CheckLotteryResultService
{
    private LotteryTicketRepository $lotteryTicketRepository;
    private LotteryDrawingHeldRepositoryInterface $lotteryDrawingHeldRepository;

    public function __construct(
        LotteryTicketRepository $lotteryTicketRepository,
        LotteryDrawingHeldRepositoryInterface $lotteryDrawingHeldRepository
    )
    {
        $this->lotteryTicketRepository = $lotteryTicketRepository;
        $this->lotteryDrawingHeldRepository = $lotteryDrawingHeldRepository;
    }

    public function execute(string $ticketCode)
    {
        $queryTicketresult = $this->lotteryTicketRepository->show($ticketCode);

        if(!$queryTicketresult){
            throw new Exception('Unable to query ticket');
        }

        $playerNumbers = [];
        foreach ($queryTicketresult->lotteryPlayerNumber as $playerNumber) {
            $playerNumbers[] = $playerNumber->number_ticket;
        }

        $resultLotteryDrawingHeld = $this->lotteryDrawingHeldRepository->findByDrawIdentifier($queryTicketresult->draw_code);

        if(!$resultLotteryDrawingHeld){
            throw new Exception('Unable to query Lottery Drawing');
        }

        if(!$resultLotteryDrawingHeld->is_drawn){
            $resultLotteryDrawingHeld->message = 'not yet';
            return [
                'ticket' => $queryTicketresult,
                'drawn' => $resultLotteryDrawingHeld,
                'playerNumbers'=> $playerNumbers,
            ];
        }

        $machineNumbers = [];
        foreach ($resultLotteryDrawingHeld->numberDraw as $lotteryDrawing) {
            $machineNumbers[] = $lotteryDrawing->number_drawn;
        }

        $diffArrayNumbers = array_diff($playerNumbers,$machineNumbers);

        if(empty($diffArrayNumbers)){
            $ticketWinner = $this->lotteryTicketRepository->updateIsWinner($queryTicketresult->id,true);
            $resultLotteryDrawingHeld->message = 'you won';
        }else{
            $resultLotteryDrawingHeld->message = 'you lost';
        }

        return [
            'ticket' => $queryTicketresult,
            'drawn' => $resultLotteryDrawingHeld,
            'playerNumbers'=> $playerNumbers,
            'machineNumbers' =>$machineNumbers
        ];
    }
}
