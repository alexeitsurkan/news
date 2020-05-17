<?php namespace app\models\Entity;

use yii\db\ActiveRecord;

/**
 * Class News
 * @package app\models\Entity
 * @property integer $id
 * @property string $image
 */
class Image extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%image}}';
    }
}

