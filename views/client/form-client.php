<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\components\Constants as C;
use app\models\City;
use app\models\CompanyMaster;


?>
<?php $form = ActiveForm::begin(['id' => 'form-client', 'options' => ['enctype' => 'multipart/form-data', 'class' => 'form-bordered']]); ?>
<div class="row">
    <div class="col-lg-6 col-sm-6 col-xs-6">
        <div class="card ">
            <div class="card-header">
                <div class="card-title">
                    Personal Details
                </div>
            </div>
            <div class="card-body">
                <?= $form->field($model, 'company_id', ['options' => ['class' => 'form-group']])->begin() ?>
                <?= Html::activeLabel($model, 'company_id', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                <div class="col-lg-12 col-sm-12 col-xs-12">
                    <?= Html::activeDropDownList($model, 'company_id', ArrayHelper::map(CompanyMaster::find()->active()->all(), 'id', 'name'), ['class' => 'form-control','prompt'=>"Select one"]) ?>
                    <?= Html::error($model, 'company_id', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'name')->end() ?>

                <?= $form->field($model, 'type', ['options' => ['class' => 'form-group']])->begin() ?>
                <?= Html::activeLabel($model, 'type', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                <div class="col-lg-12 col-sm-12 col-xs-12">
                    <?= Html::activeDropDownList($model, 'type', C::CLIENT_IS_LABEL, ['class' => 'form-control','prompt'=>"Select one"]) ?>
                    <?= Html::error($model, 'type', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'type')->end() ?>

                <?= $form->field($model, 'company_name', ['options' => ['class' => 'form-group']])->begin() ?>
                <?= Html::activeLabel($model, 'company_name', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                <div class="col-lg-12 col-sm-12 col-xs-12">
                    <?= Html::activeTextInput($model, 'company_name', ['class' => 'form-control']) ?>
                    <?= Html::error($model, 'company_name', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'company_name')->end() ?>


                <?= $form->field($model, 'first_name', ['options' => ['class' => 'form-group']])->begin() ?>
                <?= Html::activeLabel($model, 'first_name', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                <div class="col-lg-12 col-sm-12 col-xs-12">
                    <?= Html::activeTextInput($model, 'first_name', ['class' => 'form-control']) ?>
                    <?= Html::error($model, 'first_name', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'first_name')->end() ?>


                <?= $form->field($model, 'last_name', ['options' => ['class' => 'form-group']])->begin() ?>
                <?= Html::activeLabel($model, 'last_name', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                <div class="col-lg-12 col-sm-12 col-xs-12">
                    <?= Html::activeTextInput($model, 'last_name', ['class' => 'form-control']) ?>
                    <?= Html::error($model, 'last_name', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'last_name')->end() ?>


                <?= $form->field($model, 'email', ['options' => ['class' => 'form-group']])->begin() ?>
                <?= Html::activeLabel($model, 'email', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                <div class="col-lg-12 col-sm-12 col-xs-12">
                    <?= Html::activeTextInput($model, 'email', ['class' => 'form-control']) ?>
                    <?= Html::error($model, 'email', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'email')->end() ?>


                <?= $form->field($model, 'mobile_no', ['options' => ['class' => 'form-group']])->begin() ?>
                <?= Html::activeLabel($model, 'mobile_no', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                <div class="col-lg-12 col-sm-12 col-xs-12">
                    <?= Html::activeTextInput($model, 'mobile_no', ['class' => 'form-control','maxlength'=>10,"minlength"=>10]) ?>
                    <?= Html::error($model, 'mobile_no', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'mobile_no')->end() ?>


                <?= $form->field($model, 'phone_no', ['options' => ['class' => 'form-group']])->begin() ?>
                <?= Html::activeLabel($model, 'phone_no', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                <div class="col-lg-12 col-sm-12 col-xs-12">
                    <?= Html::activeTextInput($model, 'phone_no', ['class' => 'form-control','maxlength'=>10,'minlength'=>10]) ?>
                    <?= Html::error($model, 'phone_no', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'phone_no')->end() ?>

                <?= $form->field($model, 'status', ['options' => ['class' => "form-group"]])->begin(); ?>
                <?= Html::activeLabel($model, 'status', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']) ?>
                <div class="col-lg-12 col-sm-12 col-xs-12">
                    <?= Html::activeDropDownList($model, 'status', C::LABEL_STATUS, ['class' => 'form-control', "prompt" => "Select One"]) ?>
                    <?= Html::error($model, 'status', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'status')->end() ?>
            </div>
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-xs-6">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    KYC Details
                </div>
            </div>
            <div class="card-body">

                <?php foreach (C::CLIENT_KYC_DETAILS as $key => $label) { ?>
                    <?php
                    $doc = !empty($model->kyc_details[$key]) ? $model->kyc_details[$key] : [];
                    ?>
                    <?= $form->field($model, $key, ['options' => ['class' => 'form-group']])->begin() ?>
                    <?= Html::activeLabel($model, 'name', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label', "label" => $label]); ?>
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-xs-12">
                            <?= Html::activeTextInput($model, 'kyc_details[' . $key . '][value]', ['class' => 'form-control', "onkeyup" => "this.value = this.value.toUpperCase();", "value" => !empty($doc) ? $doc['value'] : ""]) ?>
                            <?= Html::error($model, 'kyc_details[' . $key . '][value]', ['class' => 'error help-block']) ?>
                        </div>
                        <div class="col-lg-12 col-sm-12 col-xs-12">
                            <?= Html::activeFileInput($model, 'kyc_details[' . $key . '][doc]', ['class' => 'form-control']) ?>
                            <?= Html::error($model, 'kyc_details[' . $key . '][doc]', ['class' => 'error help-block']) ?>
                        </div>
                    </div>
                    <?= $form->field($model, $key)->end() ?>
                <?php }  ?>

            </div>
        </div>
    </div>


    <div class="col-lg-6 col-sm-6 col-xs-6">
        <div class="card ">
            <div class="card-header">
                <div class="card-title">
                    Billing Address
                </div>
            </div>
            <div class="card-body">
                <?= $form->field($model, 'address', ['options' => ['class' => 'form-group']])->begin() ?>
                <?= Html::activeLabel($model, 'address', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                <div class="col-lg-12 col-sm-12 col-xs-12">
                    <?= Html::activeTextarea($model, 'address', ['class' => 'form-control']) ?>
                    <?= Html::error($model, 'address', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'address')->end() ?>

                <?= $form->field($model, 'city_id', ['options' => ['class' => 'form-group']])->begin() ?>
                <?= Html::activeLabel($model, 'city_id', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                <div class="col-lg-12 col-sm-12 col-xs-12">
                    <?= Html::activeDropDownList($model, 'city_id', ArrayHelper::map(City::find()->active()->all(), 'id', 'name'), ['class' => 'form-control',"prompt"=>"Select one"]) ?>
                    <?= Html::error($model, 'city_id', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'city_id')->end() ?>

                <?= $form->field($model, 'pincode', ['options' => ['class' => 'form-group']])->begin() ?>
                <?= Html::activeLabel($model, 'pincode', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                <div class="col-lg-12 col-sm-12 col-xs-12">
                    <?= Html::activeTextInput($model, 'pincode', ['class' => 'form-control','maxlength'=>10]) ?>
                    <?= Html::error($model, 'pincode', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'pincode')->end() ?>

            </div>
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-xs-6">
        <div class="card ">
            <div class="card-header">
                <div class="card-title">
                    Shipping Address
                </div>
            </div>
            <div class="card-body">
                <?= $form->field($model, 'site_address', ['options' => ['class' => 'form-group']])->begin() ?>
                <?= Html::activeLabel($model, 'site_address', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                <div class="col-lg-12 col-sm-12 col-xs-12">
                    <?= Html::activeTextarea($model, 'site_address', ['class' => 'form-control']) ?>
                    <?= Html::error($model, 'site_address', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'site_address')->end() ?>

                <?= $form->field($model, 'site_city_id', ['options' => ['class' => 'form-group']])->begin() ?>
                <?= Html::activeLabel($model, 'site_city_id', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                <div class="col-lg-12 col-sm-12 col-xs-12">
                    <?= Html::activeDropDownList($model, 'site_city_id', ArrayHelper::map(City::find()->active()->all(), 'id', 'name'), ['class' => 'form-control',"prompt"=>"Select one"]) ?>
                    <?= Html::error($model, 'site_city_id', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'site_city_id')->end() ?>

                <?= $form->field($model, 'site_pincode', ['options' => ['class' => 'form-group']])->begin() ?>
                <?= Html::activeLabel($model, 'site_pincode', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                <div class="col-lg-12 col-sm-12 col-xs-12">
                    <?= Html::activeTextInput($model, 'site_pincode', ['class' => 'form-control','maxlength'=>10]) ?>
                    <?= Html::error($model, 'site_pincode', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'site_pincode')->end() ?>

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