<?php 


namespace app\controllers;

use yii\web\Controller;
use app\models\LoginForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\SingUpForm;

class UserController extends Controller{
    public function actions(){
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ]
            ];
    }
    public function behaviors(){
        return [
            'access' => [
                'class' => AccessControl::class,
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
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }
     /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->render('/site/index');
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }
     /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    // rejstruje uzytkownia 
    public function actionSingup(){
        $model = new SingUpForm;
        if($model->load(Yii::$app->request->post())&&$model->insertValues()){
            $model = new LoginForm;
            return $this->render('login',[
                'model' => $model
            ]);
        }else{
            return $this->render('singup',[
                'model' => $model
            ]);
        }
    }
}