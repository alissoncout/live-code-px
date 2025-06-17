<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{

    private $service;

    public function __construct(PostService $service)
    {
        $this->service = $service;
    }
    
    public function index(Request $request)
    {
        return $this->httpResponse($this->service->index($request->input()));
    }

    public function store(PostRequest $request)
    {
        return $this->httpResponse($this->service->store($request->input()));
    }

    public function show($id)
    {
        return $this->httpResponse($this->service->show($id));
    }

    public function update(PostRequest $request, $id)
    {
       return $this->httpResponse($this->service->update($request->input(), $id));
    }

    public function destroy($id)
    {
        return $this->httpResponse($this->service->destroy($id));
    }
}
