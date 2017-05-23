<?php

namespace app\models;

use yii\db\ActiveRecord;


/**
 * Posts is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class Category extends ActiveRecord
{

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
        return '{{%category}}';
    }
    public function attributeLabels()
    {
        return [

        ];
    }

    public function getPosts()
    {
        return $this->hasOne(Posts::className(), ['id' => 'cat_id']);
    }
}
