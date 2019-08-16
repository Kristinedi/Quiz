<?php


namespace Quiz\Controllers;


use Illuminate\Support\Arr;
use Quiz\Services\QuizService;
use Quiz\Session;

class QuizController extends BaseController
{
    /**
     * @var QuizService $quizService
     */
    private $quizService;

    public function __construct()
    {
        $this->quizService = new QuizService();
        parent::__construct();
    }

    public function start()
    {
        // sleep(3);
        $userId = Session::getInstance()->getLoggedInUser();
        $quizId = Arr::get($_POST, 'quizId');

        try {
            $this->quizService->start($userId, $quizId);
            $question = $this->quizService->getNextQuestion();



            $questionData = $this->quizService->getQuestionRpcData($question);

        } catch (\Exception $exception) {
            return json_encode([
                'error' => $exception->getMessage(),
            ]);
        }
        return json_encode([
                'questionData' =>$questionData,
        ]);
    }

    public function nextQuestion()
    {
        $answerId = Arr::get($_POST, 'answerId');

        try {
            $this->quizService->saveAnswer($answerId);
            $question = $this->quizService->getNextQuestion();

            if(!$question) {
                $resultData = $this->quizService->getResultdata();

                return json_encode([
                    'resultData' => $resultData,
                ]);
            }

            $questionData = $this->quizService->getQuestionRpcData($question);

        } catch (\Exception $exception) {
            return json_encode([
                'error' => $exception->getMessage(),
            ]);
        }
        return json_encode([
            'questionData' =>$questionData,
        ]);
    }

    public function newQuiz()
    {
        return $this->view('newQuiz');
    }

    public function createTitle()
    {
        $quizTitle = Arr::get($_POST, 'quizTitle');

        try {
            $quiz = $this->quizService->createQuiz(['title' => $quizTitle]);

            $quizData = [
                'id' => $quiz->id,
                'title' => $quiz->title
            ];

        } catch (\Exception $exception) {
            return json_encode([
                'error' => $exception->getMessage(),
            ]);
        }
        return json_encode([
            'quizData' => $quizData,
        ]);
    }

    public function createQuestion()
    {
        $quizId = Arr::get($_POST, 'quizId');
        $questionText = Arr::get($_POST, 'questionText');

        try {
            $question = $this->quizService->createQuestion([
                'quiz_id' => $quizId,
                'text' => $questionText
            ]);
        } catch (\Exception $exception) {
            return json_encode([
                'error' => $exception->getMessage(),
            ]);
        }

        $answerTexts = Arr::get($_POST, 'answerText');
        $answerIsCorrects = Arr::get($_POST, 'isCorrect');

        for ($i = 0; $i < count($answerTexts); $i++) {
            try {
                $this->quizService->createAnswer([
                    'question_id' => $question->id,
                    'text' => $answerTexts[$i],
                    'is_correct' => $answerIsCorrects[$i] === "true" ? 1 : 0
                ]);
            } catch (\Exception $exception) {
                return json_encode([
                    'error' => $exception->getMessage(),
                ]);
            }
        }
    }
}
