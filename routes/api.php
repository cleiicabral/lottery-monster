<?php

use App\Http\Controllers\Api\LotteryDrawTestController;
use App\Http\Controllers\Api\LotteryTicket\CheckLotteryTicketResultController;
use App\Http\Controllers\Api\LotteryTicket\CreateLotteryTicketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/create-ticket',[CreateLotteryTicketController::class,'createLotteryTicket']);
Route::get('/ticket/{ticketCode}',[CheckLotteryTicketResultController::class,'checkResultLottery']);

