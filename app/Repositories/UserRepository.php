<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends DefaultRepository
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function getByEmail(string $email)
    {
        return $this->model->where('email', $email)->first();
    }
}
