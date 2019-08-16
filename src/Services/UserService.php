<?php


namespace Quiz\Services;

use Quiz\Models\UserModel;
use Exception;
use Quiz\Repositories\UserRepository;
use Quiz\Session;

class UserService
{
    private $repository;

    public function __construct(?UserRepository $repository = null)
    {
        $this->repository = new UserRepository();
    }

    /**
     * @param array $data
     * @return UserModel
     * @throws Exception
     */
    public function registerUser(array $data): UserModel
    {
        if ($this->repository->userExists(['email' => $data['email']])) {
            throw new \Exception('User already registered');
        }

        return $this->repository->create($data);
    }

    /**
     * @param array $data
     * @throws Exception
     */
    public function attemptLogin(array $data)
    {
        $user = $this->repository->one(['email' => $data['email']]);

        $userExist = (bool)$user;
        $isPasswordCorrect = password_verify($data['password'], $user->password ?? '');

        if(!$userExist || !$isPasswordCorrect) {
            throw new \Exception('Could not log you in. Try again!');
        }

        $this->login($user);
    }

    protected function login(UserModel $user)
    {
        Session::getInstance()->setLoggedInUser($user);
    }
}
