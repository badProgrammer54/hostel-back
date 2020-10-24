<?php


namespace App\Interfaces;


use Exception;
use \Illuminate\Database\Eloquent\Collection;

interface BaseModelInterface
{
    /**
     * Save the model to the database.
     *
     * @param  array  $options
     * @return bool
     */
    public function save(array $options = []);

    /**
     * Update the model in the database.
     *
     * @param  array  $attributes
     * @param  array  $options
     * @return bool
     */
    public function update(array $attributes = [], array $options = []);

    /**
     * Delete the model from the database.
     *
     * @return bool|null
     *
     * @throws Exception
     */
    public function delete();

    /**
     * Get all of the models from the database.
     *
     * @param  array|mixed  $columns
     * @return Collection|static[]
     */
    public static function all($columns = ['*']);
}