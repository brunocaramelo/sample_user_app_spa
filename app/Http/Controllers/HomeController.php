<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\AuthService;

class HomeController extends Controller
{
    private $authService;
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function searchUsers(Request $filters)
    {
        return $this->authService->searchUsers($filters->all());
    }
}
