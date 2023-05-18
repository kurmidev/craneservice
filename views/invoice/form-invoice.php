<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\components\Constants as C;

?>
<?php $form = ActiveForm::begin(['id' => 'form-client', 'options' => ['enctype' => 'multipart/form-data', 'class' => 'form-bordered', 'enableAjaxValidation' => true]]); ?>
<div class="row">
    <div class="col-lg-12 col-sm-12 col-xs-12">
        <div class="card card-secondary">
            <div class="card-header">
                <div class="card-title">
                    Add Challan
                </div>
            </div>
            <div class="card-body">
                <?= $form->field($model, 'invoice_date', ['options' => ['class' => 'form-group']])->begin() ?>
                <?= Html::activeLabel($model, 'invoice_date', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                <div class="col-lg-6 col-sm-6 col-xs-6">
                    <?= Html::activeTextInput($model, 'invoice_date', ['class' => 'form-control cal']) ?>
                    <?= Html::error($model, 'invoice_date', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'invoice_date')->end() ?>

                <?= $form->field($model, 'invoice_type', ['options' => ['class' => 'form-group']])->begin() ?>
                <?= Html::activeLabel($model, 'invoice_type', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                <div class="col-lg-6 col-sm-6 col-xs-6">
                    <?= Html::activeDropDownList($model, 'invoice_type', C::INVOICE_TYPE_LIST, ['class' => 'form-control', 'prompt' => "Select One"]) ?>
                    <?= Html::error($model, 'invoice_type', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'invoice_type')->end() ?>

                <?= $form->field($model, 'work_order_no', ['options' => ['class' => 'form-group']])->begin() ?>
                <?= Html::activeLabel($model, 'work_order_no', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                <div class="col-lg-6 col-sm-6 col-xs-6">
                    <?= Html::activeTextInput($model, 'work_order_no', ['class' => 'form-control']) ?>
                    <?= Html::error($model, 'work_order_no', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'work_order_no')->end() ?>


                <?= $form->field($model, 'vendor_no', ['options' => ['class' => 'form-group']])->begin() ?>
                <?= Html::activeLabel($model, 'vendor_no', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                <div class="col-lg-6 col-sm-6 col-xs-6">
                    <?= Html::activeTextInput($model, 'vendor_no', ['class' => 'form-control']) ?>
                    <?= Html::error($model, 'vendor_no', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'vendor_no')->end() ?>

                <?= $form->field($model, 'is_tax_applicable', ['options' => ['class' => 'form-group']])->begin() ?>
                <?= Html::activeLabel($model, 'is_tax_applicable', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                <div class="col-lg-6 col-sm-6 col-xs-6">
                    <?= Html::activeDropDownList($model, 'is_tax_applicable', C::IS_YES_NO, ['class' => 'form-control', 'prompt' => "Select One"]) ?>
                    <?= Html::error($model, 'is_tax_applicable', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'is_tax_applicable')->end() ?>

                <?= $form->field($model, 'remark', ['options' => ['class' => 'form-group']])->begin() ?>
                <?= Html::activeLabel($model, 'remark', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                <div class="col-lg-6 col-sm-6 col-xs-6">
                    <?= Html::activeTextarea($model, 'remark', ['class' => 'form-control']) ?>
                    <?= Html::error($model, 'remark', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'remark')->end() ?>


            </div>
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-xs-12">
        <div class="card card-secondary">
            <div class="card-header">
                <div class="card-title">
                    ADD Challan
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Challan No.</th>
                            <th>Date</th>
                            <th>Particulars</th>
                            <th>DC/No</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Hour</th>
                            <th>Base Amount</th>
                            <th>Total Amount</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($challan_list as $challan) { ?>
                            <tr>
                                <td><?= $challan["challan_no"] ?></td>
                                <td><?= $challan["challan_date"] ?></td>
                                <td><?= $challan["plan"]["name"] ?></td>
                                <td><?= $challan["id"] ?></td>
                                <td><?= $challan['plan_start_time']!="00:00:00"? $challan["plan_start_time"]:(!empty($challan['day_wise'])?$challan['day_wise']:(!empty($challan['plan_trip'])?$challan['plan_trip']:$challan['from_destination']) )?></td>
                                <td><?= $challan['plan_end_time']!="00:00:00"? $challan["plan_end_time"]:(!empty($challan['plan_measure'])?$challan['plan_measure']:$challan['to_destination'])?></td>
                                <td><?= !empty($challan['plan_start_time'])   ? date("H:i", (strtotime($challan['plan_start_time']) - strtotime($challan['plan_end_time']))) : $challan['plan_measure'] ?></td>
                                <td><?= $challan["amount"] ?></td>
                                <td><?= $challan["total"] ?></td>
                                <td>
                                    <div class="p-10">
                                        <?= Html::activeCheckbox($model, 'challan_ids[' . $challan['id'] . ']', ["class" => "form-check-input", "label" => false]) ?>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card-footer mg-t-auto mg-d-10">
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-xs-12 col-sm-offset-3">
                <?= Html::submitButton(empty($model->id) ? 'Create' : 'Update', ['class' => 'btn btn-secondary']) ?>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
