<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\MovieController;
use App\Http\Controllers\API\SeatSelectionController;
use App\Http\Controllers\API\DetailTransactionController;
use App\Http\Controllers\API\OrderConfirmationController;
use App\Http\Controllers\API\TransactionHistoryController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });




// Authentication 
Route::POST('/auth/login', [AuthController::class, 'login']);
Route::GET('/auth/logout', [AuthController::class, 'logout']);
Route::POST('/auth/change-password', [AuthController::class, 'changePassword']);

// list movies
Route::GET('/list-movie', [MovieController::class, 'listMovie']);

// seat selection 
Route::GET('/seat-selection', [SeatSelectionController::class, 'seatSelection']);

// confirm order
Route::POST('/seat-selection/order-confirmation', [OrderConfirmationController::class, 'orderConfirm']);

// detail transaction
Route::GET('/detail-transaction', [DetailTransactionController::class, 'detailTransaction']);

// transaction history
Route::GET('/transaction-history', [TransactionHistoryController::class, 'transactionHistory']);

// delet transaction history
Route::GET('/transaction-history/delete', [TransactionHistoryController::class, 'deleteTransactionHistory']);