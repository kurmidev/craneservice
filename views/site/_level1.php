<?php

use yii\helpers\Html;
use app\components\Constants as C;

$baseModel = $model->client_type == C::CLIENT_TYPE_CUSTOMER ? "customer" : "vendor";
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-footer">
                <div class="row">
                    <div class="col-sm-2 col-2">
                        <div class="description-block border-right">
                            <h5 class="description-header"><?= Html::a($model->totalCustomer, Yii::$app->urlManager->createUrl(["customer/index"]), ["class" => "text-success"]) ?></h5>
                            <span class="description-text">CUSTOMER</span>
                        </div>
                    </div>

                    <div class="col-sm-2 col-2">
                        <div class="description-block border-right">
                            <h5 class="description-header">
                                <?= Html::a($model->totalInvoice, Yii::$app->urlManager->createUrl(["report/" . $baseModel . "-invoice"]), ["class" => "text-warning"]) ?>
                            </h5>
                            <span class="description-text">INVOICE</span>
                        </div>

                    </div>

                    <div class="col-sm-2 col-2">
                        <div class="description-block border-right">
                            <h5 class="description-header">
                                <?= Html::a($model->totalOutstanding, Yii::$app->urlManager->createUrl(["report/" . $baseModel . "-invoice", 'InvoiceMasterSearch[invoice_status]' => 1]), ["class" => "text-success"]) ?>
                            </h5>
                            <span class="description-text">OUTSTANDING</span>
                        </div>

                    </div>

                    <div class="col-sm-2 col-2">
                        <div class="description-block border-right">
                            <h5 class="description-header">
                                <?= Html::a($model->totalPaid, Yii::$app->urlManager->createUrl(["report/" . $baseModel . "-payment"]), ['class' => "text-danger"]) ?>
                            </h5>
                            <span class="description-text">PAID</span>
                        </div>
                    </div>
                    <div class="col-sm-2 col-2">
                        <div class="description-block border-right">
                            <h5 class="description-header">
                                <?= Html::a($model->totalChallan, Yii::$app->urlManager->createUrl("report/" . $baseModel . "-challan"), ['class' => "text-danger"]) ?>
                            </h5>
                            <span class="description-text">TOTAL CHALLAN</span>
                        </div>
                    </div>
                    <div class="col-sm-2 col-2">
                        <div class="description-block">
                            <h5 class="description-header">
                                <?= Html::a($model->pendingChallan, Yii::$app->urlManager->createUrl(["report/" . $baseModel . "-challan", "ChallanSearch[challan_status]" => 2])) ?>
                            </h5>
                            <span class="description-text">PENDING CHALLAN</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>