<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Posts */

$this->title = 'Создать стрим';
$this->params['breadcrumbs'][] = ['label' => 'Admin Panel', 'url' => ['admin']];
$this->params['breadcrumbs'][] = 'Create';
?>
<p>
    <?= Html::a('Список стримов', ['view_posts'], ['class' => 'btn btn-success']) ?>
</p>
<div class="user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
