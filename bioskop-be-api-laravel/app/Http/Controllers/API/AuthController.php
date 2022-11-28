<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Helpers\ResponseJSON;
use App\Http\Controllers\Controller;
// use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request){

        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required'
        ],
        [
            'password.required' => 'password harus di isi',
            'username.required' => 'username harus di isi'
        ]);

        if ($validator->fails()) {
            # code...
            return response()->json([
                'message' => 'Invalid field',
                'errors' => $validator->errors()
            ], 401);
        }

        $credentials = [
            'username' => $request->username,
            'password' => $request->password
        ];
        
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'username or password inccorect'
            ], 401);
        } 

        Auth::user()->update([
            'login_tokens' => bcrypt($request->username)
        ]);

        return response()->json([
            'message' => 'success login',
            'id' => Auth::user()->id,
            'username' => Auth::user()->username,
            'token' => Auth::user()->login_tokens
        ], 200);
    }

    public function logout(Request $request){

        $user = User::where('login_tokens', $request->token)->first();

        if ($user) {
            # code...
            $user->update([
                'login_tokens' => null
            ]);

            return response()->json([
                'message' => 'logout success'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Unauthorized user'
            ], 401);
        }
    }

    public function changePassword(Request $request){
        $user = User::where('login_tokens', $request->token)->first();
        if ($user) {
            # code...
            if ($request->new_password === $request->new_password_confirmation) {
                # code...
                $user->update([
                    'password' => bcrypt($request->new_password)
                ]);
                return response()->json([   
                    'message' => 'your password has been changed succesfully'
                ], 200);
            } else {
                return response()->json([
                    'message' => 'your new password confirmation is not equel'
                ], 401);
            }
        } else {
            return response()->json([
                'message' => 'Unauthorized user'
            ], 401);
        }
    }
}
