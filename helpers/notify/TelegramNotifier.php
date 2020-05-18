<?php namespace app\helpers\notify;

use app\helpers\notify\products\TelegramNotify;

/**
 * Class TelegramNotifier
 * @package app\helpers\notify
 */
class TelegramNotifier extends Notifier
{
    private $user_id;
    public function __construct($user_id)
    {
        $this->user_id = $user_id;
    }

    public function getNotifier()
    {
        return new TelegramNotify($this->user_id);
    }
}