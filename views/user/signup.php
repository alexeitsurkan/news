<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'Регистрация';

?>

<header id="gtco-header" class="gtco-cover" role="banner" style="height: 300px">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="text-center">
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
                <article class="mt-negative">
                    <div class="text-left content-article">
                        <?php $form = ActiveForm::begin(['id' => 'signup-form', 'enableClientScript' => false]); ?>
                        <h3 class="text-center">Введите ваши данные</h3>
                        <div class="row"></div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <?= $form->field($model, 'username', [])->label('Логин') ?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <?= $form->field($model, 'password', [])->label('Пароль') ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <?= $form->field($model, 'last_name', [])->label('Фамилия')->textInput(['placeholder' => $model->getAttributeLabel('Иванов')]) ?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <?= $form->field($model, 'first_name', [])->label('Имя')->textInput(['placeholder' => $model->getAttributeLabel('Иван')]) ?>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <?= $form->field($model, 'middle_name', [])->label('Отчество')->textInput(['placeholder' => $model->getAttributeLabel('Иванович')]) ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <?= $form->field($model, 'email', [])->label('E-mail')->textInput(['id' => 'email', 'placeholder' => $model->getAttributeLabel('ivanov@gmail.com')]) ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12">
                                <button type="submit" class="btn btn-success btn-block btn-flat">Зарегистрироваться
                                </button>
                            </div>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </article>
            </div>
        </div>
    </div>
</div>

