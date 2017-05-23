<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Follow us';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        Thank you. Your email is <?=$model->email?>.
    </p>
</div>
