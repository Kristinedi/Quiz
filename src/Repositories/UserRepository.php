<?php


namespace Quiz\Repositories;

use Quiz\Models\UserModel;

/**
 * @method UserModel |null one($conditions = [])
 * @method UserModel[] all(array $conditions = [])
 * @method UserModel create(array $data): Model
 */
class UserRepository extends BaseRepository
{
    protected function getModelClass()
    {
        return UserModel::class;
    }

    /**
     * @param array $conditions
     * @return bool
     */
    public function userExists(array $conditions): bool
    {
        return UserModel::query()->where($conditions)->exists();
    }
}