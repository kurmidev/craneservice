<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\PlanAttributes;
use app\components\Constants as C;
?>

<div class="row">
    <div class="col-md-12">
        <div class="card card-secondary">
            <div class="card-header">
                <div class="card-title">
                    <?=($model->isNewRecord ? "Add New Plan" : "Update {$model->name}")?>
                </div>
            </div>
            <div class="card-body">
                <?php $form = ActiveForm::begin(['id' => 'form-plan', 'options' => ['enctype' => 'mutipart/form-data', 'class' => 'form-horizontal form-bordered']]); ?>

                <?= $form->field($model, 'name', ['options' => ['class' => 'form-group']])->begin() ?>
                <?= Html::activeLabel($model, 'name', ['class' => 'col-lg-3 col-sm-3 col-xs-3 control-label']); ?>
                <div class="col-lg-6 col-sm-6 col-xs-6">
                    <?= Html::activeTextInput($model, 'name', ['class' => 'form-control']) ?>
                    <?= Html::error($model, 'name', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'name')->end() ?>

                <?= $form->field($model, 'code', ['options' => ['class' => 'form-group']])->begin() ?>
                <?= Html::activeLabel($model, 'code', ['class' => 'col-lg-3 col-sm-3 col-xs-3 control-label']); ?>
                <div class="col-lg-6 col-sm-6 col-xs-6">
                    <?= Html::activeTextInput($model, 'code', ['class' => 'form-control']) ?>
                    <?= Html::error($model, 'code', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'code')->end() ?>


                <?= $form->field($model, 'price', ['options' => ['class' => 'form-group']])->begin() ?>
                <?= Html::activeLabel($model, 'price', ['class' => 'col-lg-3 col-sm-3 col-xs-3 control-label']); ?>
                <div class="col-lg-6 col-sm-6 col-xs-6">
                    <?= Html::activeTextInput($model, 'price', ['class' => 'form-control']) ?>
                    <?= Html::error($model, 'price', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'price')->end() ?>

                <?= $form->field($model, 'attribute_id', ['options' => ['class' => "form-group"]])->begin(); ?>
                <?= Html::activeLabel($model, 'attribute_id', ['class' => 'col-lg-3 col-sm-3 col-xs-3 control-label']) ?>
                <div class="col-lg-6 col-sm-6 col-xs-6">
                    <?= Html::activeDropDownList($model, 'attribute_id', ArrayHelper::map(PlanAttributes::find()->active()->all(), 'id', 'name'), ['class' => 'form-control', "prompt" => "Select One"]) ?>
                    <?= Html::error($model, 'attribute_id', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'attribute_id')->end() ?>

                <?= $form->field($model, 'tax_slot', ['options' => ['class' => "form-group"]])->begin(); ?>
                <?= Html::activeLabel($model, 'tax_slot', ['class' => 'col-lg-3 col-sm-3 col-xs-3 control-label']) ?>
                <div class="col-lg-6 col-sm-6 col-xs-6">
                    <?= Html::activeDropDownList($model, 'tax_slot', C::PACKAGE_TAX, ['class' => 'form-control', "prompt" => "Select One"]) ?>
                    <?= Html::error($model, 'tax_slot', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'tax_slot')->end() ?>

                <?= $form->field($model, 'type', ['options' => ['class' => "form-group"]])->begin(); ?>
                <?= Html::activeLabel($model, 'type', ['class' => 'col-lg-3 col-sm-3 col-xs-3 control-label']) ?>
                <div class="col-lg-6 col-sm-6 col-xs-6">
                    <?= Html::activeDropDownList($model, 'type', C::PACKAGE_WISE, ['class' => 'form-control', "prompt" => "Select One",'id'=>'type']) ?>
                    <?= Html::error($model, 'type', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'type')->end() ?>

                <?= $form->field($model, 'shift_hrs', ['options' => ['class' => 'form-group',"id"=>"shift_hrs"]])->begin() ?>
                <?= Html::activeLabel($model, 'shift_hrs', ['class' => 'col-lg-3 col-sm-3 col-xs-3 control-label']); ?>
                <div class="col-lg-6 col-sm-6 col-xs-6">
                    <?= Html::activeTextInput($model, 'shift_hrs', ['class' => 'form-control']) ?>
                    <?= Html::error($model, 'shift_hrs', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'shift_hrs')->end() ?>

                <?= $form->field($model, 'status', ['options' => ['class' => "form-group"]])->begin(); ?>
                <?= Html::activeLabel($model, 'status', ['class' => 'col-lg-3 col-sm-3 col-xs-3 control-label']) ?>
                <div class="col-lg-6 col-sm-6 col-xs-6">
                    <?= Html::activeDropDownList($model, 'status', C::LABEL_STATUS, ['class' => 'form-control', "prompt" => "Select One"]) ?>
                    <?= Html::error($model, 'status', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'status')->end() ?>

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
$js = '
$("#shift_hrs").hide();
$("#type").on("change",function(){
    if(this.value==="6"){
        $("#shift_hrs").show();
    }else{
        $("#shift_hrs").hide();
    }
});

';

$this->registerJs($js, $this::POS_READY);
?>