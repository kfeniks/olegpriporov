<?php

namespace app\models;

use yii\db\ActiveRecord;
use Yii;
use yii\helpers\HtmlPurifier;

/**
 * Posts is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class Posts extends ActiveRecord
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
        return '{{%posts}}';
    }
    public function attributeLabels()
    {
        return [

        ];
    }
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'cat_id']);
    }
    public function getTextTitle()
    {
        return $text = mb_substr(HtmlPurifier::process($this->title), 0, 100);
    }
    private function getStartDate(){
        $startDate = new \DateTime(Yii::$app->formatter->asDatetime($this->date_event, 'medium'), new \DateTimeZone("UTC"));
        $today = new \DateTime();
        $daysToStart = $today->diff($startDate, false)->days;
    }
    public function getDays()
    {
        $this->getstartDate();
        if(($daysToStart > 2) && ($startDate > $today) ) {$days = Yii::$app->formatter->asDate($this->date_event, 'd MMMM yyyy');}
        if($daysToStart < 2) {$days = 'Tomorrow at';}
        if($daysToStart == 0) {$days = 'Today at'; }
        if($daysToStart == 2) {$days = '2 days left at';}
        if(!($daysToStart == $today) && ($startDate < $today)) {$days = 'Ended';}
        return $days;
    }
    public function getHours()
    {
        $this->getstartDate();
        if(($daysToStart > 2) && ($startDate > $today) ) {$hour = Yii::$app->formatter->asTime($this->date_event, 'short');}
        if($daysToStart < 2) {$hour = Yii::$app->formatter->asTime($this->date_event, 'short');}
        if($daysToStart == 0) {$hour = Yii::$app->formatter->asTime($this->date_event, 'short'); }
        if($daysToStart == 2) {$hour = Yii::$app->formatter->asTime($this->date_event, 'short');}
        if(!($daysToStart == $today) && ($startDate < $today)) {$hour = '';}
        return $hour;
    }
}
