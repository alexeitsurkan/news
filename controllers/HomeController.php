<?php namespace app\controllers;

use yii\web\Controller;

class HomeController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    //главная страница
    public function actionIndex()
    {
        //todo a.curkan сделать
    }
}
