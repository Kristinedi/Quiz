<?php


namespace Quiz\Controllers;


use PhpMyAdmin\Config\Validator;
use Quiz\Repositories\UserRepository;
use Quiz\Services\UserService;
use Quiz\Session;

class AuthController extends BaseController
{
    public function register()
    {
        return $this->view('register');
    }

    public function registerPost()
    {
        $data = $this->input;

        if ($data['password'] !== $data['password_confirmation']) {
            Session::getInstance()->addError('Passwords do not match');
            redirect('register');
        }

        $userService = new UserService();
        try {
            $user = $userService->registerUser($data);
        }  catch (\Exception $exception) {
            Session::getInstance()->addError($exception->getMessage());
            redirect('register');
        }

        Session::getInstance()->addMessage('You have successfully registered');

        redirect();
    }

    public function login()
    {
        return $this->view('login');
    }

    public function loginPost()
    {
        $data = $this->input;
        $userService = new UserService();

        try {
            $userService->attemptLogin($data);
            redirect('/');
        }  catch (\Exception $exception) {
            Session::getInstance()->addError($exception->getMessage());
            redirect('login');
        }
    }

    public function logout()
    {
        Session::getInstance()->delete(Session::LOGGED_IN_USER);
        redirect();
    }
}
