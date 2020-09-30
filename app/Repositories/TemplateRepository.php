<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class TemplateRepository
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * ModelRepository constructor.
     * 
     * @param Model $model
     */
    public function __construct(Model $model) {
        $this->model = $model;
    }
}
