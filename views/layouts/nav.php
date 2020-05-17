<?php

use app\widgets\TopMenu;
use yii\helpers\Url;

?>

<nav class="gtco-nav" role="navigation">
    <div class="container">
        <div class="row">
            <div class="col-xs-4 text-left">
                <div id="gtco-logo"><a href="<?= Url::toRoute(['/']) ?>">Telecom_Club.<span>News</span></a></div>
            </div>
            <div class="col-xs-8 text-right menu-1">
                <?= TopMenu::widget(); ?>
            </div>
        </div>
    </div>
</nav>