<?php

namespace App\Http\Controllers;

use App\Http\Requests\AvaliacaoRequest;

use App\Services\AvaliacaoService;

class AvaliacaoController extends Controller
{

    private $service;

    public function __construct(AvaliacaoService $service)
    {
        $this->service = $service;
    }
    
    public function analise(AvaliacaoRequest $request)
    {
        return $this->httpResponse($this->service->analise($request->input()));
    }
}
