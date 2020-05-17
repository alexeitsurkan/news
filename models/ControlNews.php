<?php namespace app\models;

use app\helpers\file\FileHelpers;
use app\models\Entity\News;
use app\models\Entity\Image;
use yii\base\Model;
use yii\web\UploadedFile;

class ControlNews extends Model
{
    public $id;
    public $title;
    public $description;
    public $body;
    /** @var UploadedFile[] */
    public $files;

    const CREATE = 'create';
    const UPDATE = 'update';
    const DELETE = 'delete';

    public function scenarios()
    {
        return [
            self::CREATE => [
                'title',
                'description',
                'body',
            ],
            self::UPDATE => [
                'id',
                'title',
                'description',
                'body',
            ],
            self::DELETE => [
                'id'
            ],
        ];
    }

    public function rules()
    {
        $upload_max_filesize = ini_get('upload_max_filesize');
        $max_file_size = FileHelpers::ReturnBytes($upload_max_filesize);
        $max_files = ini_get('max_file_uploads');

        return [
            ['id', 'integer'],
            ['title', 'string'],
            ['description', 'string'],
            ['body', 'string'],
            ['files', 'file', 'extensions' => ['png', 'jpg'], 'maxFiles' => $max_files, 'maxSize' => $max_file_size],
        ];
    }

    //создание поста
    public function create()
    {
        if ($this->validate()) {
            $image_id = $this->SaveImage();

            $record = new News();
            $record->image_id = $image_id;
            $record->title = $this->title;
            $record->description = $this->description;
            $record->body = $this->body;
            $record->user_id = \Yii::$app->user->getId();
            return $record->save();
        }
        return false;
    }

    //обновление поста
    public function update()
    {
        if ($this->validate()) {
            $image_id = $this->SaveImage();

            $record = News::findOne($this->id);
            if($image_id)$record->image_id = $image_id;
            $record->title = $this->title;
            $record->description = $this->description;
            $record->body = $this->body;
            $record->user_id = \Yii::$app->user->getId();
            return $record->save();
        }
        return false;
    }

    //удаление статьи со всеми зависимостями
    public function delete()
    {
        if ($this->validate()) {
            $record = News::findOne($this->id);
            ControlImage::ImageDelete($record->image_id);
            return $record->delete();
        }
        return false;
    }

    //сохранение/обновление обложки поста
    protected function SaveImage()
    {
        $image = [];
        foreach ($this->files as $file) {
            if (!empty($file)) {
                //удаляем старое изображение
                if($this->id){
                    $news = News::findOne($this->id);
                    ControlImage::ImageDelete($news->image_id);
                }
                //добавляем новое изображение
                $app = \Yii::getAlias('@app');
                $file_name = '/images/content/' . time() .'.'. $file->extension;
                $file->saveAs($app.'/web'.$file_name);

                $image = new Image();
                $image->image = $file_name;
                $image->save();
                return $image->id;
            }
        }

    }
}
