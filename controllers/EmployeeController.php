<?php

namespace app\controllers;

use app\models\EmployeeMaster;
use app\models\EmployeeMasterSearch;
use app\controllers\BaseController;
use app\models\Department;
use app\models\DepartmentSearch;
use yii\web\NotFoundHttpException;


/**
 * EmployeeController implements the CRUD actions for EmployeeMaster model.
 */
class EmployeeController extends BaseController
{

    /**
     * Lists all EmployeeMaster models.
     *
     * @return string
     */
    public function actionEmployee()
    {
        $searchModel = new EmployeeMasterSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('employee', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new EmployeeMaster model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionAddEmployee()
    {
        $model = new EmployeeMaster(["scenario" => EmployeeMaster::SCENARIO_CREATE]);

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                \Yii::$app->getSession()->setFlash('s', "Employee {$model->name} has been added successfully.");
                return $this->redirect(['employee']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('form-employee', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing EmployeeMaster model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionEditEmployee($id)
    {
        $model = EmployeeMaster::findOne($id);
        if (!$model instanceof EmployeeMaster) {
            \Yii::$app->getSession()->setFlash('e', 'Record not found');
            return $this->redirect(['employee']);
            exit();
        }

        $model->scenario = EmployeeMaster::SCENARIO_UPDATE;
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            \Yii::$app->getSession()->setFlash('s', "Employee {$model->name} has been updated successfully.");
            return $this->redirect(['employee']);
        }

        return $this->render('form-employee', [
            'model' => $model,
        ]);
    }


    /**
     * Lists all DepartMaster models.
     *
     * @return string
     */
    public function actionDepartment()
    {
        $searchModel = new DepartmentSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('department', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Department model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionAddDepartment()
    {
        $model = new Department(['scenario' => Department::SCENARIO_CREATE]);

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                \Yii::$app->getSession()->setFlash('s', "Department $model->name added successfully.");
                return $this->redirect(['department']);
            }
        }

        return $this->render('form-department', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing EmployeeMaster model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionEditDepartment($id)
    {
        $model = Department::findOne($id);
        $model->scenario = Department::SCENARIO_UPDATE;
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            \Yii::$app->getSession()->setFlash('s', "Department $model->name updated successfully.");
            return $this->redirect(['department']);
        }

        return $this->render('form-department', [
            'model' => $model,
        ]);
    }
}
