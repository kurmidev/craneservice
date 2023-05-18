<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\PlanAttributes;
use app\components\Constants as C;
use app\models\InvoiceMaster;

$list = InvoiceMaster::find()
    ->where(['client_id'=>$model->client_id])->asArray()->all()
?>

<div class="row">
    <div class="col-md-12">
        <div class="card card-secondary">
            <div class="card-header">
                <div class="card-title">
                
                </div>
            </div>
            <div class="card-body">
                <?php $form = ActiveForm::begin(['id' => 'form-payment-notes', 'options' => ['enctype' => 'mutipart/form-data', 'class' => 'form-horizontal form-bordered']]); ?>

                <?= $form->field($model, 'date', ['options' => ['class' => 'form-group']])->begin() ?>
                <?= Html::activeLabel($model, 'date', ['class' => 'col-lg-6 col-sm-6 col-xs-6 control-label']); ?>
                <div class="col-lg-6 col-sm-6 col-xs-6">
                    <?= Html::activeTextInput($model, 'date', ['class' => 'form-control cal']) ?>
                    <?= Html::error($model, 'date', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'date')->end() ?>

                <?= $form->field($model, 'invoice_id', ['options' => ['class' => 'form-group']])->begin() ?>
                <?= Html::activeLabel($model, 'invoice_id', ['class' => 'col-lg-6 col-sm-6 col-xs-6 control-label']); ?>
                <div class="col-lg-6 col-sm-6 col-xs-6">
                    <?= Html::activeDropDownList($model, 'invoice_id',ArrayHelper::map($list,'id','invoice_no'), ['class' => 'form-control','prompt'=>"select one"]) ?>
                    <?= Html::error($model, 'invoice_id', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'invoice_id')->end() ?>



                <?= $form->field($model, 'base_amount', ['options' => ['class' => 'form-group']])->begin() ?>
                <?= Html::activeLabel($model, 'base_amount', ['class' => 'col-lg-6 col-sm-6 col-xs-6 control-label']); ?>
                <div class="col-lg-6 col-sm-6 col-xs-6">
                    <?= Html::activeTextInput($model, 'base_amount', ['class' => 'form-control']) ?>
                    <?= Html::error($model, 'base_amount', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'base_amount')->end() ?>


                <?= $form->field($model, 'tax_applicable', ['options' => ['class' => 'form-group']])->begin() ?>
                <?= Html::activeLabel($model, 'tax_applicable', ['class' => 'col-lg-6 col-sm-6 col-xs-6 control-label']); ?>
                <div class="col-lg-6 col-sm-6 col-xs-6">
                    <?= Html::activeDropDownList($model, 'tax_applicable', C::PACKAGE_TAX, ['class' => 'form-control', "prompt" => "Select One","id"=>"payment_modes"]) ?>
                    <?= Html::error($model, 'tax_applicable', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'tax_applicable')->end() ?>
               
                <?= $form->field($model, 'remark', ['options' => ['class' => "form-group"]])->begin(); ?>
                <?= Html::activeLabel($model, 'remark', ['class' => 'col-lg-6 col-sm-6 col-xs-6 control-label']) ?>
                <div class="col-lg-6 col-sm-6 col-xs-6">
                    <?= Html::activeTextarea($model, 'remark',['class' => 'form-control']) ?>
                    <?= Html::error($model, 'remark', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'remark')->end() ?>

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