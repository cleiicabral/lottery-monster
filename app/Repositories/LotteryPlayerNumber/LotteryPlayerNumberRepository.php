<?php

namespace App\Repositories\LotteryPlayerNumber;

use App\Http\Dtos\LotteryPlayerNumber\CreateLotteryPlayerNumberDto;
use App\Models\LotteryPlayerNumber;
use App\Repositories\Interfaces\LotteryPlayerNumber\LotteryPlayerNumberRepositoryInterface;

class LotteryPlayerNumberRepository implements LotteryPlayerNumberRepositoryInterface
{

    private LotteryPlayerNumber $model;

    public function __construct(LotteryPlayerNumber $model)
    {
        $this->model = $model;
    }

    public function create(CreateLotteryPlayerNumberDto $lotteryPlayerNumberDto): ?LotteryPlayerNumber
    {
        try {
            $result = $this->model::create($lotteryPlayerNumberDto->toArray());

            return $result;
        } catch (\Throwable $th) {
            return null;
        }
    }
}
