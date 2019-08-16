<?php


namespace Quiz\Services;


use Exception;
use Quiz\Exceptions\QuizException;
use Quiz\Models\AnswerModel;
use Quiz\Models\QuestionModel;
use Quiz\Models\QuizModel;
use Quiz\Repositories\AnswerRepository;
use Quiz\Repositories\AttemptRepository;
use Quiz\Repositories\QuestionRepository;
use Quiz\Repositories\QuizRepository;
use Quiz\Repositories\UserAnswerRepository;
use Quiz\Repositories\UserRepository;
use Quiz\Session;

class QuizService
{
    private const SESSION_KEY_CURRENT_ATTEMPT_ID = 'attemptQuizId';
    private const SESSION_KEY_QUESTIONS_ANSWERED = 'questionsAnswered';

    /** @var QuizRepository $repository */
    private $repository;

    /** @var QuestionRepository $questionRepository */
    private $questionRepository;

    /** @var AnswerRepository $answerRepository */
    private $answerRepository;

    /** @var UserRepository $userRepository */
    private $userRepository;

    /** @var  AttemptRepository $attemptRepository*/
    private $attemptRepository;

    /** @var UserAnswerRepository $userAnswerRepository */
    private $userAnswerRepository;

    /** @var Session $session */
    private $session;

    public function __construct(
        QuizRepository $repository = null,
        QuestionRepository $questionRepository = null,
        AnswerRepository $answerRepository = null,
        UserRepository $userRepository = null,
        AttemptRepository $attemptRepository = null,
        UserAnswerRepository $userAnswerRepository = null,
        Session $session = null
    ){
        $this->repository = $repository ?: new QuizRepository;
        $this->questionRepository = $questionRepository ?: new QuestionRepository;
        $this->answerRepository = $answerRepository ?: new AnswerRepository;
        $this->userRepository = $userRepository ?: new UserRepository;
        $this->attemptRepository = $attemptRepository ?: new AttemptRepository;
        $this->userAnswerRepository = $userAnswerRepository ?: new UserAnswerRepository;
        $this->session = $session ?: Session::getInstance();
    }

    /** @return array */
    public function getQuizRpcData()
    {
        $quizzes = $this->repository->all();

        $quizData = [];

        foreach ($quizzes as $quiz) {
            $questionCount = $this->questionRepository->count(['quiz_id' => $quiz->id]);

            $quizData[] = [
                'id' => $quiz->id,
                'title' => $quiz->title,
                'questionCount' => $questionCount,
            ];
        }
        return $quizData;
    }

    /**
     * @param int $userId
     * @param int $quizId
     * @return QuizModel
     * @throws QuizException
     */
    public function start(int $userId, int $quizId)
    {
        $userExists = $this->userRepository->userExists(['id' => $userId]);

        if (!$userExists) {
            throw new QuizException('Unknown user');
        }

        $quiz = $this->getQuizById($quizId);

        $attempt = $this->attemptRepository->create([
            'user_id' => $userId,
            'quiz_id' => $quizId,
        ]);

        $this->session->set(self::SESSION_KEY_CURRENT_ATTEMPT_ID, $attempt->id);
        $this->session->set(self::SESSION_KEY_QUESTIONS_ANSWERED, 0);

        return $quiz;
    }

    public function getNextQuestion()
    {
        $attemptId = $this->session->get(self::SESSION_KEY_CURRENT_ATTEMPT_ID);

        $attempt = $this->getAttemptById($attemptId);

        $questionsAnswered = $this->session->get(self::SESSION_KEY_QUESTIONS_ANSWERED, -1);

        if ($questionsAnswered < 0) {
            throw new QuizException('Questions answered not set');
        }

        $question = $this->questionRepository->getQuestionByQuizIdAndOffset($attempt->quiz_id, $questionsAnswered);


        return $question;
    }

    /**
     * @param QuestionModel $question
     * @return array
     */
    public function getQuestionRpcData(QuestionModel $question)
    {
        $answerData = [];

        foreach ($question->answers as $answer) {
            $answerData[] = $this->getAnswerRpcData($answer);
        }

        return [
            'id' => $question->id,
            'text' => $question->text,
            'answers' => $answerData,
        ];
    }

    /**
     * @param AnswerModel $answer
     * @return array
     */
    private function getAnswerRpcData(AnswerModel $answer)
    {
        return [
            'id' => $answer->id,
            'text' => $answer->text,
        ];
    }

    /**
     * @param int $quizId
     * @return QuizModel|null
     * @throws QuizException
     */
    public function getQuizById(int $quizId)
    {
        $quiz = $this->repository->one(['id' => $quizId]);

        if (!$quiz) {
            throw new QuizException('Could not find quiz #$quizId');
        }
        return $quiz;
    }

    public function saveAnswer($answerId)
    {
        $answer = $this->answerRepository->one(['id' => $answerId]);

        if(!$answer) {
            throw new QuizException("Answer #$answerId not found");
        }

        $currentAttemptId = $this->session->get(self::SESSION_KEY_CURRENT_ATTEMPT_ID);

        $attempt = $this->getAttemptById($currentAttemptId);

        $this->userAnswerRepository->create([
            'attempt_id' => $attempt->id,
            'question_id' => $answer->question_id,
            'answer_id' => $answer->id,
        ]);

        $questionsAnswered = $this->session->get(self::SESSION_KEY_QUESTIONS_ANSWERED);
        $questionsAnswered++;
        $this->session->set(self::SESSION_KEY_QUESTIONS_ANSWERED, $questionsAnswered);
    }

    /**
     * @return array
     */
    public function getResultData()
    {
        $currentAttemptId = $this->session->get(self::SESSION_KEY_CURRENT_ATTEMPT_ID);
        $attempt = $this->getAttemptById($currentAttemptId);

        $correctAnswerCount = 0;

        foreach ($attempt->userAnswers as $userAnswer) {
            $correctAnswerCount += $userAnswer->answer->is_correct;
        }

        $this->session->delete(self::SESSION_KEY_CURRENT_ATTEMPT_ID);
        $this->session->delete(self::SESSION_KEY_QUESTIONS_ANSWERED);

        return [
            'correctAnswerCount' => $correctAnswerCount,
        ];
    }

    /**
     * @param $attemptId
     * @return \Quiz\Models\AttemptModel|null
     * @throws QuizException
     */
    public function getAttemptById($attemptId)
    {
        $attempt = $this->attemptRepository->one(['id' => $attemptId]);

        if (!$attempt) {
            throw new QuizException('Quiz has not been started');
        }

        return $attempt;
    }

    /**
     * @param array $data
     * @return QuizModel
     * @throws Exception
     */
    public function createQuiz(array $data): QuizModel
    {
        if ($this->repository->quizExists(['title' => $data['title']])) {
            throw new \Exception('Quiz title already used');
        }

        return $this->repository->create($data);
    }

    /**
     * @param array $data
     * @return QuestionModel
     * @throws Exception
     */
    public function createQuestion(array $data): QuestionModel
    {
        return $this->questionRepository->create($data);
    }

    /**
     * @param array $data
     * @return AnswerModel
     * @throws Exception
     */
    public function createAnswer(array $data): AnswerModel
    {
        return $this->answerRepository->create($data);
    }

}
