<?php
use yii\helpers\Html;
?>


    <a class="event_card_image ng-isolate-scope" target="_self" href="<?=Yii::$app->urlManager->createUrl(["view", "id" => $model->id])?>">
        <div class="js-blur_image blur_image"></div>
        <span class="event_status_icon upcoming" data-event-start-month="<?=Yii::$app->formatter->asDate($model->date_event, 'MMM')?>" data-event-start-day="<?=Yii::$app->formatter->asDate($model->date_event, 'd')?>">
            </span>
        <div class="event_thumbnail_wrapper">
            <img src="<?= Html::encode($model->img); ?>">
        </div>
    </a>
    <div class="event_details_wrapper">

        <div class="event_card_expiryTime ng-scope" >
            <span class="ng-binding highlight"><?= $model->days ?></span>
            <span class="ng-binding"> <?= $model->hours ?> </span>
        </div>
        <div class="event_card_expiryTime ng-scope" >
        <a target="_self" href="<?=Yii::$app->urlManager->createUrl(["view", "id" => $model->id])?>"><?= $model->textTitle; ?></a>
        </div>
        <div class="event_card_info">
            <a title="Total Views" class="event_info_title icon icon_viewers pull_left ls_tooltip_parent fade_away ng-binding" target="_self" href="<?=Yii::$app->urlManager->createUrl(["view", "id" => $model->id])?>"><?= $model->hits ?>
                <span class="ls_tooltip" data-tooltip-text="Total Views"></span>
            </a>
            <a title="Category: <?=$model->category->cat_name?>" class="event_info_title icon icon_posts pull_left ls_tooltip_parent fade_away" target="_self" href="<?=Yii::$app->urlManager->createUrl(["category/view", "id" => $model->cat_id])?>">
                <ng-pluralize><?=$model->category->cat_name?></ng-pluralize>
                <span class="ls_tooltip" data-tooltip-text="Event Posts"></span>
            </a>

        </div>
    </div>



