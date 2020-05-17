<?php namespace app\controllers;

use app\models\Entity\Profile;
use app\models\LoginUser;
use app\models\ProfileForm;
use app\models\SignupUser;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\UploadedFile;

class UserController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login' ,'signup'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['logout','recovery'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
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
        return $this->redirect(Url::toRoute(['user/login']));
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

    //страница профиля пользователя
    public function actionProfile()
    {
        $model = new ProfileForm();
        $post = Yii::$app->request->post();
        if (Yii::$app->request->isPost) {
            if ($model->load($post) && $model->validate()) {
                //загружаем фото
                $model->avatar = UploadedFile::getInstances($model, 'avatar');
                if($model->update()){
                    $this->redirect(Url::toRoute(['user/logout']));
                }
            }
        }

        $id = Yii::$app->user->getId();
        $profile = Profile::GetProfile($id);
        $model->first_name  = $profile['first_name'];
        $model->last_name   = $profile['last_name'];
        $model->middle_name = $profile['middle_name'];
        $model->avatar      = $profile['avatar'];
        $model->email       = Yii::$app->user->GetEmail();
        return $this->render('profile', [
            'model' => $model,
        ]);
    }
}
