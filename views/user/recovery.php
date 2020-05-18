<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var $model
 */


$this->title = 'Восстановление пароля';

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
            <div class="col-xs-12 col-md-6">
                <article class="mt-negative">
                    <?php $form = ActiveForm::begin([
                        'enableClientScript' => false,
                        'options' => [
                            'enctype' => 'multipart/form-data'
                        ]
                    ]) ?>
                    <div class="row">

                        <div class="col-xs-12">
                            <div class="form-group">
                                <label class="control-label no-padding-right">Укажите E-mail адрес зарегистрированный в
                                    системе и мы отправим Вам новый пароль</label>
                                <?= $form->field($model, 'email', [
                                    'options' => ['class' => '']
                                ])->label(false)->textInput(['placeholder' => "email@email.ru"]) ?>
                            </div>
                        </div>

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

