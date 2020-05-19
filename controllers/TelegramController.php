<?php namespace app\controllers;

use yii\web\Controller;

class TelegramController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    //получение обновление от телеграм
    public function actionGetUpdates()
    {
        $post = \Yii::$app->request->post();
        $puth = \Yii::getAlias('@app') . '/runtime';
        file_put_contents($puth.'/telegram.txt',$post);
    }
}