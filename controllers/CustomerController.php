<?php

namespace app\controllers;

use app\components\Constants as C;
use app\models\ClientSite;

class CustomerController extends ClientController{


    public function __construct($id,$module)
    {
        $this->clientType = C::CLIENT_TYPE_CUSTOMER;
        $this->title = "Vendor";
        parent::__construct($id,$module);
    }
    public function actionAddCustomer(){
        return $this->actionCreate();
    }

    public function actionEditCustomer($id){
        return $this->actionUpdate($id);
    }

    public function actionViewCustomer($id){
        return $this->actionView($id);
    }

    public function actionAddSite($id){
        $model = new ClientSite(["scenario" => ClientSite::SCENARIO_CREATE]);

        if ($this->request->isPost) {
            $model->client_id = $id;
            if ($model->load($this->request->post()) && $model->save()) {
                \Yii::$app->getSession()->setFlash('s', "Site Address has been added successfully.");
                return $this->redirect(['customer/view-customer','id'=>$model->client_id]);
            }
        } 

        return $this->render('@app/views/client/form-site', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ClientSite model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionEditSite($id)
    {
        $model = ClientSite::findOne($id);
        if (!$model instanceof ClientSite) {
            \Yii::$app->getSession()->setFlash('e', 'Record not found');
            return $this->redirect(['customer']);
            exit();
        }

        $model->scenario = ClientSite::SCENARIO_UPDATE;
        $model->client_id = $id;
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            \Yii::$app->getSession()->setFlash('s', " Site Address has been updated successfully.");
            return $this->redirect(['customer/view-customer','id'=>$model->client_id]);
        }

        return $this->render('@app/views/client/form-site', [
            'model' => $model,
        ]);
    }
}