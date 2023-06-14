<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\components\Constants as C;
?>

<div class="row">
    <div class="col-md-12">
        <div class="card card-secondary">
            <div class="card-header">
                <div class="card-title">
                    <?=($model->isNewRecord ? "Add New Shipping Address" : "Update Shipping Address")?>
                </div>
            </div>
            <div class="card-body">
                <?php $form = ActiveForm::begin(['id' => 'form-site', 'options' => ['enctype' => 'multipart/form-data', 'class' => 'form-horizontal form-bordered']]); ?>

                <?= $form->field($model, 'address', ['options' => ['class' => 'form-group']])->begin() ?>
                <?= Html::activeLabel($model, 'address', ['class' => 'col-lg-3 col-sm-3 col-xs-3 control-label']); ?>
                <div class="col-lg-6 col-sm-6 col-xs-6">
                    <?= Html::activeTextarea($model, 'address', ['class' => 'form-control']) ?>
                    <?= Html::error($model, 'address', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'address')->end() ?>

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
