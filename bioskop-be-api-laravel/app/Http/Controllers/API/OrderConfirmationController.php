<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Purchase;
use App\Models\PurchaseTicket;

class OrderConfirmationController extends Controller
{
    // params = token, movie_id
    // body = total, cash, created_by, date, time
    // time format must between 10:00, 13:00, 16:00, 19:00

    public function orderConfirm(Request $request){
        $user = User::where('login_tokens', $request->token)->first();
        if ($user) {
            # code...
            $purchase = Purchase::create([
                'movie_id' => $request->movie_id,
                'date' => date('Y-m-d'),
                'time' => $request->time,
                'total' => $request->total,
                'cash' => $request->cash,
                'created_by' => $request->created_by
            ]);

            // PurchaseTicket::create();
            
            $seats = explode(',', $request->orders);

            foreach ($seats as $seat) {
                # code...
                PurchaseTicket::create([
                    'purchase_id' => $purchase->id,
                    'seat' => $seat
                ]);
            }

            return response()->json([
                'message' => 'pesanan berhasil dibuat',
                'id' => $purchase->id

            ], 200);

        } else {
            return response()->json([
                'message' => 'Unathorized user'
            ], 401);
        }
    }
}
