<?php

namespace app\models\Entity;

use yii\db\ActiveRecord;

class NewsToTag extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%news_to_tag}}';
    }

    public function rules()
    {
        return [];
    }

    //поиск записи по id
    public static function findById($id)
    {
        return static::findOne(['id' => $id]);
    }

    //получаем все записи где news_id
    public static function findRowsByNewsId($news_id)
    {
        return NewsToTag::find()
            ->where([
                'news_id' => $news_id,
            ])->all();
    }

    //получаем все записи где tag_id
    public static function findRowsByTagId($tag_id)
    {
        return NewsToTag::find()
            ->where([
                'tag_id' => $tag_id,
            ])->all();
    }

    //поиск записи по тегу и файлу
    public static function findNewsToTag($news_id, $tag_id)
    {
        return static::findOne([
            'news_id' => $news_id,
            'tag_id' => $tag_id,
        ]);
    }
}

