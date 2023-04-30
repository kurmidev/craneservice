<?php

namespace app\controllers;

use app\models\ClientMaster;
use app\models\ClientMasterSearch;
use app\controllers\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\components\Constants as C;
use app\forms\ChallanForm;
use app\forms\ClientForm;
use app\models\Challan;
use app\models\ChallanSearch;
use app\models\ClientSiteSearch;
use Symfony\Component\BrowserKit\Client;
use Yii;

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
            "viewUrl" => $this->clientType == C::CLIENT_TYPE_CUSTOMER ? "customer/view-customer" : "vendor/view-vendor",
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
    public function actionView($id, $pg="")
    {
        $pg = Yii::$app->request->get("pg");
        $title = $this->clientType == C::CLIENT_TYPE_CUSTOMER ? "Customer" : "Vendor";
        $baseUrl = $this->clientType == C::CLIENT_TYPE_CUSTOMER ? "customer/view-customer" : "vendor/view-vendor";
        $model = ClientMaster::findOne(['id' => $id]);
        
        $searchModel = new ChallanSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->query->andWhere(["client_id" => $model->id]);


        $siteSearchModel = new ClientSiteSearch();
        $siteDataProvider = $siteSearchModel->search($this->request->queryParams);
        $siteDataProvider->query->andWhere(["client_id" => $model->id]);
        

        return $this->render('@app/views/client/view', [
            'model' => $model,
            "title" => $this->title,
            "baseUrl" => $baseUrl,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            "addUrl" => $this->clientType == C::CLIENT_TYPE_CUSTOMER ? "customer/add-customer" : "vendor/add-vendor",
            "seditUrl" => $this->clientType == C::CLIENT_TYPE_CUSTOMER ? "customer/edit-customer" : "vendor/edit-vendor",
            "viewUrl" => $this->clientType == C::CLIENT_TYPE_CUSTOMER ? "customer/view-customer" : "vendor/view-vendor",
            "challanAddUrl" => $this->clientType == C::CLIENT_TYPE_CUSTOMER ? "customer/add-challan" : "vendor/add-challan",
            "challanEditUrl" => $this->clientType == C::CLIENT_TYPE_CUSTOMER ? "customer/edit-challan" : "vendor/edit-challan",
            "challanViewUrl" => $this->clientType == C::CLIENT_TYPE_CUSTOMER ? "customer/view-challan" : "vendor/view-challan",
            "challanPrintUrl" => $this->clientType == C::CLIENT_TYPE_CUSTOMER ? "customer/print-challan" : "vendor/print-challan",
            "company_id" => $this->clientType == C::CLIENT_TYPE_CUSTOMER ? "customer/view-challan" : "vendor/view-challan",
            "pg" => $pg,
            "siteDataProvider"=>$siteDataProvider,
            "siteSearchModel"=>$siteSearchModel
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

    public function actionPendingChallan($id)
    {
        $searchModel = new ChallanSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->query->andWhere(["client_id" => $id, 'invoice_id' => null]);
        return $this->render('@app/views/client/challan', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            "viewUrl" => $this->clientType == C::CLIENT_TYPE_CUSTOMER ? "customer/view-challan" : "vendor/view-challan",
            "seditUrl" => $this->clientType == C::CLIENT_TYPE_CUSTOMER ? "customer/edit-challan" : "vendor/edit-challan",
            "title" => $this->clientType == C::CLIENT_TYPE_CUSTOMER ? "Customer" : "Vendor",
            "addUrl" => $this->clientType == C::CLIENT_TYPE_CUSTOMER ? "customer/add-challan" : "vendor/add-challan",
        ]);
    }

    public function actionChallan($id)
    {
        $searchModel = new ChallanSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->query->andWhere(["client_id" => $id])->andWhere(['not', ['invoice_id' => null]]);
        return $this->render('@app/views/client/challan', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            "viewUrl" => $this->clientType == C::CLIENT_TYPE_CUSTOMER ? "customer/view-challan" : "vendor/view-challan",
            "seditUrl" => $this->clientType == C::CLIENT_TYPE_CUSTOMER ? "customer/edit-challan" : "vendor/edit-challan",
            "title" => $this->clientType == C::CLIENT_TYPE_CUSTOMER ? "Customer" : "Vendor",
            "addUrl" => $this->clientType == C::CLIENT_TYPE_CUSTOMER ? "customer/add-challan" : "vendor/add-challan",

        ]);
    }

    /**
     * Creates a new ClientMaster model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionAddChallan($id)
    {
        $model = new ChallanForm(['scenario' => ClientMaster::SCENARIO_CREATE]);
        $model->client_id = $id;
        $model->client_type = $this->clientType;
        $client = ClientMaster::findOne(['id' => $id]);
        if ($this->request->isPost) {
            $model->client_type = ($client instanceof ClientMaster) ? $client->client_type : 0;
            if ($model->load($this->request->post()) && $model->save()) {
                $title = $this->clientType == C::CLIENT_TYPE_CUSTOMER ? "Customer" : "Vendor";
                $redirectUrl = $this->clientType == C::CLIENT_TYPE_CUSTOMER ? "customer/view-customer" : "vendor/view-vendor";
                \Yii::$app->getSession()->setFlash('s', "Challan has been added successfully.");
                return $this->redirect([$redirectUrl, "id" => $id]);
            }
        }

        return $this->render('@app/views/challan/challan-form', [
            'model' => $model,
            "title" => $this->title
        ]);
    }


    /**
     * Creates a new ClientMaster model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     *
    public function actionEditChallan($id)
    {
        $model = new ChallanForm(['scenario' => ClientMaster::SCENARIO_CREATE]);

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
    }*/

     /**
     * Creates a new ClientMaster model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionPrintChallan($id)
    {
        $model = Challan::findOne(['id'=>$id]);
        
        return $this->render('@app/views/client/print-challan', [
            'model' => $model,
        ]);
    }
}
