<?php namespace app\components;

use app\models\Entity\DicNotifyEvent;
use app\models\Entity\DicNotifySender;
use app\models\Entity\Profile;
use app\models\Events\UserNotifyEvents;
use yii\base\Component;
use yii\helpers\Url;
use app\models\Entity\User;

class Notifier extends Component
{
    /**
     * отправка по событию
     * @param UserNotifyEvents $event
     */
    public function sendNotify(UserNotifyEvents $event)
    {
        $user_id = $event->user_id;
        if ($user_id) {
            $this->sendNotifyForOne($user_id,$event->title,$event->body,Url::toRoute(['/']),$event->name);
        }else {
            $users = User::all();
            foreach ($users as $user) {
                $this->sendNotifyForOne($user['id'],$event->title,$event->body,Url::toRoute(['/']),$event->name);
            }
        }
    }

    /**
     * отправка конкретному пользователю
     * @param $user_id
     * @param $title
     * @param $body
     * @param $click_action
     * @param null $event_name
     */
    public function sendNotifyForOne($user_id, $title, $body, $click_action,$event_name = null)
    {
        $profile = Profile::get($user_id);
        $notify_settings = \GuzzleHttp\json_decode($profile->notify_settings,true);
        foreach ($notify_settings['notify_sender'] as $sender_id){
            $el_sender = DicNotifySender::get($sender_id);
            if($el_sender){
                if(empty($event_name)){
                    $this->send($el_sender->class,$user_id, $title, $body, $click_action);
                }else{
                    foreach ($notify_settings['notify_event'] as $event_id){
                        $el_event = DicNotifyEvent::get($event_id);
                        if($el_event['event'] == $event_name){
                            $this->send($el_sender->class,$user_id, $title, $body, $click_action);
                        }
                    }
                }
            }
        }
    }

    /**
     * отправка уведомления
     * @param $class_name
     * @param $user_id
     * @param $title
     * @param $body
     * @param $click_action
     */
    protected function send($class_name,$user_id, $title, $body, $click_action)
    {
        /** @var \app\helpers\notify\Notifier $Notifier */
        $Notifier = new $class_name($user_id);
        $Notifier->send($title,$body,$click_action);
    }
}
