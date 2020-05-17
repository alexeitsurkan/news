<?php namespace app\models\Entity;

use yii\db\ActiveRecord;

/**
 * Class News
 * @package app\models\Entity
 * @property integer $image_id
 * @property string  $title
 * @property string  $description
 * @property string  $body
 * @property integer $views
 * @property integer $likes
 * @property integer $user_id
 */
class News extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%news}}';
    }
}

