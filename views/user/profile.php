<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\assets\UserProfileBundle;

UserProfileBundle::register($this);

/**
 * @var $model
 * @var $dicNotifySender
 * @var $dicNotifyEvent
 */


$this->title = 'Профиль пользователя';

?>

<header id="gtco-header" class="gtco-cover" role="banner" style="height: 300px">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div>
                <div class="display-t" style="height: 350px">
                    <div class="display-tc animate-box" data-animate-effect="fadeInUp" style="height: 350px">
                        <h1 class="mb30"><a href="#"><?= $this->title ?></a></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<div id="gtco-maine">
    <div class="container">
        <div class="row row-pb-md">
            <div class="col-md-12">
                <article class="mt-negative container">
                    <?php $form = ActiveForm::begin([
                        'enableClientScript' => false,
                        'action' => Url::toRoute(['user/profile']),
                        'options' => [
                            'enctype' => 'multipart/form-data'
                        ]
                    ]) ?>
                    <div class="row form-group">
                        <div class="col-sm-6">
                            <?= HTML::activeFileInput($model, 'avatar', [
                                'id' => 'input_add_avatar',
                                'class' => 'hidden',
                            ]) ?>
                            <div id="avatar" style="background-image: url(<?= Yii::$app->user->GetImgSrc() ?>);"></div>
                            <span id="add_avatar" class="icon-camera foto_icon"></span>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <?= $form->field($model, 'last_name', [])->label('Фамилия')->textInput(['placeholder' => $model->getAttributeLabel('Иванов')]) ?>
                            </div>
                            <div class="form-group">
                                <?= $form->field($model, 'first_name', [])->label('Имя')->textInput(['placeholder' => $model->getAttributeLabel('Иван')]) ?>
                            </div>
                            <div class="form-group">
                                <?= $form->field($model, 'middle_name', [])->label('Отчество')->textInput(['placeholder' => $model->getAttributeLabel('Иванович')]) ?>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="email" class="col-sm-12 control-label">E-mail</label>
                                <?= $form->field($model, 'email', [
                                    'options' => ['class' => '']
                                ])->label(false)->textInput(['placeholder' => 'email@email.ru']) ?>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <?= $form->field($model, 'pass', [])->label('Новый пароль')->passwordInput(['placeholder' => $model->getAttributeLabel('123456')]) ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-xs-12 control-label no-padding-right">Выберите способ отправки уведомлений</label>
                                <?= Html::activeCheckboxList($model, 'notify_sender', $dicNotifySender, [
                                    'class' => 'offset-1 text-left',
                                    'separator' => '<br>',
                                ]) ?>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-xs-12 control-label no-padding-right">После каких событий отправлять уведомления?</label>
                                <?= Html::activeCheckboxList($model, 'notify_event', $dicNotifyEvent, [
                                    'class' => 'offset-1 text-left',
                                    'separator' => '<br>',
                                ]) ?>
                            </div>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-xs-12">
                            <button type="submit" class="btn btn-success">Сохранить</button>
                        </div>
                    </div>
                    <?php ActiveForm::end() ?>
                </article>
            </div>
        </div>
    </div>
</div>

