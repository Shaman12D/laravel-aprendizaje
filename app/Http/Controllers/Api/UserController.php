<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class UserController extends Controller
{
    public function login(Request $request){
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if(Auth::attempt($credentials)){
            $token = Auth::user()->createToken('myapptoken')->plainTextToken;
            session()->put('token', $token);
            return response()->json([
                'isLoggedIn' => true,
                'user' => auth()->user(),
                'token' => $token,
            ]);
        }
        return response()->json("Usuario y/o contraseña invalido", 422);
    }

    function checkToken() {
        //28|dYltlPW9pRMPf8i24WNk5A3b5S16SVKwreLZUUYg
        //266efa9702ab00674b5de046e99b1961009ac8816c4830f7007b9fe10d2c97d7
        $token = request('token');
        dd(hash('sha256', $token));
        $tokenModel = PersonalAccessToken::where('token', $token)->first();
        dd($tokenModel);
    }

    public function logout(){
        //$user->tokens()->where('id', $user->id)->delete();
        session()->flush();
        return response()->json("Cierre de session");
    }
}
