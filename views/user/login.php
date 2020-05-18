<?php

use app\widgets\Alert;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'Вход';
?>
<?= Alert::widget() ?>
<header id="gtco-header" class="gtco-cover" role="banner" style="height: 300px">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-7 text-left">
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
                        <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientScript' => false]); ?>
                        <h3 class="text-center">Введите ваши данные</h3>
                        <?= $form->field($model, 'username', [
                            'options' => ['class' => 'form-group has-feedback']
                        ])->label(false)->textInput(['placeholder' => $model->getAttributeLabel('Логин')]) ?>

                        <?= $form->field($model, 'password', [
                            'options' => ['class' => 'form-group has-feedback']
                        ])->label(false)->passwordInput(['placeholder' => $model->getAttributeLabel('Пароль')]) ?>

                        <div class="row form-group">
                            <div class="col-xs-8">
                                <a href="<?=Url::toRoute(['user/recovery'])?>" id="recovery-btn">Восстановить пароль</a>
                            </div>
                            <div class="col-xs-4">
                                <button type="submit" class="btn btn-success btn-block btn-flat">Вход</button>
                            </div>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </article>
            </div>
        </div>
    </div>
</div>























