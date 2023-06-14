<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\components\Constants as C;
use app\models\City;
use app\models\VehicleMaster;

?>
<?php $form = ActiveForm::begin(['id' => 'form-plan', 'options' => ['enctype' => 'multipart/form-data', 'class' => 'form-bordered']]); ?>
<div class="row">
    <div class="col-md-6">
        <div class="card ">
            <div class="card-header">
                <div class="card-title">
                    Personal Details
                </div>
            </div>
            <div class="card-body">
                <?= $form->field($model, 'name', ['options' => ['class' => 'form-group']])->begin() ?>
                <?= Html::activeLabel($model, 'name', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                <div class="col-lg-6 col-sm-6 col-xs-6">
                    <?= Html::activeTextInput($model, 'name', ['class' => 'form-control']) ?>
                    <?= Html::error($model, 'name', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'name')->end() ?>

                <?= $form->field($model, 'mobile_no', ['options' => ['class' => 'form-group']])->begin() ?>
                <?= Html::activeLabel($model, 'mobile_no', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                <div class="col-lg-6 col-sm-6 col-xs-6">
                    <?= Html::activeTextInput($model, 'mobile_no', ['class' => 'form-control']) ?>
                    <?= Html::error($model, 'mobile_no', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'mobile_no')->end() ?>


                <?= $form->field($model, 'phone_no', ['options' => ['class' => 'form-group']])->begin() ?>
                <?= Html::activeLabel($model, 'phone_no', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                <div class="col-lg-6 col-sm-6 col-xs-6">
                    <?= Html::activeTextInput($model, 'phone_no', ['class' => 'form-control']) ?>
                    <?= Html::error($model, 'phone_no', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'phone_no')->end() ?>


                <?= $form->field($model, 'email', ['options' => ['class' => 'form-group']])->begin() ?>
                <?= Html::activeLabel($model, 'email', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                <div class="col-lg-6 col-sm-6 col-xs-6">
                    <?= Html::activeTextInput($model, 'email', ['class' => 'form-control']) ?>
                    <?= Html::error($model, 'email', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'email')->end() ?>

                <?= $form->field($model, 'billing_address', ['options' => ['class' => 'form-group']])->begin() ?>
                <?= Html::activeLabel($model, 'billing_address', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                <div class="col-lg-6 col-sm-6 col-xs-6">
                    <?= Html::activeTextarea($model, 'billing_address', ['class' => 'form-control']) ?>
                    <?= Html::error($model, 'billing_address', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'billing_address')->end() ?>


                <?= $form->field($model, 'city_id', ['options' => ['class' => 'form-group']])->begin() ?>
                <?= Html::activeLabel($model, 'city_id', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                <div class="col-lg-6 col-sm-6 col-xs-6">
                    <?= Html::activeDropDownList($model, 'city_id', ArrayHelper::map(City::find()->active()->all(), 'id', 'name'), ['class' => 'form-control']) ?>
                    <?= Html::error($model, 'city_id', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'city_id')->end() ?>


                <?= $form->field($model, 'pincode', ['options' => ['class' => 'form-group']])->begin() ?>
                <?= Html::activeLabel($model, 'pincode', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                <div class="col-lg-6 col-sm-6 col-xs-6">
                    <?= Html::activeTextInput($model, 'pincode', ['class' => 'form-control']) ?>
                    <?= Html::error($model, 'pincode', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'pincode')->end() ?>

                <?= $form->field($model, 'status', ['options' => ['class' => "form-group"]])->begin(); ?>
                <?= Html::activeLabel($model, 'status', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']) ?>
                <div class="col-lg-6 col-sm-6 col-xs-6">
                    <?= Html::activeDropDownList($model, 'status', C::LABEL_STATUS, ['class' => 'form-control', "prompt" => "Select One"]) ?>
                    <?= Html::error($model, 'status', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'status')->end() ?>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card ">
            <div class="card-header">
                <div class="card-title">
                    KYC Details
                </div>
            </div>
            <div class="card-body">

                <?php foreach (C::KYC_DETAILS as $key => $label) { ?>
                    <?php
                    $doc = !empty($model->kyc_details[$key]) ? $model->kyc_details[$key] : [];
                    ?>
                    <?= $form->field($model, $key, ['options' => ['class' => 'form-group']])->begin() ?>
                    <?= Html::activeLabel($model, 'name', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label', "label" => $label]); ?>
                    <div class="row">
                        <div class="col-lg-6 col-sm-6 col-xs-6">
                            <?= Html::activeTextInput($model, 'kyc_details[' . $key . '][value]', ['class' => 'form-control', "value" => !empty($doc['other_details']) ? $doc['other_details'] : ""]) ?>
                            <?= Html::error($model, 'kyc_details[' . $key . '][value]', ['class' => 'error help-block']) ?>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-xs-6">
                            <?= Html::activeFileInput($model, 'kyc_details[' . $key . '][doc]', ['class' => 'form-control']) ?>
                            <?= Html::error($model, 'kyc_details[' . $key . '][doc]', ['class' => 'error help-block']) ?>
                        </div>
                    </div>
                    <?= $form->field($model, $key)->end() ?>
                <?php }  ?>

            </div>
        </div>
    </div>


    <div class="col-md-6">
        <div class="card ">
            <div class="card-header">
                <div class="card-title">
                    Other Details
                </div>
            </div>
            <div class="card-body">
                <?= $form->field($model, 'gst_in', ['options' => ['class' => 'form-group']])->begin() ?>
                <?= Html::activeLabel($model, 'gst_in', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                <div class="col-lg-6 col-sm-6 col-xs-6">
                    <?= Html::activeTextInput($model, 'gst_in', ['class' => 'form-control']) ?>
                    <?= Html::error($model, 'gst_in', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'gst_in')->end() ?>


                <?= $form->field($model, 'pan_no', ['options' => ['class' => 'form-group']])->begin() ?>
                <?= Html::activeLabel($model, 'pan_no', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                <div class="col-lg-6 col-sm-6 col-xs-6">
                    <?= Html::activeTextInput($model, 'pan_no', ['class' => 'form-control']) ?>
                    <?= Html::error($model, 'pan_no', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'pan_no')->end() ?>

                <?= $form->field($model, 'supply_place', ['options' => ['class' => 'form-group']])->begin() ?>
                <?= Html::activeLabel($model, 'supply_place', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                <div class="col-lg-6 col-sm-6 col-xs-6">
                    <?= Html::activeTextInput($model, 'supply_place', ['class' => 'form-control']) ?>
                    <?= Html::error($model, 'supply_place', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'supply_place')->end() ?>

                <?= $form->field($model, 'state_code', ['options' => ['class' => 'form-group']])->begin() ?>
                <?= Html::activeLabel($model, 'state_code', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                <div class="col-lg-6 col-sm-6 col-xs-6">
                    <?= Html::activeTextInput($model, 'state_code', ['class' => 'form-control']) ?>
                    <?= Html::error($model, 'state_code', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'state_code')->end() ?>

            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card ">
            <div class="card-header">
                <div class="card-title">
                    Bank Details
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card-title">
                            TAX Bank Details
                        </div>
                        <?= $form->field($model, 'banks[1][name]', ['options' => ['class' => 'form-group']])->begin() ?>
                        <?= Html::activeLabel($model, 'banks[1][name]', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label',"label"=>"Account Name"]); ?>
                        <div class="col-lg-12 col-sm-12 col-xs-12">
                            <?= Html::activeTextInput($model, 'banks[1][name]', ['class' => 'form-control']) ?>
                            <?= Html::error($model, 'banks[1][name]', ['class' => 'error help-block']) ?>
                        </div>
                        <?= $form->field($model, 'banks[1][name]')->end() ?>

                        <?= $form->field($model, 'banks[1][account_number]', ['options' => ['class' => 'form-group']])->begin() ?>
                        <?= Html::activeLabel($model, 'banks[1][account_number]', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label',"label"=>"Account Number"]); ?>
                        <div class="col-lg-12 col-sm-12 col-xs-12">
                            <?= Html::activeTextInput($model, 'banks[1][account_number]', ['class' => 'form-control']) ?>
                            <?= Html::error($model, 'banks[1][account_number]', ['class' => 'error help-block']) ?>
                        </div>
                        <?= $form->field($model, 'banks[1][account_number]')->end() ?>

                        <?= $form->field($model, 'banks[1][bank_name]', ['options' => ['class' => 'form-group']])->begin() ?>
                        <?= Html::activeLabel($model, 'banks[1][bank_name]', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label',"label"=>"Bank Name"]); ?>
                        <div class="col-lg-12 col-sm-12 col-xs-12">
                            <?= Html::activeTextInput($model, 'banks[1][bank_name]', ['class' => 'form-control']) ?>
                            <?= Html::error($model, 'banks[1][bank_name]', ['class' => 'error help-block']) ?>
                        </div>
                        <?= $form->field($model, 'banks[1][bank_name]')->end() ?>

                        <?= $form->field($model, 'banks[1][ifsc_code]', ['options' => ['class' => 'form-group']])->begin() ?>
                        <?= Html::activeLabel($model, 'banks[1][ifsc_code]', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label',"label"=>"IFSC Code"]); ?>
                        <div class="col-lg-12 col-sm-12 col-xs-12">
                            <?= Html::activeTextInput($model, 'banks[1][ifsc_code]', ['class' => 'form-control']) ?>
                            <?= Html::error($model, 'banks[1][ifsc_code]', ['class' => 'error help-block']) ?>
                        </div>
                        <?= $form->field($model, 'banks[1][ifsc_code]')->end() ?>

                    </div>
                    <div class="col-md-6">
                        <div class="card-title">
                            NON TAX Bank Details
                        </div>
                        <?= $form->field($model, 'banks[0][name]', ['options' => ['class' => 'form-group']])->begin() ?>
                        <?= Html::activeLabel($model, 'banks[0][name]', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label',"label"=>"Account Name"]); ?>
                        <div class="col-lg-12 col-sm-12 col-xs-12">
                            <?= Html::activeTextInput($model, 'banks[0][name]', ['class' => 'form-control']) ?>
                            <?= Html::error($model, 'banks[0][name]', ['class' => 'error help-block']) ?>
                        </div>
                        <?= $form->field($model, 'banks[0][name]')->end() ?>

                        <?= $form->field($model, 'banks[0][account_number]', ['options' => ['class' => 'form-group']])->begin() ?>
                        <?= Html::activeLabel($model, 'banks[0][account_number]', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label',"label"=>"Account Number"]); ?>
                        <div class="col-lg-12 col-sm-12 col-xs-12">
                            <?= Html::activeTextInput($model, 'banks[0][account_number]', ['class' => 'form-control']) ?>
                            <?= Html::error($model, 'banks[0][account_number]', ['class' => 'error help-block']) ?>
                        </div>
                        <?= $form->field($model, 'banks[0][account_number]')->end() ?>

                        <?= $form->field($model, 'banks[0][bank_name]', ['options' => ['class' => 'form-group']])->begin() ?>
                        <?= Html::activeLabel($model, 'banks[0][bank_name]', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label',"label"=>"Bank Name"]); ?>
                        <div class="col-lg-12 col-sm-12 col-xs-12">
                            <?= Html::activeTextInput($model, 'banks[0][bank_name]', ['class' => 'form-control']) ?>
                            <?= Html::error($model, 'banks[0][bank_name]', ['class' => 'error help-block']) ?>
                        </div>
                        <?= $form->field($model, 'banks[0][bank_name]')->end() ?>

                        <?= $form->field($model, 'banks[0][ifsc_code]', ['options' => ['class' => 'form-group']])->begin() ?>
                        <?= Html::activeLabel($model, 'banks[0][ifsc_code]', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label',"label"=>"IFSC Code"]); ?>
                        <div class="col-lg-12 col-sm-12 col-xs-12">
                            <?= Html::activeTextInput($model, 'banks[0][ifsc_code]', ['class' => 'form-control']) ?>
                            <?= Html::error($model, 'banks[0][ifsc_code]', ['class' => 'error help-block']) ?>
                        </div>
                        <?= $form->field($model, 'banks[0][ifsc_code]')->end() ?>

                    </div>
                </div>
            </div>
        </div>
    </div>



 
    <div class="card-footer mg-t-auto mg-d-10">
        <div class="row">
            <div class="col-lg-6 col-sm-6 col-xs-6 col-sm-offset-3">
                <?= Html::submitButton(empty($model->id) ? 'Create' : 'Update', ['class' => 'btn btn-secondary']) ?>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>