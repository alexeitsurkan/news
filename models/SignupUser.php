<?php namespace app\models;

use app\models\Entity\Profile;
use app\models\Entity\User;
use Yii;

/**
 * Регистрация пользователя
 * Class SignupUser
 * @package app\models
 * @property $username;
 * @property $password;
 * @property $email;
 * @property $last_name;
 * @property $first_name;
 * @property $middle_name;
 */
class SignupUser extends UserModel
{
    public $username;
    public $password;
    public $email;
    public $last_name;
    public $first_name;
    public $middle_name;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required', 'message' => 'Логин не должен быть пустым'],
            ['username', 'string', 'min' => 4, 'max' => 50],

            ['password', 'trim'],
            ['password', 'required', 'message' => 'Пароль не должен быть пустым'],
            ['password', 'string', 'min' => 6, 'max' => 12],

            ['email', 'trim'],
            ['email', 'required', 'message' => 'Заполните поле E-mail'],
            ['email', 'email'],
            ['email', 'string', 'max' => 100],

            ['last_name', 'trim'],
            ['last_name', 'required', 'message' => 'Заполните поле фамилия'],
            ['last_name', 'match', 'pattern' => '/[а-яёa-z-]*/i'],
            ['last_name', 'string', 'length' => [3, 24]],

            ['first_name', 'trim'],
            ['first_name', 'required', 'message' => 'Заполните поле имя'],
            ['first_name', 'match', 'pattern' => '/[а-яёa-z-]*/i'],
            ['first_name', 'string', 'length' => [3, 24]],

            ['middle_name', 'trim'],
            ['middle_name', 'required', 'message' => 'Заполните поле отчество'],
            ['middle_name', 'match', 'pattern' => '/[а-яёa-z-]*/i'],
            ['middle_name', 'string', 'length' => [3, 24]],
        ];
    }

    /**
     * регистрируем пользователя в системе
     * @return bool|null
     * @throws \yii\base\Exception
     */
    public function SignUp()
    {
        if (!$this->validate()) return null;
        $transaction = \Yii::$app->getDb()->beginTransaction();
        try {
            //добавляем пользователя
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->generateEmailVerificationToken();
            $user->setPassword($this->password);
            $user->save();

            //добавляем профиль
            $profile = new Profile();
            $profile->user_id = $user->id;
            $profile->first_name = $this->first_name;
            $profile->last_name = $this->last_name;
            $profile->middle_name = $this->middle_name;
            $profile->notify_settings = Profile::NotifySettingsDefault();
            $profile->save();

            //добавление роли пользователю
            $auth = Yii::$app->authManager;
            $authorRole = $auth->getRole('moderator');
            $auth->assign($authorRole, $user->id);

            $this->sendEmail($user);

        } catch (\Exception $e) {
            $transaction->rollBack();
            return false;
        }
        $transaction->commit();
        return true;
    }

    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
            ->setTo($this->email)
            ->setSubject('Подтверждение регистрации' . Yii::$app->name)
            ->send();
    }
}
