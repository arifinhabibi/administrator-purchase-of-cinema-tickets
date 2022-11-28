<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Movie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MovieController extends Controller
{
    public function listMovie(Request $request){
        $user = User::where('login_tokens', $request->token)->first();

        if ($user) {
            # code...
            $data = Movie::with('genre')->get();
            return response()->json($data, 200);
        } else {
            return response()->json([
                'message' => 'Unauthorized user'
            ], 401);
        }
    }
}
  