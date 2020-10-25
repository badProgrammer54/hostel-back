<?php


namespace App\Repositories;


use App\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Application;


/** @package App\Repositories */
abstract class BaseRepository implements BaseRepositoryInterface
{
    /** @var Model */
    protected $model;

    public function __construct()
    {
        $this->model = app($this->getModelClass());
    }

    public function getModel(): Model
    {
        return $this->model;
    }

    /** @return string */
    abstract public function getModelClass(): string;

    /** @return Model|Application|mixed */
    protected function startConditions()
    {
        return clone $this->model;
    }

    /**
     * @return Collection|static[]
     */
    public function getAll()
    {
        return $this->startConditions()->all();
    }

    /**
     * @param  int  $id
     * @return Model|Collection|static[]|static|null
     */
    public function getById(int $id)
    {
        return $this->startConditions()->find($id);
    }
}