<?php

namespace app\models;

use app\models\Entity\User;
use Yii;
use yii\base\Model;

/**
 * Class LoginForm
 * @package backend\modules\base\models
 */
class LoginUser extends Model
{
    public $username;
    public $password;

    private $_user;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'string', 'max' => 255],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Проверка пароля на валидность
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Некорректный E-mail или пароль');
            }
        }
    }

    /**
     * Логирует пользователя в сис по логину и паролю
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            $user = $this->getUser();
            return Yii::$app->user->login($user, 60 * 60);
        }

        return false;
    }

    /**
     * Поиск пользователя по [[username]]
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByUserName($this->username);
        }
        return $this->_user;
    }
}
