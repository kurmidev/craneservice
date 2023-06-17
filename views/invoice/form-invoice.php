<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\components\Constants as C;

?>
<?php $form = ActiveForm::begin(['id' => 'form-client', 'options' => ['enctype' => 'multipart/form-data', 'class' => 'form-bordered', 'enableAjaxValidation' => true]]); ?>
<div class="row">
    <div class="col-lg-12 col-sm-12 col-xs-12">
        <div class="card ">
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
                    <?= Html::activeDropDownList($model, 'invoice_type', C::INVOICE_TYPE_LIST, ['class' => 'form-control', 'prompt' => "Select One",'onchange'=>'(()=>{if($(this).val()==="2"){$(\'select[name^="InvoiceForm[is_tax_applicable]"] option[value=1]\').attr("selected","selected")}else{$(\'select[name^="InvoiceForm[is_tax_applicable]"] option[value="1"]\').attr("selected",null);$(\'select[name^="InvoiceForm[is_tax_applicable]"] option[value=0]\').attr("selected","selected");  } })()']) ?>
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
                    <?= Html::activeDropDownList($model, 'is_tax_applicable', C::IS_YES_NO, ['class' => 'form-control', "value" => (!empty($model->is_tax_applicable) ? 1 : 0)]) ?>
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
        <div class="card ">
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
                            <th>Rate</th>
                            <th>Total Amount</th>
                            <th>
                                <?= Html::checkbox("Select All", false, ["class" => "form-check-input", "onclick" => "$(':checkbox').each(function() { this.checked = !this.checked; });"]) ?>
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($challan_list as $challan) { ?>
                            <tr>
                                <td><?= $challan["challan_no"] ?></td>
                                <td><?= $challan["challan_date"] ?></td>
                                <td><?= $challan["plan"]["name"] ?></td>
                                <td><?= $challan["id"] ?></td>
                                <td><?= $challan['plan_start_time'] != "00:00:00" ? $challan["plan_start_time"] : (!empty($challan['day_wise']) ? $challan['day_wise'] : (!empty($challan['plan_trip']) ? $challan['plan_trip'] : $challan['from_destination'])) ?></td>
                                <td><?= $challan['plan_end_time'] != "00:00:00" ? $challan["plan_end_time"] : (!empty($challan['plan_measure']) ? $challan['plan_measure'] : $challan['to_destination']) ?></td>
                                <td><?= !empty($challan['plan_start_time'])   ? date("H:i", (strtotime($challan['plan_start_time']) - strtotime($challan['plan_end_time']))) : $challan['plan_measure'] ?></td>
                                <?php if (!$is_edit) { ?>
                                    <td><?= $challan["base_amount"] ?></td>
                                    <td><?= $challan["amount"] ?></td>
                                <?php } else { ?>
                                    <?php
                                    $onclickCallBack = "";
                                    if ($challan['plan']['type'] == C::PACKAGE_WISE_TRIP) {
                                        $onclickCallBack = '(function(){ $("#challan_amount_' . $challan['id'] . '").val(' . ($challan['plan_trip'] * $challan['plan_measure']) . ' * $("#challan_base_'.$challan['id'].'").val() );})()';
                                    } else if ($challan['plan']['type'] == C::PACKAGE_WISE_CHALLAN) {
                                        $totalMinutes = (strtotime($challan['plan_end_time']) - strtotime($challan['plan_start_time'])) / 60;
                                        $onclickCallBack = '(function(){ $("#challan_amount_' . $challan['id'] . '").val(($("#challan_base_'.$challan['id'].'").val()/60)*' . $totalMinutes . ');})()';
                                    } else {
                                        $onclickCallBack = '(function(){ $("#challan_amount_' . $challan['id'] . '").val($("#challan_base_'.$challan['id'].'").val());})()';
                                    }
                                    ?>
                                    <td><?= Html::activeTextInput($model, 'challan_amount[' . $challan['id'] . '][base_amount]', ["class" => "form-control", "value" => $challan["base_amount"],'onchange'=>$onclickCallBack,"id"=>"challan_base_".$challan['id']]) ?></td>
                                    <td><?= Html::activeTextInput($model, 'challan_amount[' . $challan['id'] . '][amount]', ["class" => "form-control", "value" => $challan["amount"], "id" => "challan_amount_".$challan['id']]) ?></td>
                                <?php }  ?>
                                <td>
                                    <div class="p-10">
                                        <?= Html::activeCheckbox($model, 'challan_ids[' . $challan['id'] . ']', ["class" => "form-check-input", "label" => false, 'checked' => (in_array($challan['id'], $challan_ids) ? true : false)]) ?>
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