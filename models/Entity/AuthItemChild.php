<?php

namespace app\models\Entity;

use yii\db\ActiveRecord;

/**
 * Class AuthItemChild
 * @package app\models\Entity
 */
class AuthItemChild extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%auth_item_child}}';
    }

    //список всех записей
    public static function all()
    {
        return self::find()->all();
    }

    //список всех записей
    public static function GetChild($role)
    {
        return self::find()
            ->select(['child'])
            ->andFilterWhere(['parent' => $role])
            ->all();
    }
}

