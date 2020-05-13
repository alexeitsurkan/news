<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'Регистрация';

?>


<?php $form = ActiveForm::begin(['id' => 'signup-form']); ?>
<div class="login-box-body">
    <a href="<?= Url::toRoute(['/'])?>" class="btn btn-success" style="float: left">Вход</a>
    <p class="text-center">Введите ваши данные</p>
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
                <?= $form->field($model, 'email', [])->label('E-mail')->textInput(['id' => 'email','placeholder' => $model->getAttributeLabel('ivanov@gmail.com')]) ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <button type="submit" class="btn btn-success btn-block btn-flat">Зарегистрироваться</button>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
