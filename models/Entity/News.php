<?php namespace app\models\Entity;

use yii\db\ActiveRecord;

/**
 * Class News
 * @package app\models\Entity
 * @property string $title
 * @property string $body
 */
class News extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%news}}';
    }
}

