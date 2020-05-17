<?php namespace app\models;

use phpDocumentor\Reflection\Types\Integer;
use yii\base\Model;
use yii\db\Query;

class ShowNews extends Model
{
    public function GetQueryNews()
    {
        $query = new Query();
        $query->select([
            'news.id AS id',
            'news.title AS title',
            'news.description AS description',
            'news.body AS body',
            'image.image AS image',
            'date_format(news.updated_at,\'%d.%m.%Y %H:%i\') AS date',
            "CONCAT(p.last_name, ' ', p.first_name) AS user",
        ])
            ->from([
                'news'
            ])
            ->join('LEFT JOIN', 'image', 'image.id = news.image_id')
            ->join('LEFT JOIN', 'profile p', 'p.user_id = news.user_id');
        return $query;
    }

    public function GetMyNews()
    {
        $query = new Query();
        $query->select([
            'news.id AS id',
            'news.title AS title',
            'news.description AS description',
            'news.body AS body',
            'image.image AS image',
            'date_format(news.updated_at,\'%d.%m.%Y %H:%i\') AS date',
            "CONCAT(p.last_name, ' ', p.first_name) AS user",
        ])
            ->from([
                'news'
            ])
            ->join('LEFT JOIN', 'image', 'image.id = news.image_id')
            ->join('LEFT JOIN', 'profile p', 'p.user_id = news.user_id')
            ->andFilterWhere(['=', 'p.user_id', \Yii::$app->user->getId()]);
        return $query;
    }

    public function ShowOneNews($id)
    {
        $query = new Query();
        $data =  $query->select([
            'news.id AS id',
            'news.title AS title',
            'news.description AS description',
            'news.body AS body',
            'image.image AS image',
            'date_format(news.updated_at,\'%d.%m.%Y %H:%i\') AS date',
            "CONCAT(p.last_name, ' ', p.first_name) AS user",
            ])
            ->from([
                'news'
            ])
            ->join('LEFT JOIN', 'image', 'image.id = news.image_id')
            ->join('LEFT JOIN', 'profile p', 'p.user_id = news.user_id')
            ->andFilterWhere(['=', 'news.id', $id])
            ->one();
        return $data;
    }
}
