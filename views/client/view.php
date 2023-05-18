<?php

use yii\helpers\Html;
use app\components\Constants as C;

?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                    </div>
                    <h3 class="profile-username text-center">
                        <?= $model->company_name ?>
                    </h3>
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Email: </b>
                            <?= $model->email ?>
                        </li>
                        <li class="list-group-item">
                            <b>Mobile No: </b>
                            <?= $model->mobile_no ?>
                        </li>
                        <li class="list-group-item">
                            <b>Phone No: </b>
                            <?= $model->phone_no ?>
                        </li>
                        <li class="list-group-item">
                            <b>Address: </b>
                            <?= $model->address ?>
                        </li>
                        <li class="list-group-item">
                            <b>GSTIN / UIN: </b>

                        </li>
                        <li class="list-group-item">
                            <b>PAN No: </b>

                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header p-2">
                    <strong> Total Outstanding : <b><?= CURRENCY_SYMBOL ?> <?= $balance ?></b></strong>
                </div>
                <div class="card-header p-2">

                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            <?= Html::a("Pending Challan", Yii::$app->urlManager->createUrl([$baseUrl, "pg" => 'pending-challan', "id" => $model->id]), ["class" => "nav-link  " . ($pg == "pending-challan" || $pg == "" ? "active" : "")]) ?>
                        </li>
                        <li class="nav-item">
                            <?= Html::a("Challan List", Yii::$app->urlManager->createUrl([$baseUrl, "pg" => 'challan-list', "id" => $model->id]), ["class" => "nav-link " . ($pg == "challan-list" ? "active" : "")]) ?>
                        </li>
                        <li class="nav-item">
                            <?= Html::a("Invoice", Yii::$app->urlManager->createUrl([$baseUrl, "pg" => 'pending-invoice', "id" => $model->id]), ["class" => "nav-link " . ($pg == "pending-invoice" ? "active" : "")]) ?>
                        </li>
                        <li class="nav-item">
                            <?= Html::a("Payment", Yii::$app->urlManager->createUrl([$baseUrl, "pg" => 'payment', "id" => $model->id]), ["class" => "nav-link " . ($pg == "payment" ? "active" : "")]) ?>
                        </li>
                        <li class="nav-item">
                            <?= Html::a("Credit Notes", Yii::$app->urlManager->createUrl([$baseUrl, "pg" => 'credit_notes', "id" => $model->id]), ["class" => "nav-link " . ($pg == "credit_notes" ? "active" : "")]) ?>
                        </li>
                        <li class="nav-item">
                            <?= Html::a("Quotation", Yii::$app->urlManager->createUrl([$baseUrl, "pg" => 'quotation', "id" => $model->id]), ["class" => "nav-link " . ($pg == "quotation" ? "active" : "")]) ?>
                        </li>
                        <li class="nav-item">
                            <?= Html::a("Logs", Yii::$app->urlManager->createUrl([$baseUrl, "pg" => 'logs', "id" => $model->id]), ["class" => "nav-link " . ($pg == "payment" ? "active" : "")]) ?>
                        </li>
                        <?php if ($model->client_type == C::CLIENT_TYPE_CUSTOMER) { ?>
                            <li class="nav-item">
                                <?= Html::a("Add Site", Yii::$app->urlManager->createUrl([$baseUrl, "pg" => 'add-site', "id" => $model->id]), ["class" => "nav-link " . ($pg == "add-site" ? "active" : "")]) ?>
                            </li>
                        <?php  } ?>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <?php if (in_array($pg, ["pending-challan", "challan-list", ""])) { ?>
                            <?= $this->render("@app/views/client/challan", [
                                'searchModel' => $searchModel,
                                'dataProvider' => $dataProvider,
                                "model" => $model,
                                "addUrl" => $challanAddUrl,
                                "editUrl" => $challanEditUrl,
                                "viewUrl" => $challanViewUrl,
                                "printUrl" => $challanPrintUrl
                            ]) ?>
                        <?php } else if ($pg == "add-site") { ?>
                            <?= $this->render("@app/views/client/site-address", [
                                'searchModel' => $siteSearchModel,
                                'dataProvider' => $siteDataProvider,
                                "model" => $model,
                            ]) ?>
                        <?php } else if (in_array($pg, ["pending-invoice", "invoice"])) {  ?>
                            <?= $this->render("@app/views/client/invoice", [
                                'searchModel' => $invoiceSearchModel,
                                'dataProvider' => $invoiceDataProvider,
                                "model" => $model,
                                "addUrl" => $invoiceAddUrl,
                                "editUrl" => $invoiceEditUrl,
                                "viewUrl" => $invoiceViewUrl,
                                "printUrl" => $invoicePrintUrl,
                                "payUrl" => $invoicePayUrl
                            ]) ?>
                        <?php } else if (in_array($pg, ["payment"])) { ?>
                            <?= $this->render("@app/views/payments/payment", [
                                'searchModel' => $paymentSearchModel,
                                'dataProvider' => $paymentDataProvider,
                                "model" => $model,
                                "detailUrl" => $viewPaymentDetails,
                                "printlUrl" => $printPayment
                            ]) ?>
                        <?php } else if (in_array($pg, ["credit_notes"])) { ?>
                            <?= $this->render("@app/views/payments/credit-notes", [
                                'searchModel' => $notesSearchModel,
                                'dataProvider' => $notesDataProvider,
                                "model" => $model,
                                "addUrl" => $noteAddUrl,
                                "editUrl" => $noteEditUrl,
                                "printUrl" => $notePrint
                            ]) ?>
                        <?php } else if (in_array($pg, ["quotation"])) { ?>
                            <?= $this->render("@app/views/payments/quotation", [
                                'searchModel' => $paymentSearchModel,
                                'dataProvider' => $paymentDataProvider,
                                "model" => $model,
                                "detailUrl" => $viewPaymentDetails,
                                "printUrl" => $notePrint
                            ]) ?>

                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>