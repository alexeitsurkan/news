<?php namespace app\helpers\notify\products;

use app\models\Entity\User;
use Yii;

/**
 * Class EmailNotify
 * @package app\helpers\notify\products
 */
class EmailNotify implements NotifyInterface
{
    private $user_id;

    public function __construct($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * отправляет оповещение пользователю
     * @param $title - тема сообщения
     * @param $message - текст сообщения
     * @param $click_action - обратная ссылка
     * @return bool
     */
    public function sendNotify($title, $message, $click_action)
    {
        $user = User::findIdentity($this->user_id);
        return Yii::$app->mailer->compose()
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
            ->setTo($user->email)
            ->setSubject($title)
            ->setHtmlBody($message.'<br><br><a href="'.$click_action.'">'.$click_action.'</a>')
            ->send();
    }
}