<?php

namespace App\Http\Services\LotteryDraw;

use App\Http\Dtos\NumberDraw\CreateNumberDrawDto;
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

        $numberDrawDto = new CreateNumberDrawDto([
            'lottery_drawing_held_id' => $resultFindLotteryDrawing->id
        ]);

        $resultNumberDrawCreate = [];

        for ($i=0; $i < config('app.quantity_numbers_player'); $i++) {
            $numberDrawDto->number_drawn = rand(1,60);

            $resultNumberDrawCreate[] =  $this->numberDrawnRepository->create($numberDrawDto);
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
