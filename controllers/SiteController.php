<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Posts;
use app\models\FollowForm;
use app\models\Email;
use yii\helpers\Html;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {
        $follow = new FollowForm();
        if ($follow->load(Yii::$app->request->post()))
        {
            $email = Html::encode($follow->email);
            $model = new Email();
            $model->email = $email;
            $model->news = Yii::$app->request->getUrl;
            if (!($model->save)){return $this->redirect(['site/error']);}
            $follow->sendEmail($email);
            return $this->redirect(Yii::$app->urlManager->createUrl(['site/follow', 'email' => $email]));
        }
        return true;
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Posts::find()->where(['hide' => Posts::STATUS_APPROVED])->orderBy('date_event DESC'),
            'pagination' => [
                'pageSize' => 12,
            ],
        ]);
        return $this->render('index', ['listDataProvider' => $dataProvider]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionFollow($email)
    {
        if ($email == null){return $this->redirect(['site/error']);}
        $model = Email::find()->where(['email' => $email])->one();
        if($model == null){return $this->redirect(['site/error']);}
        return $this->render('follow', [
            'model' => $model,
        ]);

    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
    public function actionView($id)
    {
        if (($model = Posts::findOne($id)) !== null) {
            $model->updateCounters(['hits' => 1]);
            return $this->render('view', [
                'model' => $model,
            ]);

        } else {
            return $this->redirect(['site/error']);
        }
    }
}
