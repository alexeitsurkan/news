<?php

namespace app\rbac;

use app\models\Entity\AuthAssignment;
use yii\rbac\Rule;

/**
 * правило доступа где редактировать файлы могут только авторы и admin
 * Class CreatorRule
 * @package app\rbac
 */
class CreatorRule extends Rule
{
    public $name = 'isCreator'; // Имя правила

    public function execute($user_id, $item, $params)
    {
        $role = AuthAssignment::GetUserRole($user_id);
        if($role->item_name == 'admin')return true;//доступ для админа

        return isset($params['file']) ? $params['file']->user_create_id == $user_id : false;
    }
}