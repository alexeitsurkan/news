<?php namespace app\models\Entity;

use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

/**
 * Class Profile
 * @property integer $id
 * @property integer $user_id
 * @property string  $first_name
 * @property string  $last_name
 * @property string  $middle_name
 * @property string  $avatar
 * @property Json    $notify_settings
 */
class Profile extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%profile}}';
    }

    public static function all()
    {
        return self::find()->all();
    }

    /**
     * @param $user_id integer
     * @return Profile|null
     */
    public static function get($user_id)
    {
        return self::findOne(['user_id' => $user_id]);
    }

    public static function NotifySettingsDefault()
    {
        return [
            'notify_sender'=>[DicNotifySender::EMAIL],
            'notify_event'=>[DicNotifyEvent::EVENT_PASSW],
        ];
    }
}

