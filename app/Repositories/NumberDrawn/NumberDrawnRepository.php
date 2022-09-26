<?php

namespace App\Repositories\NumberDrawn;

use App\Models\NumberDrawn;
use App\Repositories\Interfaces\NumberDrawn\NumberDrawnRepositoryInterface;

class NumberDrawnRepository implements NumberDrawnRepositoryInterface
{
    private NumberDrawn $model;

    public function __construct(NumberDrawn $model)
    {
        $this->model = $model;
    }

    public function create(string $lotteryDrawingHeldId, int $numberDraw): ?NumberDrawn
    {
        try {
            $resultCreateModel = $this->model::create([
                'lottery_drawing_held_id' => $lotteryDrawingHeldId,
                'number_drawn' => $numberDraw
            ]);

            return $resultCreateModel;
        } catch (\Throwable $th) {
            return null;
        }
    }
}
