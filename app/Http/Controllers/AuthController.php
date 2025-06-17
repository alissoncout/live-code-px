<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private $service;

    public function __construct(AuthService $service)
    {
        $this->service = $service;
    }

    public function register(AuthRequest $request)
    {
        $data = $this->service->register($request);
        return $this->httpResponse($data);
    }

    public function login(AuthRequest $request)
    {
        $data = $this->service->login($request);
        return $this->httpResponse($data);
    }

    public function validateToken(Request $request)
    {
        return $this->httpResponse($this->service->validateToken($request));
    }

    public function logout(Request $request)
    {
        return $this->httpResponse($this->service->logout($request));
    }

    public function me(Request $request)
    {
        return $this->httpResponse($this->service->me($request));
    }
}