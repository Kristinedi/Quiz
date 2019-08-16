<?php


namespace Quiz\Models;

/**
 * @property int $id
 * @property string $text
 * @property bool $is_correct
 * @property int $questions_id
 *
 * @property UserAnswerModel $user_answers
 * @property QuestionModel[] $questions
 */

class AnswerModel extends BaseModel
{
    /**
     * @var string $table
     */
    public $table = 'answers';

    /**
     * @var array
     */
    protected $fillable = ['text', 'is_correct', 'question_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function question()
    {
        return $this->belongsTo(QuestionModel::class, 'question_id', 'id');
    }

    public function userAnswer()
    {
        return $this->hasOne(QuizModel::class, 'answer_id', 'id');
        //has many
    }
}
