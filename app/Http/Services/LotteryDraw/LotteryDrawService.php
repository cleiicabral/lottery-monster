<?php

namespace App\Http\Services\LotteryDraw;

use App\Repositories\Interfaces\LotteryDrawingHeld\LotteryDrawingHeldRepositoryInterface;
use App\Repositories\Interfaces\NumberDrawn\NumberDrawnRepositoryInterface;
use Exception;
use Ramsey\Uuid\Uuid;

class LotteryDrawService
{
    private LotteryDrawingHeldRepositoryInterface $lotteryDrawingHeldRepository;
    private NumberDrawnRepositoryInterface $numberDrawnRepository;
    public function __construct(
        LotteryDrawingHeldRepositoryInterface $lotteryDrawingHeldRepository,
        NumberDrawnRepositoryInterface $numberDrawnRepository
    )
    {
        $this->lotteryDrawingHeldRepository = $lotteryDrawingHeldRepository;
        $this->numberDrawnRepository = $numberDrawnRepository;
    }

    public function execute(string $drawIdentifier)
    {
        $resultFindLotteryDrawing = $this->lotteryDrawingHeldRepository->findByDrawIdentifier($drawIdentifier);

        if(!$resultFindLotteryDrawing){
            throw new Exception('Unable to find draw');
        }

        $resultUpdateLotteryDrawing = $this->lotteryDrawingHeldRepository->updateDrawHeld($resultFindLotteryDrawing->id,true);

        if(!$resultUpdateLotteryDrawing){
            throw new Exception('Unable to update drawn');
        }

        $resultNumberDrawCreate = [];

        for ($i=0; $i < config('app.quantity_numbers_player'); $i++) {
            $numberDrawn = rand(1,60);
            $resultNumberDrawCreate[] =  $this->numberDrawnRepository->create($resultFindLotteryDrawing->id, $numberDrawn);
            if(!$resultNumberDrawCreate){
                throw new Exception('Unable to number draw');
            }
        }

        return [
            'Lottery_drawing' => $resultFindLotteryDrawing,
            'number_draw' => $resultNumberDrawCreate
        ];
    }
}
