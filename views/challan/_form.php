<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Challan $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="challan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'client_id')->textInput() ?>

    <?= $form->field($model, 'challan_date')->textInput() ?>

    <?= $form->field($model, 'site_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'operator_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'helper_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'plan_id')->textInput() ?>

    <?= $form->field($model, 'vehicle_id')->textInput() ?>

    <?= $form->field($model, 'challan_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'plan_start_time')->textInput() ?>

    <?= $form->field($model, 'plan_end_time')->textInput() ?>

    <?= $form->field($model, 'day_wise')->textInput() ?>

    <?= $form->field($model, 'plan_measure')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'plan_trip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'from_destination')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'to_destination')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'break_time')->textInput() ?>

    <?= $form->field($model, 'up_time')->textInput() ?>

    <?= $form->field($model, 'down_time')->textInput() ?>

    <?= $form->field($model, 'plan_extra_hours')->textInput() ?>

    <?= $form->field($model, 'plan_shift_type')->textInput() ?>

    <?= $form->field($model, 'challan_image')->textInput() ?>

    <?= $form->field($model, 'invoice_id')->textInput() ?>

    <?= $form->field($model, 'is_processed')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_on')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
