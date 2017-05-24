<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class FollowForm extends Model
{
    public $email;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['email'], 'required'],
            ['email', 'string', 'min' => 4, 'max' => 255],
            // verifyCode needs to be entered correctly
            ['email', 'email'],
            //['email', 'unique', 'targetClass' => '\app\models\Email', 'message' => 'This emeil is already registered.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'email' => 'Email',
        ];
    }

    public function sendEmail($email)
    {
        $subject = 'Новая подписка';
        $news = Yii::$app->request->url;
        $body = '
             Письмо на сайте OlegPri             
             Здравствуй, админ! Тебе пришло письмо с сайта.             
             Почта: '.$email.'
             Страница: '.$news.'
                                    
        ';
        return Yii::$app->mailer->compose()
            ->setTo([Yii::$app->params['followEmail'] => 'Oleg'])
            ->setFrom([Yii::$app->params['supportEmail'] => 'My site'])
            ->setSubject($subject)
            ->setTextBody($body)
            ->send();
    }
}
