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
use app\forms\InvoiceForm;
use app\models\Challan;
use app\models\ChallanSearch;
use app\models\ClientSiteSearch;
use app\models\InvoiceMaster;
use app\models\InvoiceMasterSearch;
use Yii;
use app\components\ConstFunc as F;
use app\models\PaymentNotes;
use app\models\PaymentNotesSearch;
use app\models\Payments;
use app\models\PaymentsDetails;
use app\models\PaymentsDetailsSearch;
use app\models\PaymentSearch;

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
    public function actionView($id, $pg = "")
    {
        $pg = Yii::$app->request->get("pg");
        $title = $this->clientType == C::CLIENT_TYPE_CUSTOMER ? "Customer" : "Vendor";
        $baseUrl = $this->clientType == C::CLIENT_TYPE_CUSTOMER ? "customer/view-customer" : "vendor/view-vendor";
        $model = ClientMaster::findOne(['id' => $id]);
        if ($model instanceof ClientMaster) {
            $searchModel = new ChallanSearch();
            $dataProvider = $searchModel->search($this->request->queryParams);
            $dataProvider->query->andWhere(["client_id" => $model->id]);
            if ($pg == "pending-challan") {
                $dataProvider->query->andWhere(['is_processed' => C::STATUS_INACTIVE, 'invoice_id' => 0]);
            } else {
                $dataProvider->query->andWhere(['is_processed' => C::STATUS_ACTIVE])->andWhere(['>', 'invoice_id', 0]);
            }

            $siteSearchModel = new ClientSiteSearch();
            $siteDataProvider = $siteSearchModel->search($this->request->queryParams);
            $siteDataProvider->query->andWhere(["client_id" => $model->id]);


            $invoiceSearchModel = new InvoiceMasterSearch();
            $invoiceDataProvider = $invoiceSearchModel->search($this->request->queryParams);
            if ($pg == "pending-invoice") {
                $invoiceDataProvider->query->andWhere(["client_id" => $model->id, "status" => C::STATUS_INACTIVE]);
            } else {
                $invoiceDataProvider->query->andWhere(["client_id" => $model->id, "status" => C::STATUS_ACTIVE]);
            }

            $invoiceAmount = Challan::find()->where(['client_id' => $model->id, 'is_processed' => C::STATUS_ACTIVE])->andWhere([">", "invoice_id", 0])->active()->sum("total-amount_paid");


            $paymentSearchModel = new PaymentSearch();
            $paymentDataProvider = $paymentSearchModel->search($this->request->queryParams);
            $paymentDataProvider->query->andWhere(["client_id" => $model->id]);

            $notesSearchModel = new PaymentNotesSearch();
            $notesDataProvider = $notesSearchModel->search($this->request->queryParams);
            $notesDataProvider->query->andWhere(["client_id" => $model->id]);




            return $this->render('@app/views/client/view', [
                'model' => $model,
                "title" => $this->title,
                "balance" => $invoiceAmount,
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
                "siteDataProvider" => $siteDataProvider,
                "siteSearchModel" => $siteSearchModel,
                "invoiceDataProvider" => $invoiceDataProvider,
                "invoiceSearchModel" => $invoiceSearchModel,
                "paymentDataProvider" => $paymentDataProvider,
                "paymentSearchModel" => $paymentSearchModel,
                "notesDataProvider" => $notesDataProvider,
                "notesSearchModel" => $notesSearchModel,
                "invoiceAddUrl" => $this->clientType == C::CLIENT_TYPE_CUSTOMER ?   "customer/add-invoice" : "vendor/add-invoice",
                "invoiceEditUrl" => $this->clientType == C::CLIENT_TYPE_CUSTOMER ?  "customer/edit-invoice" : "vendor/edit-invoice",
                "invoiceViewUrl" => $this->clientType == C::CLIENT_TYPE_CUSTOMER ?  "customer/view-invoice" : "vendor/view-invoice",
                "invoicePrintUrl" => $this->clientType == C::CLIENT_TYPE_CUSTOMER ? "customer/print-invoice" : "vendor/print-invoice",
                "invoicePayUrl" => $this->clientType == C::CLIENT_TYPE_CUSTOMER ? "customer/pay-invoice" : "vendor/pay-invoice",
                "viewPaymentDetails" => $this->clientType == C::CLIENT_TYPE_CUSTOMER ? "customer/pay-details" : "vendor/pay-details",
                "printPayment" => $this->clientType == C::CLIENT_TYPE_CUSTOMER ? "customer/print-receipt" : "vendor/print-receipt",
                "noteAddUrl" => $this->clientType == C::CLIENT_TYPE_CUSTOMER ?   "customer/add-note" : "vendor/add-note",
                "noteEditUrl" => $this->clientType == C::CLIENT_TYPE_CUSTOMER ?  "customer/edit-note" : "vendor/edit-note",
                "notePrint" => $this->clientType == C::CLIENT_TYPE_CUSTOMER ? "customer/print-note" : "vendor/print-note",
            ]);
        }

        $redirectUrl = $this->clientType == C::CLIENT_TYPE_CUSTOMER ? "customer/index" : "vendor/index";
        return $this->redirect([$redirectUrl]);
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
        $model = Challan::findOne(['id' => $id]);

        return $this->render('@app/views/client/print-challan', [
            'model' => $model,
        ]);
    }

    public function actionAddInvoice($id)
    {
        $model = new InvoiceForm(['scenario' => InvoiceMaster::SCENARIO_CREATE]);
        $model->client_id = $id;
        $model->client_type = $this->clientType;
        $client = ClientMaster::findOne(['id' => $id]);
        if ($this->request->isPost) {
            $model->client_id = $id;
            $model->client_type = $this->clientType;
            if ($model->load($this->request->post()) && $model->save()) {
                $title = $this->clientType == C::CLIENT_TYPE_CUSTOMER ? "Customer" : "Vendor";
                $redirectUrl = $this->clientType == C::CLIENT_TYPE_CUSTOMER ? "customer/view-customer" : "vendor/view-vendor";
                \Yii::$app->getSession()->setFlash('s', "Invoice has been added successfully.");
                return $this->redirect([$redirectUrl, "id" => $id, "pg" => "pending-invoice"]);
            } else {
                echo "<pre>";
                print_r($model->errors);
                exit;
            }
        }
        $challanList  = Challan::find()->with(['plan'])->where(['client_id' => $id, 'invoice_id' => null, 'is_processed' => 0])->all();
        return $this->render('@app/views/invoice/form-invoice', [
            'model' => $model,
            "title" => $this->title,
            "challan_list" => $challanList
        ]);
    }

    /**
     * Creates a new ClientMaster model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionPrintInvoice($id)
    {
        $this->layout = false;
        $model = InvoiceMaster::find()->where(['invoice_master.id' => $id])->joinWith(['client'])->with(['challans'])->one();
        $filename = "invoice_{$model->invoice_no}.pdf";
        $content = $this->render('@app/views/client/print-invoice', [
            'model' => $model
        ]);

        return F::printPdf($content, $filename);
    }

    public function actionPayInvoice($id)
    {
        $client = ClientMaster::findOne(['id' => $id]);
        if (!$client instanceof ClientMaster) {
            $redirectUrl = $this->clientType == C::CLIENT_TYPE_CUSTOMER ? "customer" : "vendor";
            \Yii::$app->getSession()->setFlash('e', "Record not found!");
            return $this->redirect([$redirectUrl]);
        }
        $model = new Payments(['scenario' => Payments::SCENARIO_CREATE]);
        $model->client_id = $client->id;
        $model->client_type = $client->type;
        $model->status = C::STATUS_ACTIVE;
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->validate() && $model->save()) {
                $title = $this->clientType == C::CLIENT_TYPE_CUSTOMER ? "Customer" : "Vendor";
                $redirectUrl = $this->clientType == C::CLIENT_TYPE_CUSTOMER ? "customer/view-customer" : "vendor/view-vendor";
                \Yii::$app->getSession()->setFlash('s', "Invoice has been added successfully.");
                return $this->redirect([$redirectUrl, "id" => $id, "pg" => "payment"]);
            }
        }
        $invoiceAmount = InvoiceMaster::find()->where(['client_id' => $client->id, 'client_type' => $client->client_type])->active()->sum("total");
        $paymentDone = Payments::find()->where(['client_id' => $client->id, 'client_type' => $client->client_type])->active()->sum("amount_paid");
        $model->amount_paid = !empty($model->amount_paid) ? $model->amount_paid : ($invoiceAmount - $paymentDone);
        return $this->render('@app/views/payments/form-payment', [
            'model' => $model,
        ]);
    }

    public function actionPayDetails($id, $pay_id)
    {
        $model = Payments::findOne(['id' => $pay_id, 'client_id' => $id]);
        if ($model instanceof Payments) {
            $searchModel = new PaymentsDetailsSearch();
            $dataProvider = $searchModel->search($this->request->queryParams);

            if (!empty($id)) {
                $dataProvider->query->andWhere(['client_id' => $id]);
            }
            if (!empty($pay_id)) {
                $dataProvider->query->andWhere(['payment_id' => $pay_id]);
            }
            return $this->render('@app/views/payments/payment_details', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                "title" => $model->receipt_no,
                
            ]);
        }

        $redirectUrl = $this->clientType == C::CLIENT_TYPE_CUSTOMER ? "customer/index" : "vendor/index";
        \Yii::$app->getSession()->setFlash('e', "Record not found!");
        return $this->redirect([$redirectUrl]);
    }

    public function actionPrintReceipt($id)
    {
        $this->layout = false;
        $model = Payments::findOne(['id' => $id]);
        $filename = "invoice_{$model->receipt_no}.pdf";
         $content = $this->render('@app/views/payments/print-receipt', [
            'model' => $model
        ]);

        return F::printPdf($content, $filename);
    }

    public function actionAddNote($id)
    {
        $client = ClientMaster::findOne(['id' => $id]);
        if (!$client instanceof ClientMaster) {
            $redirectUrl = $this->clientType == C::CLIENT_TYPE_CUSTOMER ? "customer" : "vendor";
            \Yii::$app->getSession()->setFlash('e', "Record not found!");
            return $this->redirect([$redirectUrl]);
        }
        $model = new PaymentNotes(['scenario' => PaymentNotes::SCENARIO_CREATE]);
        $model->client_id = $client->id;
        $model->client_type = $client->type;
        $model->status = C::STATUS_ACTIVE;
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->validate() && $model->save()) {
                $title = $this->clientType == C::CLIENT_TYPE_CUSTOMER ? "Customer" : "Vendor";
                $redirectUrl = $this->clientType == C::CLIENT_TYPE_CUSTOMER ? "customer/view-customer" : "vendor/view-vendor";
                \Yii::$app->getSession()->setFlash('s', "Payment Notes has been added successfully.");
                return $this->redirect([$redirectUrl, "id" => $id, "pg" => "credit_notes"]);
            }else{
                print_r($model->errors);
                exit;
            }
        }
        return $this->render('@app/views/payments/form-creditnotes', [
            'model' => $model,
        ]);
    }

    public function actionEditNote($id,$note_id)
    {
        $client = ClientMaster::findOne(['id' => $id]);
        if (!$client instanceof ClientMaster) {
            $redirectUrl = $this->clientType == C::CLIENT_TYPE_CUSTOMER ? "customer" : "vendor";
            \Yii::$app->getSession()->setFlash('e', "Record not found!");
            return $this->redirect([$redirectUrl]);
        }
        $model = PaymentNotes::findOne(['id'=>$note_id]);
        $model->scenario = PaymentNotes::SCENARIO_UPDATE;
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->validate() && $model->save()) {
                $title = $this->clientType == C::CLIENT_TYPE_CUSTOMER ? "Customer" : "Vendor";
                $redirectUrl = $this->clientType == C::CLIENT_TYPE_CUSTOMER ? "customer/view-customer" : "vendor/view-vendor";
                \Yii::$app->getSession()->setFlash('s', "Payment Notes has been updated successfully.");
                return $this->redirect([$redirectUrl, "id" => $id, "pg" => "credit_notes"]);
            }
        }
        return $this->render('@app/views/payments/form-creditnotes', [
            'model' => $model,
        ]);
    }
}
