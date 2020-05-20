<?php namespace app\commands;

use app\rbac\AdminRule;
use app\rbac\CreatorRule;
use app\rbac\ModeratorRule;
use GuzzleHttp\Client;
use Yii;
use yii\console\Controller;

class DefaultController extends Controller
{
    /**
     * одноразовое действие необходимое для инициализации ролей и правил
     * @throws \yii\base\Exception
     */
    public function actionIndex()
    {
        $auth = Yii::$app->authManager;
        //-------------------------------------------------------------
        // добовляем правило редаклирования новостей
        $rule = new CreatorRule;
        $auth->add($rule);

        // добавляем право "manageNews" и связываем правило с правом
        $updateOwnPost = $auth->createPermission('manageNews');
        $updateOwnPost->description = 'Обновление новостей';
        $updateOwnPost->ruleName = $rule->name;
        $auth->add($updateOwnPost);

        $author = Yii::$app->authManager->getRole('moderator');
        // и тут мы позволяем модератору редактировать свои новости
        $auth->addChild($author, $updateOwnPost);
        //-------------------------------------------------------------
        // добовляем правило: действия только для модераторов
        $rule3 = new ModeratorRule;
        $auth->add($rule3);

        //добавляем право на действия только для модераторов
        $confirmUser = $auth->createPermission('forModeroator');
        $confirmUser->description = 'Дает право если ты Модератор';
        $confirmUser->ruleName = $rule3->name;
        $auth->add($confirmUser);

        $author = Yii::$app->authManager->getRole('moderator');
        $auth->addChild($author, $confirmUser);
        //-------------------------------------------------------------
        // добовляем правило: действия только для админа
        $rule4 = new AdminRule;
        $auth->add($rule4);

        //добавляем право на действия только для модераторов
        $confirmUser = $auth->createPermission('forAdmin');
        $confirmUser->description = 'Дает право если ты Админ';
        $confirmUser->ruleName = $rule4->name;
        $auth->add($confirmUser);

        $author = Yii::$app->authManager->getRole('admin');
        $auth->addChild($author, $confirmUser);
        //-------------------------------------------------------------
        //указываем метод для получения входящих обновлений телеграм (например получение telegram chat_id)
        $client = new Client();
        $response = $client->get(Yii::$app->params['telegram_url'] . Yii::$app->params['telegram_token'] . '/setWebhook', [
            'query' => [
                'URL' => Yii::$app->params['homeUrl'].'telegram/get-updates',
            ]
        ]);
    }
}
