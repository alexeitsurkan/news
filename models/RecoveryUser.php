<?php namespace app\models;

use app\models\Entity\User;
use Yii;
use yii\base\Model;

class RecoveryUser extends Model
{
    public $email;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['email', 'trim'],
            ['email', 'required', 'message' => 'Заполните поле E-mail'],
            ['email', 'email'],
            ['email', 'string', 'max' => 100],
            ['email', 'validEmail'],
        ];
    }
    public function validEmail($attribute, $params)
    {
        $user = User::findByEmail($this->$attribute);
        if(empty($user)){
            $this->addError($attribute, 'Такой E-mail адрес не зарегистрирован в системе');
        }

    }

    /**
     * восстановление пароля
     * @return bool
     */
    public function recovery()
    {
        $result = false;
        $transaction = \Yii::$app->getDb()->beginTransaction();
        try{
            $user = User::findByEmail($this->email);
            $pass = Yii::$app->security->generateRandomString(8);
            $user->setPassword($pass);
            $user->save();

            $this->sendEmail($pass);
        }catch (\Exception $e){
            $transaction->rollBack();
            return false;
        }
        $transaction->commit();
        return true;
    }

    protected function sendEmail($pass)
    {
        return Yii::$app
            ->mailer->compose()
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
            ->setTo($this->email)
            ->setSubject('Восстановление пароля' . Yii::$app->name)
            ->setHtmlBody("Новый пароль: <b>".$pass."</b>")
            ->send();
    }
}
