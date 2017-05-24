<?php

namespace app\models;

use yii\db\ActiveRecord;
use Yii;
use yii\helpers\HtmlPurifier;
use app\components\FollowusWidget;

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
            'hide' => 'Опубликовано',
            'hits' => 'Просмотров',
            'title' => 'Название',
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
    public function getNameStatus(){
        if($this->hide == self::STATUS_APPROVED){return $nameStatus = 'Да';}
        else{return $nameStatus = 'Нет';}
    }
    public function getDays()
    {
        $startDate = new \DateTime(Yii::$app->formatter->asDatetime($this->date_event, 'medium'), new \DateTimeZone("Europe/Moscow"));
        $today = new \DateTime("Europe/Moscow");
        $daysToStart = $today->diff($startDate, false)->days;
        if(($daysToStart > 2) && ($startDate > $today) ) {$days = Yii::$app->formatter->asDate($this->date_event, 'd MMMM yyyy');}
        if($daysToStart < 2) {$days = 'Tomorrow at';}
        if($daysToStart == 0) {$days = 'Today at'; }
        if($daysToStart == 2) {$days = '2 days left at';}
        if(!($daysToStart == $today) && ($startDate < $today)) {$days = 'Ended';}
        return $days;
    }
    public function getHours()
    {
        $startDate = new \DateTime(Yii::$app->formatter->asDatetime($this->date_event, 'medium'), new \DateTimeZone("Europe/Moscow"));
        $today = new \DateTime("Europe/Moscow");
        $daysToStart = $today->diff($startDate, false)->days;
        if(($daysToStart > 2) && ($startDate > $today) ) {$hour = Yii::$app->formatter->asTime($this->date_event, 'short');}
        if($daysToStart < 2) {$hour = Yii::$app->formatter->asTime($this->date_event, 'short');}
        if($daysToStart == 0) {$hour = Yii::$app->formatter->asTime($this->date_event, 'short'); }
        if($daysToStart == 2) {$hour = Yii::$app->formatter->asTime($this->date_event, 'short');}
        if(!($daysToStart == $today) && ($startDate < $today)) {$hour = '';}
        return $hour;
    }
    public function getStatus()
    {
        $startDate = new \DateTime(Yii::$app->formatter->asDatetime($this->date_event, 'medium'), new \DateTimeZone("Europe/Moscow"));
        $today = new \DateTime("Europe/Moscow");
        $daysToStart = $today->diff($startDate, false)->days;
        if($daysToStart == 0){
            $daysToStart = $today->diff($startDate, false)->i;
            if(($daysToStart > 60) && ($startDate < $today) ) {$hour = 'WATCH AGAIN';}
            if($daysToStart < 60) {$hour = 'WATCH NOW'; }
        }else{
            if(($daysToStart > 1) && ($startDate < $today) ) {$hour = 'WATCH AGAIN';}
            if(($daysToStart > 1) && ($startDate > $today) ) {$hour = 'GET NOTIFIED';}
        }
        return $hour;
    }
    public function getVideos()
    {
        $startDate = new \DateTime(Yii::$app->formatter->asDatetime($this->date_event, 'medium'), new \DateTimeZone("Europe/Moscow"));
        $today = new \DateTime("Europe/Moscow");
        $daysToStart = $today->diff($startDate, false)->days;
        if($daysToStart == 0){
            $daysToStart = $today->diff($startDate, false)->i;
            if(($daysToStart > 60) && ($startDate < $today) ) {$hour = 'https://player.twitch.tv/?video='. $this->stream;}
            if($daysToStart < 60) {$hour = 'https://player.twitch.tv/?channel=threefingersoleg'; }
        }else{
            if(($daysToStart > 1) && ($startDate < $today) ) {$hour = 'https://player.twitch.tv/?video='. $this->stream;}
            if(($daysToStart > 1) && ($startDate > $today) ) {
                $hour1 = FollowusWidget::begin();
                $hour2 = FollowusWidget::end();
                $hour = '<h2>Get contact</h2>. $hour1. $hour2. ';}
        }
        return $hour;
    }
}
