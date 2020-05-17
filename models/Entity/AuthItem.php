<?php

namespace app\models\Entity;

use yii\db\ActiveRecord;
use yii\db\Query;

/**
 * Class AuthItem
 * @package app\models\Entity
 */
class AuthItem extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%auth_item}}';
    }
}

