<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Movie;

use App\Models\Purchase;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\ResponseJSON;

class DetailTransactionController extends Controller
{
    public function detailTransaction(Request $request){
        // param = id(purchase)
        $user = User::where('login_tokens', $request->token)->first();

        if (!$user) {
            return ResponseJSON::unauthorized("Unauthorize user");
        }

        $purchase = Purchase::find($request->id);
        $movie = Movie::where('id', $purchase->movie_id)->first();

        $change_money = $purchase->cash - $purchase->total;
        
        return response()->json([
            'id' => $purchase->id,
            'film_name' => $movie->name,
            'time' => $purchase->time,
            'seat' => $purchase->seat,
            'studio_name' => $movie->studio_name,
            'total' => number_format($purchase->total) ,
            'cash' => number_format($purchase->cash) ,
            'change_money' => number_format($change_money) 
        ], 200);
    }
}
