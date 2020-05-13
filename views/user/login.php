<?php

use yii\widgets\ActiveForm;

$this->title = 'Вход';
//todo a.curkan доделать внешний вид
?>


<?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>

<?= $form->field($model, 'username', [
    'options' => ['class' => 'form-group has-feedback']
])->label(false)->textInput(['placeholder' => $model->getAttributeLabel('Логин')]) ?>

<?= $form->field($model, 'password', [
    'options' => ['class' => 'form-group has-feedback']
])->label(false)->passwordInput(['placeholder' => $model->getAttributeLabel('Пароль')]) ?>

    <div class="row form-group">
        <div class="col-xs-8">
            <button type="button" class="btn btn-link" id="recovery-btn">Востановить пароль</button>
        </div>
        <div class="col-xs-4">
            <button type="submit" class="btn btn-success btn-block btn-flat">Вход</button>
        </div>
    </div>
<?php ActiveForm::end(); ?>