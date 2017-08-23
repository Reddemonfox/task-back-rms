<?php

namespace App\Http\Controllers;

use App\Constants\HttpConstant;
use App\Exceptions\AppException;
use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;


class AuthenticateController extends Controller
{

    public function __construct()
    {
        $this->middleware('jwt.auth', ['except' => 'authenticate']);

    }

    public function authenticate(Request $request)
    {
    }
}
