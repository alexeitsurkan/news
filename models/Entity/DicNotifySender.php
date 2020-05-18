<?php namespace app\models\Entity;

use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * Class DicNotifySender
 * @package app\models\Entity
 * @property $id
 * @property $name
 * @property $class
 */
class DicNotifySender extends ActiveRecord
{
    const EMAIL    = 1;
    const TELEGRAM = 2;

    public static function tableName()
    {
        return '{{%dic_notify_sender}}';
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


