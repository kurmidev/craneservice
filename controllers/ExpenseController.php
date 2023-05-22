<?php

namespace app\controllers;

use Yii;
use app\forms\ExpenseForm;
use app\models\ExpenseCategory;
use app\models\ExpenseCategorySearch;
use app\models\ExpenseMaster;
use app\models\ExpenseMasterSearch;
use yii\web\NotFoundHttpException;
use app\components\Constants as C;
use app\components\ConstFunc as F;

/**
 * ExpenseController implements the CRUD actions for ExpenseCategory model.
 */
class ExpenseController extends BaseController
{

    /**
     * Lists all ExpenseCategory models.
     *
     * @return string
     */
    public function actionCategory()
    {
        $searchModel = new ExpenseCategorySearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('category', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Creates a new VehicleMaster model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionAddCategory()
    {
        $model = new ExpenseCategory(["scenario" => ExpenseCategory::SCENARIO_CREATE]);
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                \Yii::$app->getSession()->setFlash('s', "Category $model->name added successfully.");
                return $this->redirect(['expense/category']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('form-category', [
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
    public function actionEditCategory($id)
    {
        $model = $this->findModel($id);
        $model->scenario = ExpenseCategory::SCENARIO_UPDATE;

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            \Yii::$app->getSession()->setFlash('s', "Expense $model->name updated successfully.");
            return $this->redirect(['expense/category']);
        }

        return $this->render('form-category', [
            'model' => $model,
        ]);
    }



    /**
     * Lists all ExpenseCategory models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ExpenseMasterSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->query->andWhere(['expense_type'=> C::EXPENSE_TYPE_NORMAL]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            "type"=> C::EXPENSE_TYPE_NORMAL
        ]);
    }

    /**
     * Creates a new ExpenseCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionAddExpenses()
    {
        $model = new ExpenseForm(['scenario' => ExpenseMaster::SCENARIO_CREATE]);
        $model->expense_type = C::EXPENSE_TYPE_NORMAL;
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->validate() && $model->save()) {
                Yii::$app->getSession()->setFlash('s', "Expense has been added successfully.");
                return $this->redirect(['expense/index']);
            } 
        }
        return $this->render('@app/views/expense/form-expense', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ExpenseCategory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionEditExpenses($id)
    {
        $expense = ExpenseMaster::findOne(['id' => $id,'expense_type'=>C::EXPENSE_TYPE_NORMAL]);
        if (!$expense instanceof ExpenseMaster) {
            Yii::$app->getSession()->setFlash('e', "Record not found!");
            return $this->redirect(["expense/index"]);
        }
        $model = new ExpenseForm(['scenario'=>ExpenseMaster::SCENARIO_UPDATE]);
        $model->id = $expense->id;
        $model->expense_type = $expense->id;
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->validate() && $model->save()) {
                Yii::$app->getSession()->setFlash('s', "Expense been updated successfully.");
                return $this->redirect(["expense/index"]);
            }
        }else if(empty($model->errors)) {
            $model->load($expense->attributes,'');
        }
        return $this->render('@app/views/expense/form-expense', [
            'model' => $model,
            'expense'=> $expense
        ]);
    }

    /**
     * Lists all ExpenseCategory models.
     *
     * @return string
     */
    public function actionStaffExpenses()
    {
        $searchModel = new ExpenseMasterSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->query->andWhere(['expense_type'=> C::EXPENSE_TYPE_STAFF]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            "type"=> C::EXPENSE_TYPE_STAFF
        ]);
    }

    /**
     * Creates a new ExpenseCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionAddStaffexpenses()
    {
        $model = new ExpenseForm(['scenario' => ExpenseMaster::SCENARIO_CREATE]);
        $model->expense_type = C::EXPENSE_TYPE_STAFF;
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->validate() && $model->save()) {
                Yii::$app->getSession()->setFlash('s', "Expense has been added successfully.");
                return $this->redirect(['expense/staff-expenses']);
            } 
        }
        return $this->render('@app/views/expense/form-expense', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ExpenseCategory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionEditStaffexpenses($id)
    {
        $expense = ExpenseMaster::findOne(['id' => $id,'expense_type'=>C::EXPENSE_TYPE_STAFF]);
        if (!$expense instanceof ExpenseMaster) {
            Yii::$app->getSession()->setFlash('e', "Record not found!");
            return $this->redirect(["expense/index"]);
        }
        $model = new ExpenseForm(['scenario'=>ExpenseMaster::SCENARIO_UPDATE]);
        $model->id = $expense->id;
        $model->expense_type = $expense->id;
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->validate() && $model->save()) {
                Yii::$app->getSession()->setFlash('s', "Expense been updated successfully.");
                return $this->redirect(["expense/staff-expenses"]);
            }
        }else if(empty($model->errors)) {
            $model->load($expense->attributes,'');
        }
        return $this->render('@app/views/expense/form-expense', [
            'model' => $model,
            'expense'=> $expense
        ]);
    }

    public function actionPrintExpense($id){
        $this->layout = false;
        $model = ExpenseMaster::findOne(['id' => $id]);
        $filename = "voucher_{$model->voucher_no}.pdf";
        $content = $this->render('print-receipt', [
            'model' => $model
        ]);

        return F::printPdf($content, $filename);
    }

    public function actionVehicleExpenses()
    {
    }

    /**
     * Finds the ExpenseCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return ExpenseCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ExpenseCategory::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
