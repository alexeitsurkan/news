<?php namespace app\models;

use app\helpers\file\FileHelpers;
use app\models\Entity\Profile;
use app\models\Entity\User;
use Yii;
use yii\base\Model;

/**
 * модель обрабоки формы профиля пользователя
 * Class ProfileForm
 * @package backend\modules\base\models
 */
class ProfileForm extends Model
{
    public $first_name;
    public $last_name;
    public $middle_name;
    public $avatar;
    public $email;
    public $pass;
    public $notify_sender = [];
    public $notify_event   = [];

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        $upload_max_filesize = ini_get('upload_max_filesize');
        $max_file_size = FileHelpers::ReturnBytes($upload_max_filesize);
        $max_files = ini_get('max_file_uploads');
        return [

            ['last_name', 'trim'],
            ['last_name', 'match', 'pattern' => '/[а-яёa-z-]*/i'],
            ['last_name', 'string', 'length' => [3, 24]],

            ['first_name', 'trim'],
            ['first_name', 'required', 'message' => 'Заполните поле имя'],
            ['first_name', 'match', 'pattern' => '/[а-яёa-z-]*/i'],
            ['first_name', 'string', 'length' => [3, 24]],

            ['middle_name', 'trim'],
            ['middle_name', 'match', 'pattern' => '/[а-яёa-z-]*/i'],
            ['middle_name', 'string', 'length' => [3, 24]],

            ['email', 'trim'],
            ['email', 'required', 'message' => 'Заполните поле E-mail'],
            ['email', 'email'],
            ['email', 'string', 'max' => 100],

            ['pass', 'trim'],
            ['pass', 'string', 'min' => 6, 'max' => 12],

            ['avatar', 'file', 'maxFiles' => 1, 'maxSize' => $max_file_size],
            [['notify_sender','notify_event'], 'each', 'rule' => ['integer']],

        ];
    }

    public function update()
    {
        $id = Yii::$app->user->getId();
        $profile = Profile::get($id);
        $profile->last_name = $this->last_name;
        $profile->first_name = $this->first_name;
        $profile->middle_name = $this->middle_name;
        $profile->notify_settings = $this->GetNotifySettings();
        $profile->update();

        $user = User::findIdentity($id);
        if (!empty($this->email)) $user->updateEmail($this->email);
        if (!empty($this->pass)) $user->updatePassword($this->pass);

        //сохраняем фотку
        foreach ($this->avatar as $file) {
            if (!empty($file)) {
                $puth = \Yii::getAlias('@app') . '/web';
                $name = '/images/avatars/' . uniqid() . '.' . $file->extension;
                $file_name = $puth . $name;
                $file->saveAs($file_name);
                FileHelpers::ImageResize($file_name, 250, 100);
                $profile->avatar = $name;
                $profile->update();
            }
            break;
        }
        return true;
    }

    public function GetNotifySettings()
    {
        $data = [
            'notify_sender' => $this->notify_sender,
            'notify_event'   => $this->notify_event,
        ];
        return json_encode($data);
    }
}
