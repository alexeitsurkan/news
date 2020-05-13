<?php namespace app\controllers;

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

    //список новостей
    public function actionIndex()
    {
        //todo a.curkan сделать
    }

    //получить новость по id
    public function actionView($id)
    {
        //todo a.curkan сделать
    }

    //добавление новости
    public function actionAdd()
    {
        //todo a.curkan сделать POST
    }

    //изменение новости
    public function actionUpdate($id)
    {
        //todo a.curkan сделать POST
    }

    //удаление новости
    public function actionDelete($id)
    {
        //todo a.curkan сделать POST
    }
}
