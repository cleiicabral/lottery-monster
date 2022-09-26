<?php

namespace App\Repositories\Interfaces\LotteryPlayerNumber;

use App\Http\Dtos\LotteryPlayerNumber\CreateLotteryPlayerNumberDto;
use App\Models\LotteryPlayerNumber;

interface LotteryPlayerNumberRepositoryInterface
{
    public function create(CreateLotteryPlayerNumberDto $lotteryPlayerNumberDto): ?LotteryPlayerNumber;
}
