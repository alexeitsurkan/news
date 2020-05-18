<?php

use app\assets\SendNotifyBundle;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

SendNotifyBundle::register($this);

/**
 * @var $model
 * @var $dic_user
 */

$this->title = 'Форма уведомлений';
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
                        'options' => [
                            'enctype' => 'multipart/form-data'
                        ]
                    ]) ?>
                    <div class="row">
                        <div class="col-sm-12 form-group">
                            <label class="col-sm-12 text-left">Заголовок уведомления:</label>
                            <div class="col-sm-12">
                                <?= Html::activeTextInput($model, 'title', [
                                    'class' => 'form-control input-sm',
                                    'id' => 'title',
                                    'type' => 'text',
                                    'maxlength' => '30',
                                ]) ?>
                            </div>
                        </div>
                        <div class="col-sm-12 form-group">
                            <label class="col-sm-12 text-left">Текст уведомления:</label>
                            <div class="col-sm-12">
                                <?= Html::activeTextarea($model, 'body', [
                                    'class' => 'form-control input-sm',
                                    'id' => 'body',
                                    'type' => 'text',
                                    'rows' => '6',
                                    'maxlength' => '120',
                                ]) ?>
                            </div>
                        </div>
                        <div class="col-sm-12 form-group">
                            <label class="col-sm-12 text-left">Обратная ссылка</label>
                            <div class="col-sm-12">
                                <?= Html::activeTextInput($model, 'click_action', [
                                    'class' => 'form-control input-sm',
                                    'id' => 'click_action',
                                    'type' => 'text',
                                ]) ?>
                            </div>
                        </div>
                        <div class="col-sm-12 form-group">
                            <label class="col-sm-12 text-left">Выберите кому хотите отправить уведомление</label>
                            <div class="col-sm-12">
                                <?= Html::activeDropDownList($model, 'users', $dic_user, [
                                        'id' => 'users',
                                        'multiple' => true,
                                ]) ?>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-xs-12">
                            <button type="submit" class="btn btn-success">Отправить</button>
                        </div>
                    </div>
                    <?php ActiveForm::end() ?>
                </article>
            </div>
        </div>
    </div>
</div>

