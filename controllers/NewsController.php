<?php namespace app\controllers;

use app\models\NewsControl;
use app\models\Entity\News;
use app\models\ShowNews;
use Yii;
use yii\data\Pagination;
use yii\db\Exception;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class NewsController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['error', 'index', 'view'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => [],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['form', 'add', 'update', 'delete'],
                        'roles' => ['moderator'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ]
        ];
    }


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
        return $this->render('index', [
            'data' => $data,
            'pages' => $pages,
        ]);
    }

    //получить новость по id
    public function actionView($id)
    {
        $model = new ShowNews();
        $data = $model->ShowOneNews($id);

        return $this->render('view', [
            'data' => $data,
        ]);
    }

    //статьи добавленные пользователем
    public function actionMyNews()
    {
        $model = new ShowNews();
        $query = $model->GetMyNews();
        $clonQuery = clone $query;
        $pages = new Pagination(['totalCount' => $clonQuery->count(), 'pageSize' => 10]);

        $data = $query
            ->orderBy('news.id DESC')
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        return $this->render('my_news', [
            'data' => $data,
            'pages' => $pages,
        ]);
    }

    //форма добавление/обновление новости
    public function actionForm($id = null)
    {
        $action = 'add';
        $this->view->title = 'Добавление статьи';
        $model = new NewsControl();
        if (!empty($id)) {
            $action = 'update';
            $this->view->title = 'Обновление статьи';
            $news = News::findOne($id);
            if (!empty($news)) {
                if (\Yii::$app->user->can('manageNews', ['news' => $news])) {
                    $model->id = $id;
                    $model->title = $news->title;
                    $model->description = $news->description;
                    $model->body = $news->body;
                }else{
                    throw new ForbiddenHttpException;
                }
            }
        }
        return $this->render('form_news', [
            'model' => $model,
            'action' => $action,
        ]);
    }

    //добавление новости
    public function actionAdd()
    {
        $post = Yii::$app->request->post();
        $model = new NewsControl(['scenario' => NewsControl::CREATE]);
        $model->load($post);
        $model->files = UploadedFile::getInstances($model, 'files');
        if ($model->create()) {
            Yii::$app->session->setFlash('success', 'Новость успешно добавлена');
        } else {
            Yii::$app->session->setFlash('error', 'При добавлении новости произошла ошибка');
        }
        return $this->redirect(Url::toRoute("index"));
    }

    //изменение новости
    public function actionUpdate()
    {
        $post = Yii::$app->request->post();
        $model = new NewsControl(['scenario' => NewsControl::UPDATE]);
        $model->load($post);
        $model->files = UploadedFile::getInstances($model, 'files');
        if ($model->update()) {
            Yii::$app->session->setFlash('success', 'Новость успешно обновлена');
        } else {
            Yii::$app->session->setFlash('error', 'При обновлении новости произошла ошибка');
        }
        return $this->redirect(Url::toRoute("index"));
    }

    //удаление новости
    public function actionDelete($id)
    {
        $model = new NewsControl(['scenario' => NewsControl::DELETE]);
        $model->id = $id;
        if ($model->delete()) {
            Yii::$app->session->setFlash('success', 'Новость успешно удалена');
        } else {
            Yii::$app->session->setFlash('error', 'При удалении новости произошла ошибка');
        }
        return $this->redirect(Url::toRoute("index"));
    }
}
