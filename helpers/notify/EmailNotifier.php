<?php namespace app\helpers\notify;

use app\helpers\notify\products\EmailNotify;

/**
 * Class EmailNotifier
 * @package app\helpers\notify
 */
class EmailNotifier extends Notifier
{
    private $user_id;
    public function __construct($user_id)
    {
        $this->user_id = $user_id;
    }

    public function getNotifier()
    {
        return new EmailNotify($this->user_id);
    }
}