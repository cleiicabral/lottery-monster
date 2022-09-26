<?php

namespace App\Repositories\LotteryDrawingHeld;

use App\Models\LotteryDrawingHeld;
use App\Repositories\Interfaces\LotteryDrawingHeld\LotteryDrawingHeldRepositoryInterface;

class LotteryDrawingHeldRepository implements LotteryDrawingHeldRepositoryInterface
{
    private LotteryDrawingHeld $model;

    public function __construct(LotteryDrawingHeld $model)
    {
       $this->model = $model;
    }

    public function create(string $drawIdentifier, ?string $draw_at=null): ?LotteryDrawingHeld
    {

            $resultCreateModel = $this->model::create([
                'draw_identifier' => $drawIdentifier,
                'drawn_at' => $draw_at
            ]);

            return $resultCreateModel;

    }

    public function findById(string $lotteryDrawingHeldId): ?LotteryDrawingHeld
    {
        try {
            $resultQuery = $this->model::find($lotteryDrawingHeldId);

            return $resultQuery;
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function findByDrawIdentifier(string $drawIdentifier): ?LotteryDrawingHeld
    {
        try {
            $resultQuery = $this->model::where('draw_identifier',$drawIdentifier)
                ->with('numberDraw')
                ->first();

            return $resultQuery;
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function updateDrawHeld(string $lotteryDrawingHeldId, bool $isDraw): ?LotteryDrawingHeld
    {
        try {
            $resultFind = $this->findById($lotteryDrawingHeldId);

            if(!$resultFind){
                return null;
            }

            $resultFind->is_drawn = $isDraw;

            return $resultFind->save() ? $resultFind : null;

        } catch (\Throwable $th) {
            return null;
        }
    }

    public function indexLastDraw(): ?LotteryDrawingHeld
    {
        try {
            $resultQueryLotteryDrawingHeld = $this->model::orderBy('drawn_at','asc')->first();

            return $resultQueryLotteryDrawingHeld;
        } catch (\Throwable $th) {
            return null;
        }
    }
}
