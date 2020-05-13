<?php namespace app\controllers;

use yii\web\Controller;

class ProfileController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    //обновление профиля пользователя
    public function actionUpdate()
    {
        
    }
}
