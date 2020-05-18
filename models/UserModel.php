<?php namespace app\models;

use app\models\Entity\AuthAssignment;
use app\models\Entity\Profile;
use app\models\Entity\User;
use Yii;
use yii\base\Model;
use yii\db\Query;

/**
 * Class UserModel
 * @package app\models
 */
class UserModel extends Model
{
    public static function GetUserList()
    {
        $query = new Query();
        $query->select([
            'user.id AS id',
            'user.email AS email',
            'date_format(FROM_UNIXTIME(user.created_at),\'%d.%m.%Y %H:%i\') AS date',
            "CONCAT(p.last_name, ' ', p.first_name) AS name",
        ])
            ->from([
                'user'
            ])
            ->join('LEFT JOIN', 'profile p', 'p.user_id = user.id');
        return $query;
    }

    //удаление пользователя
    public static function deleteUser($id)
    {
        if (empty($id)) return false;
        if (Yii::$app->user->getId() == $id) return false;

        $profile = Profile::get($id);
        $puth = \Yii::getAlias('@app') . '/web';

        //удаляем аватарку
        if($profile->avatar){
            $file_puth = $puth . $profile->avatar;
            if (file_exists($file_puth)) unlink($file_puth);
        }
        //удаляем роль
        AuthAssignment::GetUserRole($id)->delete();
        //удаляем записи пользователя из таблиц
        User::findIdentity($id)->delete();

        return true;
    }
}
