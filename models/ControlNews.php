<?php namespace app\models;

use api\return_data\ReturnData;
use app\models\Entity\News;
use yii\base\Model;

class ControlNews extends Model
{
    public $id;
    public $title;
    public $body;

    const CREATE = 'create';
    const UPDATE = 'update';
    const DELETE = 'delete';

    public function scenarios()
    {
        return [
            self::CREATE => [
                'title',
                'body',
            ],
            self::UPDATE => [
                'id',
                'title',
                'body',
            ],
            self::DELETE => [
                'id'
            ],
        ];
    }

    public function rules()
    {
        return [
            ['id', 'integer'],
            ['title', 'string'],
            ['body', 'string'],
        ];
    }

    public function create()
    {
        $record = new News();
        $record->title = $this->title;
        $record->body = $this->body;
        if($record->save()){
            return new ReturnData(true, \Yii::t('app','Новость успешно добавлена'));
        }
    }

    public function update()
    {
        $record = News::findOne($this->id);
        $record->title = $this->title;
        $record->body = $this->body;
        if($record->save()){
            return new ReturnData(true,\Yii::t('app','Новость успешно обновлена'));
        }
    }

    public function delete()
    {
        $record = News::findOne($this->id);
        if($record->delete()){
            return new ReturnData(true,\Yii::t('app','Новость успешно удалена'));
        }
    }
}
