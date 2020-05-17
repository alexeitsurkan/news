<?php

use yii\helpers\Url;

?>


<ul>
    <li><a href="<?=Url::toRoute(['user/login'])?>">Войти</a></li>
    <li><a href="<?=Url::toRoute(['user/signup'])?>">Регистрация</a></li>
</ul>