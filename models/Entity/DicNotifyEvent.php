<?php namespace app\models\Entity;

use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * Class DicNotifyEvent
 * @package app\models\Entity
 */
class DicNotifyEvent extends ActiveRecord
{
    const EVENT_EMAIL = 1;
    const EVENT_PASSW = 2;
    const EVENT_ADD_NEWS = 3;

    public static function tableName()
    {
        return '{{%dic_notify_event}}';
    }

    public static function get($id)
    {
        return self::findOne(['id' => $id]);
    }

    public static function all()
    {
        return self::find()->all();
    }

    public static function getDic()
    {
        return ArrayHelper::map(self::all(),"id","name");
    }
}

