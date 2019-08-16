<?php


namespace Quiz\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $text
 * @property int $quiz_id
 *
 * @property QuizModel $quiz
 * @property AnswerModel[] $answers
 */

class QuestionModel extends BaseModel
{
    /**
     * @var string $table
     */
    public $table = 'questions';

    /**
     * @var array
     */
    protected $fillable = ['text', 'quiz_id'];

    /**
     * @return BelongsTo
     */
    public function quiz()
    {
        return $this->belongsTo(QuizModel::class, 'quiz_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function answers()
    {
        return $this->hasMany(AnswerModel::class, 'question_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function userAnswers()
    {
        return $this->hasMany(UserAnswerModel::class, 'question_id', 'id');
    }
}
