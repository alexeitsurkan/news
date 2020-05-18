<?php namespace app\helpers\notify\products;

interface NotifyInterface
{
    /**
     * отправляет оповещение пользователю
     * @param $title   - тема сообщения
     * @param $message - текст сообщения
     * @param $click_action - обратная ссылка
     * @return bool
     */
    public function sendNotify($title, $message, $click_action);
}