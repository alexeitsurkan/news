<?php namespace app\helpers\notify\products;

use app\models\Entity\TelegramNotifyData;
use GuzzleHttp\Client;

/**
 * Class TelegramNotify
 * @package app\helpers\notify\products
 */
class TelegramNotify implements NotifyInterface
{
    const TOKEN = '1166705173:AAG9do6bC_L0yqFqcXSokQQWgqd70KVU2mk';
    const URL = 'https://api.telegram.org/bot';

    private $user_id;

    public function __construct($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * отправляет уведомление пользователю
     * @param $title - тема сообщения
     * @param $message - текст сообщения
     * @param $click_action - обратная ссылка
     * @return bool
     */
    public function sendNotify($title, $message, $click_action)
    {
        $client = new Client();
        $response = $client->get(self::URL . self::TOKEN . '/sendMessage', [
            'query' => [
                'text' => '<h1>' . $title . '<h1>' . $message,
                'chat_id' => $this->getChatId(),
                'parse_mode' => 'html',
            ]
        ]);
        if ($response->getStatusCode() == 200) return true;
        else return false;
    }

    protected function getChatId()
    {
        return TelegramNotifyData::getChatId($this->user_id);
    }
}