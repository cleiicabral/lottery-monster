<?php

namespace App\Repositories\LotteryPlayer;

use App\Models\LotteryPlayer;
use App\Repositories\Interfaces\LotteryPlayer\LotteryPlayerRepositoryInterface;

class LotteryPlayerRepository implements LotteryPlayerRepositoryInterface
{
    private LotteryPlayer $model;

    public function __construct(LotteryPlayer $model)
    {
        $this->model = $model;
    }

    public function create(string $fullname): ?LotteryPlayer
    {
        try {

            $result = $this->model::create($fullname);

            return $result;
        } catch (\Throwable $th) {
            return null;
        }
    }
}
