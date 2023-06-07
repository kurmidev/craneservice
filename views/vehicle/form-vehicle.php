<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\components\Constants as C;
use app\models\VehicleMaster;

$documentValues = !empty($model->documents)?ArrayHelper::index($model->documents,'document_type'):[];

?>
<?php $form = ActiveForm::begin(['id' => 'form-plan', 'options' => ['enctype' => 'multipart/form-data', 'class' => 'form-bordered']]); ?>
<div class="row">
    <div class="col-md-6">
        <div class="card ">
            <div class="card-header">
                <div class="card-title">
                    Vehicle Details
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

                <?= $form->field($model, 'vehicle_no', ['options' => ['class' => 'form-group']])->begin() ?>
                <?= Html::activeLabel($model, 'vehicle_no', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                <div class="col-lg-6 col-sm-6 col-xs-6">
                    <?= Html::activeTextInput($model, 'vehicle_no', ['class' => 'form-control']) ?>
                    <?= Html::error($model, 'vehicle_no', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'vehicle_no')->end() ?>


                <?= $form->field($model, 'book_no', ['options' => ['class' => 'form-group']])->begin() ?>
                <?= Html::activeLabel($model, 'book_no', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                <div class="col-lg-6 col-sm-6 col-xs-6">
                    <?= Html::activeTextInput($model, 'book_no', ['class' => 'form-control']) ?>
                    <?= Html::error($model, 'book_no', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'book_no')->end() ?>


                <?= $form->field($model, 'start_date', ['options' => ['class' => 'form-group']])->begin() ?>
                <?= Html::activeLabel($model, 'start_date', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                <div class="col-lg-6 col-sm-6 col-xs-6">
                    <?= Html::activeTextInput($model, 'start_date', ['class' => 'form-control cal',"readonly"=>true]) ?>
                    <?= Html::error($model, 'start_date', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'start_date')->end() ?>


                <?= $form->field($model, 'end_date', ['options' => ['class' => 'form-group']])->begin() ?>
                <?= Html::activeLabel($model, 'end_date', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                <div class="col-lg-6 col-sm-6 col-xs-6">
                    <?= Html::activeTextInput($model, 'end_date', ['class' => 'form-control cal',"readonly"=>true]) ?>
                    <?= Html::error($model, 'end_date', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'end_date')->end() ?>


                <?= $form->field($model, 'vehicle_type', ['options' => ['class' => 'form-group']])->begin() ?>
                <?= Html::activeLabel($model, 'vehicle_type', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                <div class="col-lg-6 col-sm-6 col-xs-6">
                    <?= Html::activeTextInput($model, 'vehicle_type', ['class' => 'form-control']) ?>
                    <?= Html::error($model, 'vehicle_type', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'vehicle_type')->end() ?>

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
                    Vehicle Maintenance
                </div>
            </div>
            <div class="card-body">
            
                <?php foreach (VehicleMaster::$maintenance as $key => $label) { ?>
                    <?php
                        $doc = !empty($documentValues[$key])?$documentValues[$key]:[];
                    ?>
                    <?= $form->field($model, $key, ['options' => ['class' => 'form-group']])->begin() ?>
                    <?= Html::activeLabel($model, 'name', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label', "label" => $label]); ?>
                    <div class="row">
                        <div class="col-lg-6 col-sm-6 col-xs-6">
                            <?= Html::activeTextInput($model, 'maintenance_data[' . $key . '][value]', ['class' => 'form-control',"value"=>!empty($doc)?$doc['other_details']:""]) ?>
                            <?= Html::error($model, 'maintenance_data[' . $key . '][value]', ['class' => 'error help-block']) ?>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-xs-6">
                            <?= Html::activeFileInput($model, 'maintenance_data[' . $key . '][doc]', ['class' => 'form-control']) ?>
                            <?= Html::error($model, 'maintenance_data[' . $key . '][doc]', ['class' => 'error help-block']) ?>
                        </div>
                    </div>
                    <?= $form->field($model, $key)->end() ?>
                <?php }  ?>

            </div>
        </div>
    </div>


    <div class="card-footer mg-t-auto mg-d-10">
        <div class="row">
            <div class="col-lg-6 col-sm-6 col-xs-6 col-sm-offset-3">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-secondary']) ?>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>