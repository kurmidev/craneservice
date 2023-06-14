<?php

use yii\helpers\Html;
use app\components\Constants as C;

?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                    </div>
                    <h3 class="profile-username text-center">
                        <?= $model->company_name ?>(Total Outstanding : <b><?= CURRENCY_SYMBOL ?> <?= $balance ?></b>)
                    </h3>
                    <div class="row">
                        <div class="col-6">
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
                            </ul>
                        </div>
                        <div class="col-6">
                            <ul  class="list-group list-group-unbordered mb-3">
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
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header p-2">
                    
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
                            <?php if ($model->client_type == C::CLIENT_TYPE_CUSTOMER) { ?>
                                <?= Html::a("Credit Notes", Yii::$app->urlManager->createUrl([$baseUrl, "pg" => 'credit_notes', "id" => $model->id]), ["class" => "nav-link " . ($pg == "credit_notes" ? "active" : "")]) ?>
                            <?php } else { ?>
                                <?= Html::a("Debit Notes", Yii::$app->urlManager->createUrl([$baseUrl, "pg" => 'credit_notes', "id" => $model->id]), ["class" => "nav-link " . ($pg == "credit_notes" ? "active" : "")]) ?>
                            <?php  } ?>
                        </li>
                        <li class="nav-item">
                            <?= Html::a("Quotation", Yii::$app->urlManager->createUrl([$baseUrl, "pg" => 'quotation', "id" => $model->id]), ["class" => "nav-link " . ($pg == "quotation" ? "active" : "")]) ?>
                        </li>
                        <li class="nav-item">
                            <?= Html::a("Logs", Yii::$app->urlManager->createUrl([$baseUrl, "pg" => 'logs', "id" => $model->id]), ["class" => "nav-link " . ($pg == "logs" ? "active" : "")]) ?>
                        </li>
                        <?php if ($model->client_type == C::CLIENT_TYPE_CUSTOMER) { ?>
                            <li class="nav-item">
                                <?= Html::a("Shipping Address", Yii::$app->urlManager->createUrl([$baseUrl, "pg" => 'add-site', "id" => $model->id]), ["class" => "nav-link " . ($pg == "add-site" ? "active" : "")]) ?>
                            </li>
                            <li class="nav-item">
                                <?= Html::a("Custom Price", Yii::$app->urlManager->createUrl([$baseUrl, "pg" => 'custom-price', "id" => $model->id]), ["class" => "nav-link " . ($pg == "custom-price" ? "active" : "")]) ?>
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
                                "base_controller" => $base_controller
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
                                "base_controller" => $base_controller
                            ]) ?>
                        <?php } else if (in_array($pg, ["payment"])) { ?>
                            <?= $this->render("@app/views/payments/payment", [
                                'searchModel' => $paymentSearchModel,
                                'dataProvider' => $paymentDataProvider,
                                "model" => $model,
                                "detailUrl" => $viewPaymentDetails,
                                "base_controller" => $base_controller
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
                                'searchModel' => $quotesSearchModel,
                                'dataProvider' => $quotesDataProvider,
                                "model" => $model,
                                "addUrl" => $quoteaddUrl,
                                "editUrl" => $quoteEditUrl,
                                "printUrl" => $quotePrint
                            ]) ?>
                        <?php } else if (in_array($pg, ["custom-price"])) { ?>
                            <?= $this->render("@app/views/client/custom-price", [
                                'searchModel' => $customPriceSearchModel,
                                'dataProvider' => $customPriceDataProvider,
                                "model" => $model,
                                "base_controller" => $base_controller
                            ]) ?>
                        <?php } else if (in_array($pg, ["logs"])) {  ?>
                            <?= $this->render("@app/views/client/logs", [
                                'searchModel' => $logSearchModel,
                                'dataProvider' => $logDataProvider,
                                "model" => $model,
                                "base_controller" => $base_controller
                            ]) ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>