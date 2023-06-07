<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\PlanAttributes;
use app\components\Constants as C;
use app\models\Challan;

$pendingChallanList = Challan::find()->with(['plan'])->where(['client_id' => $client->id, 'client_type' => $client->client_type])->andWhere("total>amount_paid")->asArray()->all();
?>

<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header">
                <div class="card-title">
                    Add Payments
                </div>
            </div>
            <div class="card-body">
                <?php $form = ActiveForm::begin(['id' => 'form-payment', 'options' => ['enctype' => 'mutipart/form-data', 'class' => 'form-horizontal form-bordered']]); ?>

                <?= $form->field($model, 'payment_date', ['options' => ['class' => 'form-group']])->begin() ?>
                <?= Html::activeLabel($model, 'payment_date', ['class' => 'col-lg-6 col-sm-6 col-xs-6 control-label']); ?>
                <div class="col-lg-6 col-sm-6 col-xs-6">
                    <?= Html::activeTextInput($model, 'payment_date', ['class' => 'form-control cal']) ?>
                    <?= Html::error($model, 'payment_date', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'payment_date')->end() ?>

                <?= $form->field($model, 'amount_paid', ['options' => ['class' => 'form-group']])->begin() ?>
                <?= Html::activeLabel($model, 'amount_paid', ['class' => 'col-lg-6 col-sm-6 col-xs-6 control-label']); ?>
                <div class="col-lg-6 col-sm-6 col-xs-6">
                    <?= Html::activeTextInput($model, 'amount_paid', ['class' => 'form-control']) ?>
                    <?= Html::error($model, 'amount_paid', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'amount_paid')->end() ?>


                <?= $form->field($model, 'payment_mode', ['options' => ['class' => 'form-group']])->begin() ?>
                <?= Html::activeLabel($model, 'payment_mode', ['class' => 'col-lg-6 col-sm-6 col-xs-6 control-label']); ?>
                <div class="col-lg-6 col-sm-6 col-xs-6">
                    <?= Html::activeDropDownList($model, 'payment_mode', C::PAYMENT_MODE_LIST, ['class' => 'form-control', "prompt" => "Select One", "id" => "payment_modes"]) ?>
                    <?= Html::error($model, 'payment_mode', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'payment_mode')->end() ?>

                <div class="row" id="extra_flds">
                    <div class="col-lg-6 col-sm-6 col-xs-6">
                        <?= $form->field($model, 'intrument_no', ['options' => ['class' => "form-group"]])->begin(); ?>
                        <?= Html::activeLabel($model, 'intrument_no', ['class' => 'col-lg-6 col-sm-6 col-xs-6 control-label']) ?>
                        <div class="col-lg-6 col-sm-6 col-xs-6">
                            <?= Html::activeTextInput($model, 'intrument_no', ['class' => 'form-control']) ?>
                            <?= Html::error($model, 'intrument_no', ['class' => 'error help-block']) ?>
                        </div>
                        <?= $form->field($model, 'intrument_no')->end() ?>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-xs-6">
                        <?= $form->field($model, 'instrument_date', ['options' => ['class' => "form-group"]])->begin(); ?>
                        <?= Html::activeLabel($model, 'instrument_date', ['class' => 'col-lg-6 col-sm-6 col-xs-6 control-label']) ?>
                        <div class="col-lg-6 col-sm-6 col-xs-6">
                            <?= Html::activeTextInput($model, 'instrument_date', ['class' => 'form-control cal']) ?>
                            <?= Html::error($model, 'instrument_date', ['class' => 'error help-block']) ?>
                        </div>
                        <?= $form->field($model, 'instrument_date')->end() ?>
                    </div>
                </div>

                <?= $form->field($model, 'remark', ['options' => ['class' => "form-group"]])->begin(); ?>
                <?= Html::activeLabel($model, 'remark', ['class' => 'col-lg-6 col-sm-6 col-xs-6 control-label']) ?>
                <div class="col-lg-6 col-sm-6 col-xs-6">
                    <?= Html::activeTextarea($model, 'remark', ['class' => 'form-control']) ?>
                    <?= Html::error($model, 'remark', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'remark')->end() ?>

                <?php if (PAYMENT_METHOD == C::PAYMENT_INVOICEWISE) { ?>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Pending Challan List</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-responsive">
                                <thead>
                                    <tr>
                                        <th>Challan No</th>
                                        <th>Package</th>
                                        <th>Challan Amount</th>
                                        <th>Amount Paid</th>
                                        <th>Balance</th>
                                        <th>Deduction Amount</th>
                                        <th>Deduction Number</th>
                                        <th>TDS Amount</th>
                                        <th>TDS Number</th>
                                        <th>Payment</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($pendingChallanList as $pcl) { ?>
                                        <tr>
                                            <td><?= $pcl["challan_no"] ?></td>
                                            <td><?= $pcl["plan"]['name'] ?></td>
                                            <td><?= $pcl["total"] ?></td>
                                            <td><?= $pcl["amount_paid"] ?></td>
                                            <td><?= $pcl["total"] - $pcl['amount_paid'] ?></td>
                                            <td><?= Html::activeTextInput($model, 'challans[' . $pcl["id"] . '][deduction_amount]', ['class' => "form-control"]) ?></td>
                                            <td><?= Html::activeTextInput($model, 'challans[' . $pcl["id"] . '][deduction_number]', ['class' => "form-control"]) ?></td>
                                            <td><?= Html::activeTextInput($model, 'challans[' . $pcl["id"] . '][tds_amount]', ['class' => "form-control"]) ?></td>
                                            <td><?= Html::activeTextInput($model, 'challans[' . $pcl["id"] . '][tds_number]', ['class' => "form-control"]) ?></td>
                                            <td><?= Html::activeTextInput($model, 'challans[' . $pcl["id"] . '][amount_paid]', ['class' => "form-control"]) ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php } ?>
                <div class="card-footer mg-t-auto">
                    <div class="row">
                        <div class="col-lg-6 col-sm-6 col-xs-6 col-sm-offset-3">
                            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-secondary']) ?>
                        </div>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>


<?php
$payment_mode = !empty($model->payment_mode )?$model->payment_mode :C::PAYMENT_MODE_CASH;
$js = '
if(' . $payment_mode . '=="' . C::PAYMENT_MODE_CASH . '"){
    $("#extra_flds").hide();
}else{
    $("#extra_flds").show();
}


$("#payment_modes").on("change",function(){
    if(this.value!=="' . C::PAYMENT_MODE_CASH . '"){
        $("#extra_flds").show();
    }else{
        $("#extra_flds").hide();
    }
});
';

$this->registerJs($js, $this::POS_READY);
?>