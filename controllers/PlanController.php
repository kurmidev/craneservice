<?php

namespace app\controllers;

use Yii;
use app\models\PlanMaster;
use app\models\PlanMasterSearch;
use app\models\PlanAttributes;
use app\models\PlanAttributesSearch;
use app\controllers\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PlanController implements the CRUD actions for PlanMaster model.
 */
class PlanController extends BaseController
{

    /**
     * Lists all PlanMaster models.
     *
     * @return string
     */
    public function actionPlan()
    {
        $searchModel = new PlanMasterSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PlanMaster model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => PlanMaster::findOne(['id'=>$id]),
        ]);
    }

    /**
     * Creates a new PlanMaster model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionAddPlan()
    {
        $model = new PlanMaster();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['plan']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('form-plan', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing PlanMaster model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionEditPlan($id)
    {
        $model = PlanMaster::findOne(['id'=>$id]);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            \Yii::$app->getSession()->setFlash('s', "Plan $model->name added successfully.");
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('form-plan', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing PlanMaster model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        //$this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionPlanAttributes()
    {
        $searchModel = new PlanAttributesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('plan-attribute', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

     /**
     * Creates a new PlanAttributes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionAddPlanAttributes() {
        $model = new PlanAttributes(['scenario' => PlanAttributes::SCENARIO_CREATE]);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->getSession()->setFlash('s', "Plan Attribute $model->name added successfully.");
            return $this->redirect(['plan-attributes']);
        }
        return $this->render('form-plan-attributes', [
                    'model' => $model,
        ]);
    }

      /**
     * Updates an existing Location model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionEditPlanAttributes($id) {
        $model = PlanAttributes::findOne($id);

        if (!$model instanceof PlanAttributes) {
            \Yii::$app->getSession()->setFlash('e', 'Record not found');
            return $this->redirect(['plan/plan-attributes']);
            exit();
        }

        $model->scenario = PlanAttributes::SCENARIO_UPDATE;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->getSession()->setFlash('s', "Plan Attribute $model->name updated successfully.");
            return $this->redirect(['plan-attributes']);
        }

        return $this->render('form-plan-attributes', [
                    'model' => $model,
        ]);
    }
}
