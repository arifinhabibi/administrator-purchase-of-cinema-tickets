<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Purchase;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransactionHistoryController extends Controller
{
    // param = token

    public function transactionHistory(Request $request){
        $user = User::where('login_tokens', $request->token)->first();

        if ($user) {
            # code...
            $dataPurchase = Purchase::with('movie', 'seat', 'created_by')->get();

            return response()->json([
                'purchase' => $dataPurchase
            ], 200);
        } else {
            return response()->json([
                'message' => 'Unathorized user'
            ], 401);
        }
    }


    // param = id(purchase)

    // delete transaction history
    public function deleteTransactionHistory(Request $request){
        $user = User::where('login_tokens', $request->token)->first();

        if ($user) {
            # code...
            $purchase = Purchase::where('id', $request->id)->first();
            $purchase->delete();

            return response()->json([
                'message' => 'transaction history successfully deleted'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Unathorized user'
            ], 401);
        }
    }
}
