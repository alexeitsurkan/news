<?php namespace app\helpers\notify\products;

use app\models\Entity\TelegramNotifyData;
use GuzzleHttp\Client;
use Yii;

/**
 * Class TelegramNotify
 * @package app\helpers\notify\products
 */
class TelegramNotify implements NotifyInterface
{
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
        $response = $client->get(Yii::$app->params['telegram_url'] . Yii::$app->params['telegram_token'] . '/sendMessage', [
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