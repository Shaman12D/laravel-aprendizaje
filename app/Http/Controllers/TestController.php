<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class TestController extends Controller
{
    function test()
    {
        $user = User::find(1);

        return view('welcome', ['user'=>$user]);// envia información del modelo hasta la vista
    }
}
