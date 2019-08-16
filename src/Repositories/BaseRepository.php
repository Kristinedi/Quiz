<?php


namespace Quiz\Repositories;


use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    /**
     * @return string
     */
    protected abstract function getModelClass();

    /**
     * @param array $conditions
     * @return Model|null
     */
   public function one(array $conditions = []): ?Model
    {
        /** @var Model $className */
        $className = $this->getModelClass();

        $model = $className::query()->where($conditions)->first();

        return $model;
    }

    /**
     * @param array $conditions
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all(array $conditions = [])
    {
        /** @var Model $className */
        $className = $this->getModelClass();

        $models = $className::query()->where($conditions)->get();

        return $models;
    }

    /**
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model
    {
        /**
         * @var Model $className
         */
        $className = $this->getModelClass();

        /**
         * @var Model $model
         */
        $model = new $className();
        $model->fill($data);
        $model->save();

        return $model;
    }

    /**
     * @param array $conditions
     * @return bool
     */
    public function exists(array $conditions = [])
    {
        /** @var Model $className */
        $className = $this->getModelClass();

        $rowExists = $className::query()->where($conditions)->exists();

        return $rowExists;
    }

    /**
     * @param array $conditions
     * @return int
     */
    public function count(array $conditions = [])
    {
        /** @var Model $className */
        $className = $this->getModelClass();

        $count = $className::query()->where($conditions)->count();

        return $count;
    }
}