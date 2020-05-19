<?php namespace app\models;

use app\helpers\file\FileHelpers;
use app\models\Entity\News;
use app\models\Entity\Image;
use app\models\Events\UserNotifyEvents;
use Yii;
use yii\base\Model;
use yii\web\ForbiddenHttpException;
use yii\web\UploadedFile;

class NewsControl extends Model
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

    const EVENT_ADD_NEWS = 'add_news';

    public function init()
    {
        $this->on(self::EVENT_ADD_NEWS,[Yii::$app->notifier,'sendNotify']);
        parent::init();
    }

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

            $news = new News();
            $news->image_id = $image_id;
            $news->title = $this->title;
            $news->description = $this->description;
            $news->body = $this->body;
            $news->user_id = \Yii::$app->user->getId();
            if($news->save()){
                $event = new UserNotifyEvents();
                $event->title = $this->title;
                $event->body = $this->description;
                $this->trigger(self::EVENT_ADD_NEWS,$event);
                return true;
            }
        }
        return false;
    }

    //обновление поста
    public function update()
    {
        if ($this->validate()) {
            $news = News::findOne($this->id);
            if (\Yii::$app->user->can('manageNews', ['news' => $news])) {
                $image_id = $this->SaveImage();

                if ($image_id) $news->image_id = $image_id;
                $news->title = $this->title;
                $news->description = $this->description;
                $news->body = $this->body;
                $news->user_id = \Yii::$app->user->getId();
                return $news->save();
            } else {
                throw new ForbiddenHttpException;
            }
        }
        return false;
    }

    //удаление статьи со всеми зависимостями
    public function delete()
    {
        $news = News::findOne($this->id);
        if (\Yii::$app->user->can('manageNews', ['news' => $news])) {
            if ($this->validate()) {
                ImageModel::ImageDelete($news->image_id);
                return $news->delete();
            }
            return false;
        } else {
            throw new ForbiddenHttpException;
        }
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
                    ImageModel::ImageDelete($news->image_id);
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
