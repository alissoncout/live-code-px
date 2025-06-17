<?php

namespace App\Services;

use App\Http\Resources\PostResource;
use App\Repositories\PostRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class PostService
{
    protected $repository;

    public function __construct(PostRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index($data)
    {
        $posts = $this->repository->getByUserId($data);

        $postsFormatted = PostResource::collection($posts->getCollection());

        $paginatedData = new LengthAwarePaginator(
            $postsFormatted,
            $posts->total(),
            $posts->perPage(),
            $posts->currentPage(),
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );
        return array("data" => $paginatedData, "status" => true);
    }

    public function store($data)
    {
        $post = $this->repository->create($data);
        return array("data" => new PostResource($post), "status" => true);
    }

    public function show($id)
    {
        $post = $this->repository->getById($id);
        return array("data" => new PostResource($post), "status" => true);
    }

    public function update($data, $id)
    {
        $post = $this->repository->update($id, $data);
        return array("data" => new PostResource($post), "status" => true);
    }

    public function destroy($id)
    {
        $this->repository->delete($id);
        return array("data" => [], "status" => true);
    }
}