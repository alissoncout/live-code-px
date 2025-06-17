<?php

namespace App\Repositories;

use App\Models\Avaliacao;

class AvaliacaoRepository extends DefaultRepository
{
    public function __construct(Avaliacao $model)
    {
        parent::__construct($model);
    }
}
