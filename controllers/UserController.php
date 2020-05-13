<?php namespace app\controllers;

use app\models\LoginUser;
use app\models\SignupUser;
use Yii;
use yii\web\Controller;

class UserController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    //аутентификация пользователя
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginUser();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goHome();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    //выйти из аккаунта пользователя
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    //регистрация пользователя
    public function actionSignup()
    {
        $post = Yii::$app->request->post();
        $model = new SignupUser();
        if ($model->load($post) && $model->SignUp()) {
            return $this->render('signup_response');
        }
        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    //удаление пользователя
    public function actionDelete()
    {
        //todo a.curkan сделать
    }

    //востановление пароля
    public function actionRecovery()
    {
        //todo a.curkan сделать
    }
}
