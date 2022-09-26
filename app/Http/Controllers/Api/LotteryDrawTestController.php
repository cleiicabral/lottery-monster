<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\LotteryDraw\LotteryDrawService;

class LotteryDrawTestController extends Controller
{
    public function test(LotteryDrawService $service)
    {
        try {

            return $service->execute('1ed3dde8-9910-6606-ac40-0242ac140005');
        } catch (\Throwable $th) {

            return response()->json(["error" => $th->getMessage()], 400);

          }
    }
}
