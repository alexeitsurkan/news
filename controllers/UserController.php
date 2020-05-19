<?php namespace app\controllers;

use app\models\Entity\DicNotifyEvent;
use app\models\Entity\DicNotifySender;
use app\models\Entity\Profile;
use app\models\LoginUser;
use app\models\ProfileForm;
use app\models\RecoveryUser;
use app\models\SendNotifyForm;
use app\models\SignupUser;
use app\models\UserModel;
use app\models\VerifyEmailForm;
use yii\base\InvalidArgumentException;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\BadRequestHttpException;
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
                        'actions' => ['login' ,'signup', 'recovery', 'verify-email'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['logout','profile'],
                        'roles' => ['moderator'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['delete','index','send-notify'],
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

            Yii::$app->session->setFlash('success', 'Для заверщения регистрации подтвердите E-mail адрес перейдя по ссылке в письме');
            $this->redirect(Url::toRoute(['user/login']));
        }
        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    //удаление пользователя
    public function actionDelete($id)
    {
        $result = UserModel::deleteUser($id);
        if($result){
            Yii::$app->session->setFlash('success', 'Пользователь удален');
        }
        $this->redirect(Url::toRoute(['user/index']));
    }

    //восстановление пароля
    public function actionRecovery()
    {
        $model = new RecoveryUser();
        $post = Yii::$app->request->post();
        if ($model->load($post) && $model->validate()) {
            if($model->recovery()){
                Yii::$app->session->setFlash('success', 'Новый пароль отправлен на Ваш E-mail адрес');
                $this->redirect(Url::toRoute(['user/login']));
            }
        }
        return $this->render('recovery', [
            'model' => $model,
        ]);
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
                    //$this->redirect(Url::toRoute(['user/logout'])); //todo a.curkan раскоментировать
                }
            }
        }

        $id = Yii::$app->user->getId();
        $profile = Profile::get($id);
        $model->first_name     = $profile['first_name'];
        $model->last_name      = $profile['last_name'];
        $model->middle_name    = $profile['middle_name'];
        $model->avatar         = $profile['avatar'];
        $model->email          = Yii::$app->user->GetEmail();
        if($profile['notify_settings']){
            $notify_settings       = json_decode($profile['notify_settings'],true);
            $model->notify_sender = $notify_settings['notify_sender'];
            $model->notify_event  = $notify_settings['notify_event'];
        }else{
            $model->notify_sender = [];
            $model->notify_event   = [];
        }

        //справочник событий
        $dicNotifyEvent = DicNotifyEvent::getDic();
        //справочник нотификаторов
        $dicNotifySender = DicNotifySender::getDic();

        //ссылка на чат telegram
        $key = 'user_'.$id;//$id - user_id
        Yii::$app->cache->set($key, $id,'3600');
        $href_telegram = 'https://t.me/Telecom_club_news_bot?start='.$key;

        return $this->render('profile', [
            'model'            => $model,
            'dicNotifyEvent'   => $dicNotifyEvent,
            'dicNotifySender'  => $dicNotifySender,
            'href_telegram'    => $href_telegram,
        ]);
    }

    /**
     * Verify email address
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($user = $model->verifyEmail()) {
            if (Yii::$app->user->login($user)) {
                Yii::$app->session->setFlash('success', 'Ваш E-mail подтвержден!');
                return $this->goHome();
            }
        }

        Yii::$app->session->setFlash('error', 'К сожалению, мы не можем подтвердить ваш аккаунт с помощью предоставленного токена.');
        return $this->goHome();
    }

    //список пользователей
    public function actionIndex()
    {
        $query = UserModel::GetUserList();
        $clonQuery = clone $query;
        $pages = new Pagination(['totalCount' => $clonQuery->count(), 'pageSize' => 10]);

        $data = $query
            ->orderBy('user.id DESC')
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        return $this->render('index', [
            'data' => $data,
            'pages' => $pages,
        ]);
    }

    //список пользователей
    public function actionSendNotify()
    {
        $model = new SendNotifyForm();
        $post = Yii::$app->request->post();
        if(!empty($post)){
            $model->load($post);
            if($model->SendNotify()){
                Yii::$app->session->setFlash('success', 'Уведомления отправлены');
            }
            $this->redirect(Url::toRoute(['user/index']));
        }
        $dic_user = SendNotifyForm::DicUser();
        return $this->render('send_notify', [
            'model' => $model,
            'dic_user' => $dic_user,
        ]);
    }
}
