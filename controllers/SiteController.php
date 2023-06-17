<?php

namespace app\controllers;

use app\components\Dashboard;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\components\Constants as C;
use app\forms\SearchForm;

class SiteController extends BaseController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return parent::behaviors();
    }

    /**
     * {@inheritdoc}
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
        $model = new Dashboard();
        $model->client_type = C::CLIENT_TYPE_CUSTOMER;
        return $this->render('index', ['model' => $model]);
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionCustomer()
    {
        $model = new Dashboard();
        $model->client_type = C::CLIENT_TYPE_CUSTOMER;
        return $this->render('index', ['model' => $model]);
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionVendor()
    {
        $model = new Dashboard();
        $model->client_type = C::CLIENT_TYPE_VENDOR;
        return $this->render('index', ['model' => $model]);
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
        $this->layout = 'login';
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionSearch()
    {
        
        $model = new SearchForm();
        
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $response = $model->save();
            if ($response['status']) {
                //$url = Yii::$app->urlManager->createUrl($response);
                return Yii::$app->response->redirect($response['url']);
            }else{
                Yii::$app->getSession()->setFlash('e', "No Record found.");
                return Yii::$app->getResponse()->redirect("./".urldecode($response['url']));
            }
        }
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

    public function actionChangesPassword()
    {
        $model = new ChangePasswordForm(['scenario' => User::SCENARIO_CREATE]);
        $name = User::loggedInUserName();
        $model->user_id = User::loggedInUserId();
        $model->name = $name;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $m = $model->save();
            \Yii::$app->getSession()->setFlash('s', "Password of $name updated successfully.");
            return $this->redirect(['index']);
        }
        return $this->render('form-change-password', [
            'model' => $model,
        ]);
    }
}
