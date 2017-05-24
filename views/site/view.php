<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
$this->title = $model->title;
?>
<style>
    .modalDialog {
        position: fixed;
        font-family: Arial, Helvetica, sans-serif;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        background: rgba(0,0,0,0.8);
        z-index: 99999;
        -webkit-transition: opacity 400ms ease-in;
        -moz-transition: opacity 400ms ease-in;
        transition: opacity 400ms ease-in;
        display: none;
        pointer-events: none;
    }

    .modalDialog:target {
        display: block;
        pointer-events: auto;
    }

    .modalDialog > div {
        width: 70%;
        height: 70%;
        position: relative;
        margin: 10% auto;
        padding: 5px 20px 13px 20px;
        border-radius: 10px;
        background: #fff;
        background: -moz-linear-gradient(#fff, #999);
        background: -webkit-linear-gradient(#fff, #999);
        background: -o-linear-gradient(#fff, #999);
    }

    .close {
        background: #606061;
        color: #FFFFFF;
        line-height: 25px;
        position: absolute;
        right: -12px;
        text-align: center;
        top: -10px;
        width: 24px;
        text-decoration: none;
        font-weight: bold;
        -webkit-border-radius: 12px;
        -moz-border-radius: 12px;
        border-radius: 12px;
        -moz-box-shadow: 1px 1px 3px #000;
        -webkit-box-shadow: 1px 1px 3px #000;
        box-shadow: 1px 1px 3px #000;
    }

    .close:hover { background: #00d9ff; }
</style>

<section>
    <h2><?= Html::encode($model->title) ?></h2>
    <h4>Start at <?= HtmlPurifier::process(Yii::$app->formatter->asDate($model->date_event, 'd MMMM yyyy')) ?></h4>
    <span class="image main"><img src="<?= Html::encode($model->img); ?>" alt="<?= Html::encode($model->title) ?>"></span>
    <p><?= HtmlPurifier::process($model->text) ?></p>
    <ul class="actions">
        <li><a href="#openModal" class="button popup-modal"><?=$model->status?></a></li>
    </ul>
</section>

<div id="openModal" class="modalDialog">
    <div>
        <a href="#close" title="Закрыть" class="close">X</a>
        <iframe style="width: 100%; height: 100%" src="<?=$model->videos?>&autoplay=false" frameborder="0" allowfullscreen="true" scrolling="no"></iframe>
    </div>
</div>

