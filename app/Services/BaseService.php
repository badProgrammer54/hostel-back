<?php


namespace App\Services;


use App\Interfaces\BaseRepositoryInterface;
use App\Models\Exceptions\ServiceException;
use Illuminate\Database\Eloquent\Model;

class BaseService
{
    /**
     * @param BaseRepositoryInterface $repository
     * @param int $id
     * @return Model
     * @throws ServiceException
     */
    public function getModalById(BaseRepositoryInterface $repository, int $id): Model
    {
        $model = $repository->getById($id);

        if (!($repository->getModel() instanceof $model)) {
            throw new ServiceException($repository->getModelClass() . ' with ' . $id . ' not found', 404);
        }

        return $model;
    }
}