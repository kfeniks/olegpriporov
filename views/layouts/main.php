<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\components\FollowusWidget;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--[if lte IE 8]><script src="/web/assets/js/ie/html5shiv.js"></script><![endif]-->
    <link rel="stylesheet" href="/web/assets/css/main.css" />
    <!--[if lte IE 9]><link rel="stylesheet" href="/web/assets/css/ie9.css" /><![endif]-->
    <!--[if lte IE 8]><link rel="stylesheet" href="/web/assets/css/ie8.css" /><![endif]-->
</head>
<body>
<?php $this->beginBody() ?>

<!-- Wrapper -->
<div id="wrapper">

    <!-- Header -->
    <header id="header">
        <div class="inner">

            <!-- Logo -->
            <a href="<?= Url::to(['site/index']); ?>" class="logo">
                <span class="symbol"><img src="/web/images/logo.svg" alt="" /></span><span class="title">3 FINGERS</span>
            </a>

            <!-- Nav -->
            <nav>
                <ul>
                    <li><a href="#menu">Menu</a></li>
                </ul>
            </nav>

        </div>
    </header>

    <!-- Menu -->
    <nav id="menu">
        <h2>Menu</h2>
        <ul>
           <?php if (Yii::$app->user->isGuest) {?>
               <li><a href="<?= Url::to(['site/index']); ?>">Home</a></li>
            <li><a href="<?= Url::to(['site/about']); ?>">About</a></li>
            <?php } else {?>
               <li><a href="<?= Url::to(['site/index']); ?>">Home</a></li>
            <li><a href="<?= Url::to(['site/about']); ?>">About</a></li>
          <?php
              echo '<li>'
               . Html::beginForm(['/site/logout'], 'post')
               . Html::submitButton(
                   'Logout (' . Yii::$app->user->identity->username . ')',
                   ['class' => 'btn btn-link logout']
               )
               . Html::endForm()
               . '</li>';
           }?>
        </ul>
    </nav>

    <!-- Main -->
    <div id="main">
        <div class="inner">
            <?= $content ?>
        </div>
    </div>

    <!-- Footer -->
    <footer id="footer">
        <div class="inner">
            <section>
                <h2>Get contact</h2>
                <?php FollowusWidget::begin();
                    FollowusWidget::end(); ?>
            </section>
            <section>
                <h2>Follow</h2>
                <ul class="icons">
                    <li><a href="https://www.linkedin.com/in/oleg-priporov-176356a0/" class="icon style2 fa-linkedin"><span class="label">Linkedin</span></a></li>
                    <li><a href="https://www.artstation.com/artist/olegpriporov" class="icon style2 fa-artstation"><span class="label">Artstation</span></a></li>
                </ul>
            </section>
            <ul class="copyright">
                <li>&copy; <?= date('Y') ?>. All rights reserved</li><li>Made by: <a href="http://keccgroup.ru">KECCGROUP.RU</a></li>
            </ul>
        </div>
    </footer>

</div>

<!-- Scripts -->
<script src="/web/assets/js/jquery.min.js"></script>
<script src="/web/assets/js/skel.min.js"></script>
<script src="/web/assets/js/util.js"></script>
<!--[if lte IE 8]><script src="/web/assets/js/ie/respond.min.js"></script><![endif]-->
<script src="/web/assets/js/main.js"></script>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
