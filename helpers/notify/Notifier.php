<?php namespace app\helpers\notify;

/**
 * Class Notifier
 * @package app\helpers\notify
 */
abstract class Notifier
{
    //возвращает обьект уведомителя
    abstract public function getNotifier();

    /**
     * отправляет оповещение пользователю
     * @param $title   - тема сообщения
     * @param $message - текст сообщения
     * @param $click_action - обратная ссылка
     * @return bool
     */
    public function send($title, $message, $click_action)
    {
        $Notifier = $this->getNotifier();
        if($Notifier->sendNotify($title, $message, $click_action))return true;
        else return false;
    }
}