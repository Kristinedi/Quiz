<?php


namespace Quiz\Repositories;


use phpseclib\Crypt\Base;
use Quiz\Models\UserAnswerModel;

class UserAnswerRepository extends BaseRepository
{
    protected function getModelClass()
    {
        return UserAnswerModel::class;
    }
}