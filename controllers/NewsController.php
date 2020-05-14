<?php namespace app\controllers;

use app\models\ControlNews;
use app\models\Entity\News;
use app\models\ShowNews;
use phpDocumentor\Reflection\Types\Integer;
use Yii;
use yii\data\Pagination;
use yii\db\Exception;
use yii\web\Controller;

class NewsController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    //постраничный список новостей
    public function actionIndex()
    {
        $model = new ShowNews();
        $query = $model->GetQueryNews();
        $clonQuery = clone $query;
        $pages = new Pagination(['totalCount' => $clonQuery->count(), 'pageSize' => 10]);

        $data = $query
            ->orderBy('news.id DESC')
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        return $this->render('index',[
            'data'  => $data,
            'pages' => $pages,
        ]);
    }

    //получить новость по id
    public function actionView($id)
    {
        $model = new ShowNews();
        $data = $model->ShowOneNews($id);

        return $this->render('view',[
            'data' => $data,
        ]);
    }

    //форма добавление/обновление новости
    public function actionForm(Integer $id = null)
    {
        $model = new ControlNews();
        if(!empty($id)){
            $data = News::findOne($id);
            if(!empty($data)){
                $model->title = $data->title;
                $model->body = $data->body;
            }
        }
        return $this->render('form_news',[
            'model' => $model,
        ]);
    }

    //добавление новости
    public function actionAdd()
    {
        $post = Yii::$app->request->post();
        $model = new ControlNews(['scenario' => ControlNews::CREATE]);
        if ($model->load($post) && $model->validate()) {
            return $model->create();
        }
        throw new Exception('data not correct');
    }

    //изменение новости
    public function actionUpdate()
    {
        $post = Yii::$app->request->post();
        $model = new ControlNews(['scenario' => ControlNews::UPDATE]);
        if ($model->load($post) && $model->validate()) {
            return $model->update();
        }
        throw new Exception('data not correct');
    }

    //удаление новости
    public function actionDelete()
    {
        $post = Yii::$app->request->post();
        $model = new ControlNews(['scenario' => ControlNews::DELETE]);
        if ($model->load($post) && $model->validate()) {
            return $model->delete();
        }
        throw new Exception('data not correct');
    }
}
