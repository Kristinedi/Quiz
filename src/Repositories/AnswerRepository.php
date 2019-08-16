<?php


namespace Quiz\Repositories;


use Quiz\Models\AnswerModel;

/**
 * @method AnswerModel |null one($conditions = [])
 * @method AnswerModel[] all(array $conditions = [])
 * @method AnswerModel create(array $data): Model
 */
class AnswerRepository extends BaseRepository
{
    protected function getModelClass()
    {
        return AnswerModel::class;
    }
}