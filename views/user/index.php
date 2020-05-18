<?php

/**
 * @var $data
 * @var $pages
 */

use app\widgets\Alert;
use yii\helpers\Url;

$this->title = 'Список пользователей';
?>
<?= Alert::widget() ?>
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
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead class="thin-border-bottom">
                            <tr>
                                <th class="caption_block">Дата регистрации</th>
                                <th class="caption_block">ФИО</th>
                                <th class="caption_block">E-mail</th>
                                <th class="caption_block"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($data)): ?>
                                <?php foreach ($data as $key => $value): ?>
                                    <tr id="<?= $value['id'] ?>">
                                        <td><?= $value['date'] ?></td>
                                        <td><?= $value['name'] ?></td>
                                        <td><?= $value['email'] ?></td>
                                        <td>
                                            <?php if (Yii::$app->user->getId() != $value['id']): ?>
                                                <div class="pull-right">
                                                    <a href="<?= Url::toRoute(['user/delete', 'id' => $value['id']]) ?>" class="btn-xs btn-danger">
                                                        Удалить
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <th colspan="17">
                                        <div align="center">Нет данных</div>
                                    </th>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </article>
            </div>
        </div>
    </div>
</div>