<?php namespace app\models\Entity;

use yii\db\ActiveRecord;

/**
 * Class Profile
 * @property integer $id
 * @property integer $user_id
 * @property string  $first_name
 * @property string  $last_name
 * @property string  $middle_name
 * @property null    $photo
 */
class Profile extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%profile}}';
    }

    public static function GetList()
    {
        return self::find()->all();
    }

    public static function GetProfile($user_id)
    {
        return self::findOne(['user_id' => $user_id]);
    }
}

