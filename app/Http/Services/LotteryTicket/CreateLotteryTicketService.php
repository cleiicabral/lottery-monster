<?php

namespace App\Http\Services\LotteryTicket;

use App\Http\Dtos\DrawingHeld\CreateDrawingHeldDto;
use App\Http\Dtos\LotteryPlayerNumber\CreateLotteryPlayerNumberDto;
use App\Http\Dtos\LotteryTicket\CreateLotteryTicketDto;
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
        DB::transaction(function () use ($fullname, $playerNumbers, &$resultTicket, &$drawIdentifier) {

            $resultCreatePlayer = $this->lotteryPlayerRepository->create($fullname);

            if(!$resultCreatePlayer){
                throw new Exception('Unable to create player');
            }

            $lotteryDrawingHeldDto = new CreateDrawingHeldDto([
                'draw_identifier' => Uuid::uuid6()
            ]);

            $resultCreateDraw = $this->lotteryDrawingHeldRepository->create($lotteryDrawingHeldDto);

            if(!$resultCreateDraw){
                throw new Exception("Unable to create draw");
            }

            $lotteryTicketDto = new CreateLotteryTicketDto([
                'ticket_code' => Uuid::uuid6(),
                'lottery_player_id' => $resultCreatePlayer->id,
                'draw_code' => $resultCreateDraw->draw_identifier,
            ]);

            $drawIdentifier = $resultCreateDraw->draw_identifier;

            $resultTicket = $this->lotteryTicketRepository->create($lotteryTicketDto);

            if(!$resultTicket){
                throw new Exception('Unable to create ticket');
            }

            $lotteryPlayerNumberDto = new CreateLotteryPlayerNumberDto([
                'lottery_player_id' => $resultCreatePlayer->id,
                'lottery_ticket_id' => $resultTicket->id,
            ]);

            $resultCreatePlayerNumbers = [];

            for ($i=0; $i < config('app.quantity_numbers_player') ; $i++) {

                $lotteryPlayerNumberDto->number_ticket = $playerNumbers[$i];
                $resultCreatePlayerNumbers[] = $this->lotteryPlayerNumberRepository->create($lotteryPlayerNumberDto);

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
