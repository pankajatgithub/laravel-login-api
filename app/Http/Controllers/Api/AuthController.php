<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(){
        return 'login requested';

    }
    public function signUp(){
        return 'signup requested';

    }
    public function getdata(){
        return 'getdata requested';
    }
}
