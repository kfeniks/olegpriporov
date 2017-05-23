<?php

/* @var $this yii\web\View */
use yii\widgets\ListView;
$this->title = '3 FINGERS';
?>
<header>
    <h1>3 FINGERS are open to new proposals.<br />
        We will be glad to cooperate.</h1>
    <p>Our Studio specializes in computer graphics in the entertainment industry. Based in Kiev, Ukraine. Each project is a pleasure for us.</p>
</header>


    <?=                             ListView::widget([
        'dataProvider' => $listDataProvider,

        'itemView' => '_gallery',

        'pager' => [
            'firstPageLabel' => 'Первая',
            'lastPageLabel' => 'Последняя',
            'nextPageLabel' => '>>',
            'prevPageLabel' => '<<',
            'maxButtonCount' => 5,
        ],

        'options' => [
            'tag' => 'section',
            'class' => 'tiles',
            'id' => 'news-list',],
        'itemOptions' => [
            'tag' => 'div',
            'class' => 'event_card ng-scope scope',
        ],
        'emptyText' => '<b>Сейчас нет новостей</b>.',
        'summary' => ''
    ]);
    ?>
