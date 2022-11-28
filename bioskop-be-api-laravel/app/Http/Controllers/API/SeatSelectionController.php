<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Movie;
use App\Models\Purchase;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SeatSelectionController extends Controller
{
    // params = token, time, id(movie)
    public function seatSelection(Request $request){
        
        $user = User::where('login_tokens', $request->token)->first();

        if ($user) {
            # code...
            $movie = Movie::find($request->id);

            $purchases = Purchase::where('movie_id', $movie->id)->with('seat')->get();


           
            
            // $purchaseSeatSolds = [];

            // $purchaseSeatSold = [];
            
            // if ($purchaseSeats != null) {
            //     # code...
            //     foreach($purchaseSeats as $purchaseSeat){
            //         # code...
                    
            //         $purchaseSeatSolds[] = $purchaseSeat->seat;
            //     }
            //     $total = count($purchaseSeatSolds);
            //     for ($i=0; $i < $total ; $i++) { 
            //         # code...
            //         $purchaseSeatSold[] = $purchaseSeatSolds[$i];
            //     }
            // }

            // $purchaseSeats = [];
            // $purchaseSeatSold = [];
            
            // if ($purchases != null) {
            //     # code...
            //     foreach($purchases as $purchase){
            //         $purchaseSeats[] = $purchase->seat;

            //     }
                // foreach($purchaseSeats as $purchaseSeat){
                //     $purchaseSeatSold[] = $purchaseSeat->seat; 
                // }
            // }

            return response()->json([
                'date' => date('d F'),
                'time_choose' => $request->time,
                'id' => $movie->id,
                'movie_name' => $movie->name,
                'studio_name' => $movie->studio_name,
                'studio_capacity' => $movie->studio_capacity,
                // 'purchases' => $purchases != null ? $purchases->time : null,
                // 'purchaseSeats' => $purchaseSeats != null ? $purchaseSeats : null,
                // 'seats_sold' => $purchaseSeatSold != null ? $purchaseSeatSold : null
            ], 200);
        } else {
            return response()->json([
                'message' => 'Unauthorized user'
            ], 401);
        }
    }   
}
