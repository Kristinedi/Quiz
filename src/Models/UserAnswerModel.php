<?php


namespace Quiz\Models;


use Illuminate\Database\Eloquent\Relations\BelongsTo;
use \Illuminate\Database\Eloquent\Relations\HasOne;


/**
 * @property int $id
 * @property int $attempt_id
 * @property int $question_id
 * @property int $answer_id
 *
 * @property AttemptModel $attempt
 * @property QuestionModel $question
 * @property AnswerModel $answer
 */

class UserAnswerModel extends BaseModel
{
    /**
     * @var string $table
     */
    public $table = 'user_answers';

    /** @var array  */
    public $guarded =[];

    /**
     * @return HasOne
     */
    public function attempt()
    {
        return $this->hasOne(AttemptModel::class, 'id', 'attempt_id');
    }

    /**
     * @return BelongsTo
     */
    public function question()
    {
        return $this->belongsTo(QuestionModel::class, 'question_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function answer()
    {
        return $this->belongsTo(AnswerModel::class, 'answer_id', 'id');
    }

    //or hasOne for all
}
