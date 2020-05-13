<?php namespace app\models\Entity;

use yii\db\ActiveRecord;

/**
 * Class Tag
 * @package app\models\Entity
 * @property $id
 * @property $name
 */
class Tag extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%dic_tag}}';
    }

    //поиск тегов по id
    public static function findTagById($id)
    {
        return static::findOne(['id' => $id]);
    }

    //поиск тегов по имени
    public static function findTagByName($name)
    {
        return static::findOne(['name' => $name]);
    }

    //справочник тегов
    public static function GetTagList()
    {
        return self::find()->all();
    }
    //запрос
    public static function GetQuery()
    {
        return self::find();
    }

    //возвращает список тегов по имени (не больше 10)
    public static function GetTagLikeName($name)
    {
        return self::find()
            ->andFilterWhere(['ilike', 'name', $name])
            ->offset(0)
            ->limit(10)
            ->all();
    }
}

