<?php

namespace app\rbac;

use app\models\Entity\AuthAssignment;
use yii\rbac\Rule;

/**
 * Праверка на модератора
 * Class ModeratorRule
 * @package app\rbac
 */
class ModeratorRule extends Rule
{
    public $name = 'isModerator'; // Имя правила

    public function execute($user_id, $item, $params)
    {
        $role = AuthAssignment::GetUserRole($user_id);
        if($role->item_name == 'admin')return true;//доступ для админа

        $role = AuthAssignment::GetUserRole($user_id);
        if($role->item_name == 'moderator')return true;
        return false;
    }
}