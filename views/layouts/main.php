<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\components\FollowusWidget;

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
            <a href="index.html" class="logo">
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
            <li><a href="index.html">Home</a></li>
            <li><a href="generic.html">Ipsum veroeros</a></li>
            <li><a href="generic.html">Tempus etiam</a></li>
            <li><a href="generic.html">Consequat dolor</a></li>
            <li><a href="elements.html">Elements</a></li>
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
                    <li><a href="#" class="icon style2 fa-twitter"><span class="label">Twitter</span></a></li>
                    <li><a href="#" class="icon style2 fa-facebook"><span class="label">Facebook</span></a></li>
                    <li><a href="#" class="icon style2 fa-instagram"><span class="label">Instagram</span></a></li>
                    <li><a href="#" class="icon style2 fa-dribbble"><span class="label">Dribbble</span></a></li>
                    <li><a href="#" class="icon style2 fa-github"><span class="label">GitHub</span></a></li>
                    <li><a href="#" class="icon style2 fa-500px"><span class="label">500px</span></a></li>
                    <li><a href="#" class="icon style2 fa-phone"><span class="label">Phone</span></a></li>
                    <li><a href="#" class="icon style2 fa-envelope-o"><span class="label">Email</span></a></li>
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
