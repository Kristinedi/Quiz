<?php


namespace Quiz\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 *
 * @property AttemptModel[] $attempts
 */

class UserModel extends BaseModel
{
    /**
     * @var string $table
     */
    public $table = 'users';

    /**
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * @return HasMany
     */
    public function attempts()
    {
        return $this->hasMany(AttemptModel::class, 'user_id', 'id');
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = password_hash($value, PASSWORD_DEFAULT);
    }
}


