<?php

namespace app\controllers;

use app\models\PostsSearch;
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
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

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
                    'delete' => ['POST'],
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
            $model->news = Yii::$app->request->url;
            $check = Email::find()->where(['email' => $email])->andWhere(['news' => $model->news])->one();
            if(!($check == null)){return $this->redirect(['site/error']);}
            if (!($model->save())){return $this->redirect(['site/error']);}
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
            return $this->render('admin');
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->render('admin');
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
    private function checkRules(){
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
    }

    public function actionAdmin()
    {
        $this->checkRules();
        return $this->render('admin');
    }

    protected function findModel($id)
    {
        if (($model = Posts::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionUpdate($id)
    {
        $this->checkRules();
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->fileImage = UploadedFile::getInstance($model, 'fileImage');
            if($model->fileImage){
                $current_image = $model->img;
                $dirname = __DIR__.'/../web/images/';
                $dir = __DIR__.'/../'.$current_image;
                if(file_exists($dir))
                {
                    //удаляем файл
                    unlink($dir);
                    $model->img = '';
                }
                $d = '/web/images/';
                $model->img = $d.$model->fileImage->baseName . '.' . $model->fileImage->extension;
                if(!$model->save()){throw new NotFoundHttpException('The file does not create.');}
                $model->fileImage->saveAs($dirname . '/' . $model->fileImage->baseName . '.' . $model->fileImage->extension);
                return $this->redirect(['update', 'id' => $model->id]);
            }
            else {
                if(!$model->save()){throw new NotFoundHttpException('The page does not saved.');}
                return $this->redirect(['update', 'id' => $model->id]);
            }
        }
        return $this->render('update', [
            'model' => $model,

        ]);
    }
    public function actionCreate()
    {
        $this->checkRules();
        $model = new Posts();

        if ($model->load(Yii::$app->request->post())) {
            $model->fileImage = UploadedFile::getInstance($model, 'fileImage');
            if($model->fileImage){
                $dirname = __DIR__.'/../web/images/';
                $d = '/web/images/';
                $model->img = $d.$model->fileImage->baseName . '.' . $model->fileImage->extension;
                if(!$model->save()){throw new NotFoundHttpException('The page does not saved.');}
                $model->fileImage->saveAs($dirname . '/' . $model->fileImage->baseName . '.' . $model->fileImage->extension);
                return $this->redirect(['update', 'id' => $model->id]);
            }
            else{throw new NotFoundHttpException('The file does not create.');}
        }
        else{

            return $this->render('create', [
                'model' => $model,

            ]);

        }
    }
    public function actionView_posts()
    {
        $this->checkRules();
        $searchModel = new PostsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('view_posts', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionCreate_mail()
    {
        $this->checkRules();
        return $this->render('create_mail');
    }
    public function actionView_mails()
    {
        $this->checkRules();
        return $this->render('view_mails');
    }
    public function actionCreate_category()
    {
        $this->checkRules();
        return $this->render('create_category');
    }
    public function actionView_category()
    {
        $this->checkRules();
        return $this->render('view_category');
    }
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $current_image = $model->img;
        $dir = __DIR__.'/../'.$current_image;
        if(file_exists($dir))
        {
            //удаляем файл
            unlink($dir);
        }
        $this->findModel($id)->delete();
        return $this->redirect(['admin']);
    }
}
