<?php

namespace app\controllers;

use app\models\CompanyMaster;
use app\models\CompanyMasterSearch;
use app\controllers\BaseController;
use app\forms\CompanyForm;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CompanyController implements the CRUD actions for CompanyMaster model.
 */
class CompanyController extends BaseController
{
   
    /**
     * Lists all CompanyMaster models.
     *
     * @return string
     */
    public function actionCompany()
    {
        $searchModel = new CompanyMasterSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CompanyMaster model.
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
     * Creates a new CompanyMaster model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionAddCompany()
    {
        $model = new CompanyForm(['scenario'=>CompanyMaster::SCENARIO_CREATE]);

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                \Yii::$app->getSession()->setFlash('s', "Company $model->name added successfully.");
                return $this->redirect(['company']);
            }
        }

        return $this->render('form-company', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing CompanyMaster model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionEditCompany($id)
    {
        $company = CompanyMaster::findOne(['id' => $id]);
        if (!$company instanceof CompanyMaster) {
            \Yii::$app->getSession()->setFlash('e', 'Record not found');
            return $this->redirect(['company']);
            exit();
        }

        $model = new CompanyForm(['scenario' => CompanyMaster::SCENARIO_UPDATE]);
        $model->load($company->attributes, '');
        $model->banks = $company->banks;
        $model->prefix_data = $company->prefixData;
        $model->kyc_details = !empty($company->documents) ? ArrayHelper::index($company->documents, 'document_type') : [];
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            \Yii::$app->getSession()->setFlash('s', $model->message);
            return $this->redirect(['company']);
        }

        return $this->render('form-company', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing CompanyMaster model.
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
     * Finds the CompanyMaster model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return CompanyMaster the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CompanyMaster::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
