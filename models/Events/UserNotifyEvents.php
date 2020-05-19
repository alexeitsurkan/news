<?php namespace app\models\Events;

use yii\base\Event;

class UserNotifyEvents extends Event
{
    public $user_id;
    public $title;
    public $body;
}