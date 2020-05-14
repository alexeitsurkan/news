<?php

use app\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * @var $this \yii\web\View
 * @var $content string
 */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE HTML>

<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="HTML5 Website"/>

    <!-- Facebook and Twitter integration -->
    <meta property="og:title" content=""/>
    <meta property="og:image" content=""/>
    <meta property="og:url" content=""/>
    <meta property="og:site_name" content=""/>
    <meta property="og:description" content=""/>
    <meta name="twitter:title" content=""/>
    <meta name="twitter:image" content=""/>
    <meta name="twitter:url" content=""/>
    <meta name="twitter:card" content=""/>

    <link href="https://fonts.googleapis.com/css?family=Crimson+Text:400,400i|Roboto+Mono" rel="stylesheet">
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="gtco-loader"></div>

<div id="page">
    <nav class="gtco-nav" role="navigation">
        <div class="container">
            <div class="row">
                <div class="col-xs-4 text-left">
                    <div id="gtco-logo"><a href="<?= Url::toRoute(['/']) ?>">Telecom_Club.<span>News</span></a></div>
                </div>
                <div class="col-xs-8 text-right menu-1">
                    <ul>
                        <li><a href="<?= Url::toRoute(['user/login']) ?>">Войти</a></li>
                        <li><a href="<?= Url::toRoute(['user/signup']) ?>">Регистрация</a></li>
                    </ul>
                </div>
            </div>

        </div>
    </nav>
    <?= $content ?>

    <footer id="gtco-footer" role="contentinfo">
        <div class="container">
            <div class="row row-pb-md">
                <div class="col-md-12">
                    <h3 class="footer-heading">Most Popular</h3>
                </div>
                <div class="col-md-4">
                    <div class="post-entry">
                        <div class="post-img">
                            <a href="#"><img src="images/img_1.jpg" class="img-responsive" alt=""></a>
                        </div>
                        <div class="post-copy">
                            <h4><a href="#">How Web Hosting Can Impact Page Load Speed</a></h4>
                            <a href="#" class="post-meta"><span class="date-posted">4 days ago</span></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="post-entry">
                        <div class="post-img">
                            <a href="#"><img src="images/img_2.jpg" class="img-responsive" alt=""></a>
                        </div>
                        <div class="post-copy">
                            <h4><a href="#">How Web Hosting Can Impact Page Load Speed</a></h4>
                            <a href="#" class="post-meta"><span class="date-posted">4 days ago</span></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="post-entry">
                        <div class="post-img">
                            <a href="#"><img src="images/img_3.jpg" class="img-responsive" alt=""></a>
                        </div>
                        <div class="post-copy">
                            <h4><a href="#">How Web Hosting Can Impact Page Load Speed</a></h4>
                            <a href="#" class="post-meta"><span class="date-posted">4 days ago</span></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row copyright">
                <div class="col-md-12 text-center">
                    <p>
                        <small class="block">&copy; 2016 Free HTML5. All Rights Reserved.</small>
                        <small class="block">Designed by <a href="#" target="_blank">BlaBLABLA.co</a> Demo Images: <a href="#" target="_blank">Unsplash</a></small>
                    </p>
                    <p>
                    <ul class="gtco-social-icons">
                        <li><a href="#"><i class="icon-twitter"></i></a></li>
                        <li><a href="#"><i class="icon-facebook"></i></a></li>
                        <li><a href="#"><i class="icon-linkedin"></i></a></li>
                        <li><a href="#"><i class="icon-dribbble"></i></a></li>
                    </ul>
                    </p>
                </div>
            </div>

        </div>
    </footer>
</div>

<div class="gototop js-top">
    <a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
