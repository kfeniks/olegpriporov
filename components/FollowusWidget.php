<?php

namespace app\components;

use yii\base\Widget;
use yii\helpers\Html;
use app\models\FollowForm;
use yii\bootstrap\ActiveForm;

class FollowusWidget extends Widget
{
    public function run()
    {
        $follow = new FollowForm();
        $form = ActiveForm::begin(['id' => 'form-signup']);
        echo '<div class="field half">';
        echo $form->field($follow, 'email')->label('');
        echo '</div>';
        echo '<ul class="actions">';
        echo '<li>';
        echo Html::submitButton('Follow us', ['class' => 'special', 'name' => 'signup-button']);
        echo '</li></ul>';
        ActiveForm::end();
    }
}