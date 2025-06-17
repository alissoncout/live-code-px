<?php

namespace App\Repositories;

use App\Models\Post;

class PostRepository extends DefaultRepository
{
    public function __construct(Post $model)
    {
        parent::__construct($model);
    }

    public function getByUserId($data)
    {
        return $this->model->where('user_id', $data['user_id'])->paginate($data['per_page']);
    }
}
