<?php

namespace app\controllers;

use app\models\VehicleMaster;
use app\models\VehicleMasterSearch;
use app\controllers\BaseController;
use yii\web\NotFoundHttpException;

/**
 * VehicleController implements the CRUD actions for VehicleMaster model.
 */
class VehicleController extends BaseController
{

    /**
     * Lists all VehicleMaster models.
     *
     * @return string
     */
    public function actionVehicle()
    {
        $searchModel = new VehicleMasterSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single VehicleMaster model.
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
     * Creates a new VehicleMaster model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionAddVehicle()
    {
        $model = new VehicleMaster(["scenario"=>VehicleMaster::SCENARIO_CREATE]);
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                \Yii::$app->getSession()->setFlash('s', "Vehicle $model->name added successfully.");
                return $this->redirect(['vehicle']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('form-vehicle', [
            'model' => $model
        ]);
    }

    /**
     * Updates an existing VehicleMaster model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionEditVehicle($id)
    {
        $model = $this->findModel($id);
        $model->scenario = VehicleMaster::SCENARIO_UPDATE;
         
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            \Yii::$app->getSession()->setFlash('s', "Vehicle $model->name updated successfully.");
            return $this->redirect(['vehicle']);
        }else{
            print_r($model->errors);
        }

        return $this->render('form-vehicle', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing VehicleMaster model.
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
     * Finds the VehicleMaster model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return VehicleMaster the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = VehicleMaster::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
