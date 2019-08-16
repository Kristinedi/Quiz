<?php


namespace Quiz;


use Quiz\Models\UserModel;

class ActiveUser
{
    public static function isLoggedIn(): bool
    {
        return !is_null(Session::getInstance()->getLoggedInUser());
    }

    public static function getLoggedInUser(): ?UserModel
    {
        $userId = Session::getInstance()->getLoggedInUser();

        if(!$userId){
            return null;
        }

        /**
         * @var UserModel $user
         */
        $user = UserModel::query()->where(['id' => $userId])->first();

        return $user;
    }
}
