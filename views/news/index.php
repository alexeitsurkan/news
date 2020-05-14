<?php


/**
 * @var $data
 * @var $pages
 */


use yii\helpers\Url;
use yii\widgets\LinkPager;

$post_size = ['full', 'one-third', 'one-third', 'one-third', 'two-third', 'one-third'];
?>

<header id="gtco-header" class="gtco-cover gtco-cover-sm" role="banner" style="background-image:url(images/content/zz.jpeg);">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-9 text-left">
                <div class="display-t">
                    <div class="display-tc animate-box" data-animate-effect="fadeInUp">
                        <span class="date-post">Информационное агенство</span>
                        <h1 class="mb30"><a href="#">Новости</a></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<div id="gtco-main">
    <div class="container">
        <div class="row row-pb-md">
            <div class="col-md-12">
                <ul id="gtco-post-list">

                    <?php foreach($data as $key => $value):
                        $count_size = (int)count($post_size);
                        $i = $key - $count_size*floor($key/$count_size);
                    ?>
                        <li class="<?=$post_size[$i] ?> entry animate-box" data-animate-effect="fadeIn">
                            <a href="<?= Url::toRoute(['news/view', 'id' => $value['id']]) ?>">
                                <div class="entry-img" style="background-image: url(<?= (!empty($value['image']))?$value['image']:''; ?>)"></div>
                                <div class="entry-desc">
                                    <h3><?=$value['title'] ?></h3>
                                    <p><?=$value['description'] ?></p>
                                </div>
                            </a>
                            <span class="post-meta"><?=$value['user'] ?>  <span class="date-posted"><?=$value['date'] ?></span></span>
                        </li>
                    <?php endforeach;?>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <nav aria-label="Page navigation">
                    <?php echo LinkPager::widget(['pagination' => $pages, 'id' => 'main_pagination']); ?>
                </nav>
            </div>
        </div>
    </div>
</div>