<?php
/**
 * @var $data
 */

use yii\helpers\Url;

?>

<?php if($data):?>
<div class="row row-pb-md">
    <div class="col-md-12">
        <h3 class="footer-heading">Это интересно</h3>
    </div>
    <?php foreach ($data as $item):?>
    <div class="col-md-4">
        <div class="post-entry">
            <div class="post-img">
                <a href="<?= Url::toRoute(['news/view', 'id' => $item['id']]) ?>"><img src="<?=($item['image'])? $item['image'] : '/images/default.jpg'; ?>" class="img-responsive" alt=""></a>
            </div>
            <div class="post-copy">
                <h4><a href="<?= Url::toRoute(['news/view', 'id' => $item['id']]) ?>"><?=$item['title'] ?></a></h4>
                <a href="<?= Url::toRoute(['news/view', 'id' => $item['id']]) ?>" class="post-meta"><span class="date-posted"><?=$item['date'] ?></span></a>
            </div>
        </div>
    </div>
    <?php endforeach;?>
</div>
<?php endif;?>