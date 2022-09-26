<?php

namespace App\Http\Services\LotteryTicket;

use App\Jobs\LotteryDraw\LotteryDrawJob;
use App\Repositories\Interfaces\LotteryDrawingHeld\LotteryDrawingHeldRepositoryInterface;
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
    private LotteryDrawingHeldRepositoryInterface $lotteryDrawingHeldRepository;

    public function __construct(
        LotteryTicketRepositoryInterface $lotteryTicketRepository,
        LotteryPlayerNumberRepositoryInterface $lotteryPlayerNumberRepository,
        LotteryPlayerRepositoryInterface $lotteryPlayerRepository,
        LotteryDrawingHeldRepositoryInterface $lotteryDrawingHeldRepository
    )
    {
        $this->lotteryTicketRepository = $lotteryTicketRepository;
        $this->lotteryPlayerNumberRepository = $lotteryPlayerNumberRepository;
        $this->lotteryPlayerRepository = $lotteryPlayerRepository;
        $this->lotteryDrawingHeldRepository = $lotteryDrawingHeldRepository;
    }

    public function execute(string $fullname, array $playerNumbers)
    {
        $resultTicket = '';
        $drawIdentifier = '';
        DB::transaction(function () use ($fullname,$playerNumbers,&$resultTicket,&$drawIdentifier) {

            $resultCreatePlayer = $this->lotteryPlayerRepository->create($fullname);

            if(!$resultCreatePlayer){
                throw new Exception('Unable to create player');
            }

            $resultCreateDraw = $this->lotteryDrawingHeldRepository->create(Uuid::uuid6());

            if(!$resultCreateDraw){
                throw new Exception("Unable to create draw");
            }

            $ticketCode = Uuid::uuid6();
            $drawIdentifier = $resultCreateDraw->draw_identifier;

            $resultTicket = $this->lotteryTicketRepository->create($ticketCode,$resultCreatePlayer->id,$drawIdentifier);

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


        LotteryDrawJob::dispatch($drawIdentifier);


        return $resultTicket;
    }
}
