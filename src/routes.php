<?php

use Quiz\Controllers\AuthController;
use Quiz\Controllers\IndexController;
use Quiz\Route;
use Quiz\Controllers\QuizController;

return [
    '/' => new Route(IndexController::class),
    '/register' => new Route(AuthController::class, 'register'),
    '/registerPost' => new Route(AuthController::class, 'registerPost'),
    '/login' => new Route(AuthController::class, 'login'),
    '/loginPost' => new Route(AuthController::class, 'loginPost'),
    '/logout' => new Route(AuthController::class, 'logout'),
    '/quiz/start' => new Route(QuizController::class, 'start'),
    '/quiz/next-question' => new Route(QuizController::class, 'nextQuestion'),
    '/newQuiz' => new Route(QuizController::class, 'newQuiz'),
    '/addQuiz' => new Route(QuizController::class, 'addQuiz'),
    '/create-quiz/create-title' => new Route(QuizController::class, 'createTitle'),
    '/create-quiz/create-question' => new Route(QuizController::class, 'createQuestion'),
];
