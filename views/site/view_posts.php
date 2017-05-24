<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PostsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Список стримов';
$this->params['breadcrumbs'][] = $this->title;
?>
    <p>
        <?= Html::a('Создать стрим', ['create'], ['class' => 'btn btn-success']) ?> <?= Html::a('Вернуться назад', ['admin'], ['class' => 'btn btn-success']) ?>
    </p>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'id',
        'title:ntext',
        [
            'label' => 'Категория',
            'attribute'=>'category.cat_name',
        ],
        'hits',
        [
            'attribute'=>'hide',
            'format' => 'raw',
            'value' => function($data){ return $data->NameStatus;}
        ],

        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>