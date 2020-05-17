<?php namespace app\widgets;

use app\models\Entity\AuthAssignment;
use Yii;

class TopMenu extends \yii\bootstrap\Widget
{
    public function run()
    {
        $user_id = Yii::$app->user->getId();
        if($user_id){
            $role = AuthAssignment::GetUserRole($user_id);
            $role_name = $role->item_name;

            switch ($role_name){
                case 'admin':
                    return $this->render('top_menu_admin');
                    break;
                case 'moderator':
                    return $this->render('top_menu_moderator');
                    break;
            }
        }else{
            return $this->render('top_menu');
        }
    }
}
