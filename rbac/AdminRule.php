<?php

namespace app\rbac;

use app\models\Entity\AuthAssignment;
use yii\rbac\Rule;

/**
 * Class AdminRule
 * @package app\rbac
 */
class AdminRule extends Rule
{
    public $name = 'isAdmin'; // Имя правила

    public function execute($user_id, $item, $params)
    {
        $role = AuthAssignment::GetUserRole($user_id);
        if($role->item_name == 'admin')return true;//доступ для админа
        return false;
    }
}