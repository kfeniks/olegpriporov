<?php

namespace app\models;

use yii\db\ActiveRecord;
use Yii;

/**
 * Posts is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class Email extends ActiveRecord
{
    const STATUS_PENDING=0;
    const STATUS_APPROVED=1;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [

        ];
    }


    public static function tableName()
    {
        return '{{%mail}}';
    }
    public function attributeLabels()
    {
        return [

        ];
    }

}
