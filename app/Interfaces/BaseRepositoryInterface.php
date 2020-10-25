<?php


namespace App\Interfaces;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface
{
    /** @return string */
    public function getModelClass(): string;

    /** @return Model */
    public function getModel(): Model;

    /**
     * @return Collection|static[]
     */
    public function getAll();

    /**
     * @param  int  $id
     * @return Model|Collection|static[]|static|null
     */
    public function getById(int $id);
}