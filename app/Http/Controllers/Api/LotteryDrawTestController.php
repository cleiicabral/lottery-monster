<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\LotteryDraw\LotteryDrawService;

class LotteryDrawTestController extends Controller
{
    public function test(LotteryDrawService $service)
    {
        try {

            return $service->execute('1ed3d405-f880-6bf0-839f-8cb0e9318bed');
        } catch (\Throwable $th) {

            return response()->json(["error" => $th->getMessage()], 400);

          }
    }
}
