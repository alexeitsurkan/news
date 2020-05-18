<?php
namespace app\components;

use app\models\Entity\Profile;
use app\models\Entity\User as Users;

/**
 * Class User
 * @package app\components
 * @property string $user_fio
 * @property string $user_name
 * @property string $email
 * @property string $avatar
 */
class User extends \yii\web\User
{
    public function init() {
        parent::init();
    }

    private $user_fio;
    private $user_name;
    private $email;
    private $avatar;

    /**
     * @return string - полное имя пользователя
     */
    public function GetUserFio(){
        if($this->user_fio){
            return $this->user_fio;
        }else{
            $id = $this->identity->getId();
            $profile = Profile::get('$id');
            $this->user_fio  = (!empty($profile))? $profile->last_name.' '.$profile->first_name.' '.$profile->middle_name   : '';
            return $this->user_fio;
        }
    }

    /**
     * @return string - имя пользователя
     */
    public function GetUserName()
    {
        if($this->user_name){
            return $this->user_name;
        }else{
            $id = $this->identity->getId();
            $profile = Profile::get($id);
            $this->user_name = (!empty($profile))? $profile->first_name : '';
            return $this->user_name;
        }
    }

    public function GetEmail()
    {
        if($this->email){
            return $this->email;
        }else{
            $id = $this->identity->getId();
            $user = Users::findIdentity($id);
            $this->email = $user->email;
            return $this->email;
        }
    }

    public function GetImgSrc()
    {
        if($this->avatar){
            return $this->avatar;
        }else{
            $id = $this->identity->getId();
            $profile = Profile::get($id);
            if(!empty($profile->avatar)){
                $this->avatar = $profile->avatar;
                return $this->avatar;
            }else{
                return "/images/avatar.png";
            }

        }
    }
}