<?php

namespace app\controllers;

use app\models\ClientMaster;
use app\models\ClientMasterSearch;
use app\controllers\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\components\Constants as C;
use app\forms\ClientForm;

/**
 * ClientController implements the CRUD actions for ClientMaster model.
 */
class ClientController extends BaseController
{

    protected $clientType;
    protected $title;
    /**
     * Lists all ClientMaster models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ClientMasterSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->query->andWhere(['client_type' => $this->clientType]);
        return $this->render('@app/views/client/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            "seditUrl" => $this->clientType == C::CLIENT_TYPE_CUSTOMER ? "customer/edit-customer" : "vendor/edit-vendor",
            "title" => $this->clientType == C::CLIENT_TYPE_CUSTOMER ? "Customer" : "Vendor",
            "addUrl" => $this->clientType == C::CLIENT_TYPE_CUSTOMER ? "customer/add-customer" : "vendor/add-vendor",

        ]);
    }

    /**
     * Displays a single ClientMaster model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ClientMaster model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new ClientForm(['scenario' => ClientMaster::SCENARIO_CREATE]);

        if ($this->request->isPost) {
            $model->client_type = $this->clientType;
            if ($model->load($this->request->post()) && $model->save()) {
                $title = $this->clientType == C::CLIENT_TYPE_CUSTOMER ? "Customer" : "Vendor";
                $redirectUrl = $this->clientType == C::CLIENT_TYPE_CUSTOMER ? "customer/index" : "vendor/index";
                \Yii::$app->getSession()->setFlash('s', "{$title} has been added successfully.");
                return $this->redirect([$redirectUrl]);
            }
        }

        return $this->render('@app/views/client/form-client', [
            'model' => $model,
            "title" => $this->title
        ]);
    }

    /**
     * Updates an existing ClientMaster model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $title = $this->clientType == C::CLIENT_TYPE_CUSTOMER ? "client" : "vendor";
        $client = ClientMaster::findOne(['id' => $id]);
        if (!$client instanceof ClientMaster) {
            \Yii::$app->getSession()->setFlash('e', 'Record not found');
            return $this->redirect([$title . '/index']);
            exit();
        }
        $model = new ClientForm(['scenario' => ClientMaster::SCENARIO_UPDATE]);
        $model->load($client->attributes, '');
        $model->client_type = $this->clientType;
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            $title = $this->clientType == C::CLIENT_TYPE_CUSTOMER ? "Customer" : "Vendor";
            \Yii::$app->getSession()->setFlash('s', "{$title} has been updated successfully.");
            $redirectUrl = $this->clientType == C::CLIENT_TYPE_CUSTOMER ? "customer/index" : "vendor/index";
            return $this->redirect([$redirectUrl]);
        }

        return $this->render('@app/views/client/form-client', [
            'model' => $model,
            "title" => $this->title
        ]);
    }

    /**
     * Deletes an existing ClientMaster model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ClientMaster model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return ClientMaster the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ClientMaster::findOne(['id' => $id, "client_type" => $this->clientType])) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
