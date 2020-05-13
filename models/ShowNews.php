<?php namespace app\models;

use api\return_data\ReturnData;
use app\models\Entity\News;
use yii\base\Model;
use yii\db\Query;

class ShowNews extends Model
{
    public $id;
    public $count = 10;
    public $option = [10, 25, 50, 100];

    public function rules()
    {
        return [
        ];
    }

    public function GetQueryNews()
    {
        $query = new Query();
        $query->select([
            'news.id AS id',
            'news.title AS title',
            'news.body AS body',
            ])
            ->from([
                'news'
            ]);
        return $query;
    }
}
