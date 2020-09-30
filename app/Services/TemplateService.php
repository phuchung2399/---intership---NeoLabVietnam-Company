<?php

namespace App\Services;

class TemplateService
{
    /**
     * @var $modelRepository
     */
    protected $modelRepository;

    /**
     * ModelService constructor.
     * 
     * @param ModelRepository $modelRepository
     */
    public function __construct(ModelRepository $modelRepository) {
        $this->modelRepository = $modelRepository;
    }
}