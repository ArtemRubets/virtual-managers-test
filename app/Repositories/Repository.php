<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class Repository
{
    protected $model;

    public function __construct()
    {
        $this->model = app()->make($this->getModel());
    }

    abstract protected function getModel() : string;

    protected function startCondition() : Model
    {
        return clone $this->model;
    }
}
