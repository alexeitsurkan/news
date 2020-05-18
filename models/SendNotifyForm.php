<?php namespace app\models;

use app\helpers\file\FileHelpers;
use app\helpers\notify\Notifier;
use app\models\Entity\DicNotifySender;
use app\models\Entity\Profile;
use yii\base\Model;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

class SendNotifyForm extends Model
{

    public $title;
    public $body;
    public $click_action;
    public $users = [];

    public function rules()
    {
        return [
            ['title', 'string'],
            ['body', 'string'],
            ['click_action', 'string'],
            ['users','each', 'rule' => ['integer']],
        ];
    }

    public function sendNotify()
    {
        try{
            if ($this->validate()) {
                foreach ($this->users as $user_id){
                    $profile = Profile::get($user_id);
                    $notify_settings = $profile->notify_settings;
                    foreach ($notify_settings['notify_sender'] as $sender_id){
                        $el_sender = DicNotifySender::get($sender_id);
                        if($el_sender){
                            /** @var Notifier $Notifier */
                            $class = $el_sender->class;
                            $Notifier = new $class($user_id);
                            $Notifier->send($this->title,$this->body,$this->click_action);
                        }
                    }
                }
            }
        }catch (\Exception $e){
            return false;
        }

    }

    public static function DicUser()
    {
        $query = new Query();
        $data = $query->select([
            'user.id AS id',
            "CONCAT(p.last_name, ' ', p.first_name) AS name",
        ])
            ->from(['user'])
            ->join('LEFT JOIN', 'profile p', 'p.user_id = user.id')
            ->all();
        return ArrayHelper::map($data,"id","name");
    }
}
