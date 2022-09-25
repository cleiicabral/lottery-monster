<?php

namespace App\Http\Services\LotteryTicket;

use App\Repositories\Interfaces\LotteryPlayer\LotteryPlayerRepositoryInterface;
use App\Repositories\Interfaces\LotteryPlayerNumber\LotteryPlayerNumberRepositoryInterface;
use App\Repositories\Interfaces\LotteryTicket\LotteryTicketRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class CreateLotteryTicketService
{
    private LotteryTicketRepositoryInterface $lotteryTicketRepository;
    private LotteryPlayerNumberRepositoryInterface $lotteryPlayerNumberRepository;
    private LotteryPlayerRepositoryInterface $lotteryPlayerRepository;

    public function __construct(
        LotteryTicketRepositoryInterface $lotteryTicketRepository,
        LotteryPlayerNumberRepositoryInterface $lotteryPlayerNumberRepository,
        LotteryPlayerRepositoryInterface $lotteryPlayerRepository
    )
    {
        $this->lotteryTicketRepository = $lotteryTicketRepository;
        $this->lotteryPlayerNumberRepository = $lotteryPlayerNumberRepository;
        $this->lotteryPlayerRepository = $lotteryPlayerRepository;
    }

    public function execute(string $fullname, array $playerNumbers)
    {
        $resultTicket = '';
        DB::transaction(function () use ($fullname,$playerNumbers,&$resultTicket) {

            $resultCreatePlayer = $this->lotteryPlayerRepository->create($fullname);

            if(!$resultCreatePlayer){
                throw new Exception('Unable to create player');
            }

            $ticketCode = Uuid::uuid4();
            $resultTicket = $this->lotteryTicketRepository->create($ticketCode,$resultCreatePlayer->id);

            if(!$resultTicket){
                throw new Exception('Unable to create ticket');
            }

            $resultCreatePlayerNumbers = [];

            for ($i=0; $i < config('app.quantity_numbers_player') ; $i++) {
                $resultCreatePlayerNumbers[] = $this->lotteryPlayerNumberRepository->create($resultCreatePlayer->id, $resultTicket->id,$playerNumbers[$i]);

                if(!$resultCreatePlayerNumbers){
                    throw new Exception('Unable to create player number');
                }
            }

            if($resultCreatePlayer && $resultTicket && $resultCreatePlayerNumbers){
                DB::commit();
            }else{
                DB::rollBack();
            }

        });

        return $resultTicket;
    }
}
