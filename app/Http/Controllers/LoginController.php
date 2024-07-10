<?php

namespace App\Http\Controllers;

use App\Services\LoginService;
use Illuminate\Http\Request;

use App\Http\Requests\LoginFormRequest;

class LoginController extends Controller
{
    private $loginService;
    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }
    public function doLogin(LoginFormRequest $request)
    {
        $responseLogin = $this->loginService->doLogin($request->validated());

        return response()->json( $responseLogin
            , $responseLogin['status'] == 'success' ? 200 : 400);
    }

}
