<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use dosamigos\tinymce\TinyMce;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Posts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php if ($model->img !== null){?>
        <img src="<?= Html::encode($model->img) ?>" style="width: 500px; height: 333px;" alt="<?= Html::encode($this->title) ?>" />
    <?php } ?>
    <?= $form->field($model, 'title')->textInput(['maxlength' => true])->hint('Введите до 150зн') ?>
    <?= $form->field($model, 'cat_id')->dropDownList(ArrayHelper::map(\app\models\Category::find()->all(), 'id', 'cat_name')); ?>

    <?= $form->field($model, 'text')->widget(TinyMce::className(),
        [
            'language' => 'ru',
            'options' => ['rows' => 20],
            'clientOptions' => [
                'plugins' => [
                    "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                    "searchreplace wordcount visualblocks visualchars code fullscreen",
                    "insertdatetime media nonbreaking save table contextmenu directionality",
                    "emoticons template paste textcolor colorpicker textpattern imagetools codesample toc",
                ],
                'toolbar1' => "undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
                'toolbar2' => "print preview media | forecolor backcolor emoticons | codesample",
                'image_advtab' => "true",
                'menubar' => "false",
                'theme' => "modern",
                'toolbar_items_size' => "small",
                'relative_urls' => "false",
                'remove_script_host' => "false",
                'external_filemanager_path' => '/web/filemanager/',
                'filemanager_title' => 'Responsive Filemanager',
                'external_plugins' => [
                    // Кнопка загрузки файла в диалоге вставки изображения.
                    'filemanager' => '/web/filemanager/plugin.min.js',
                    // Кнопка загрузки файла в тулбаре.
                    'responsivefilemanager' => '/web/tinymce/plugins/responsivefilemanager/plugin.min.js',
                ],
            ]
        ]);

    ?>

    <?= $form->field($model, 'hits')->textInput() ?>
    <?= $form->field($model, 'hide')->textInput()->hint('1 - да, 0 - нет') ?>
    <?php
    echo DatePicker::widget([
        'model' => $model,
        'form' => $form,
        'attribute' => 'date',
        'type' => DatePicker::TYPE_INPUT,

        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'yyyy-mm-dd'
        ]
    ]);
    ?>
    <?php
    echo DatePicker::widget([
        'model' => $model,
        'form' => $form,
        'attribute' => 'date_event',
        'type' => DatePicker::TYPE_INPUT,

        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'yyyy-mm-dd'
        ]
    ]);
    ?>
    <?= $form->field($model, 'fileImage')->fileInput(); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
