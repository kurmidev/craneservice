<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\PlanAttributes;
use app\components\Constants as C;
use app\models\PlanMaster;
use app\models\VehicleMaster;

$planList = ArrayHelper::map(PlanMaster::find()->active()->asArray()->all(), 'id', 'name');
$vehicleList = ArrayHelper::map(VehicleMaster::find()->active()->asArray()->all(), 'id', 'name');
?>

<?php $form = ActiveForm::begin(['id' => 'form-quotation', 'options' => ['enctype' => 'mutipart/form-data', 'class' => 'form-horizontal form-bordered']]); ?>
<div class="row">
    <div class="col-md-4">
        <div class="card card-secondary">
            <div class="card-header">
                <div class="card-title">
                    <?= $model->id ? "Add Quotation" : "Edit Quotation" ?>
                </div>
            </div>
            <div class="card-body">
                <?= $form->field($model, 'date', ['options' => ['class' => 'form-group']])->begin() ?>
                <?= Html::activeLabel($model, 'date', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                <div class="col-lg-12 col-sm-12 col-xs-12">
                    <?= Html::activeTextInput($model, 'date', ['class' => 'form-control cal']) ?>
                    <?= Html::error($model, 'date', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'date')->end() ?>

                <?= $form->field($model, 'subject', ['options' => ['class' => 'form-group']])->begin() ?>
                <?= Html::activeLabel($model, 'subject', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                <div class="col-lg-12 col-sm-12 col-xs-12">
                    <?= Html::activeTextInput($model, 'subject', ['class' => 'form-control']) ?>
                    <?= Html::error($model, 'subject', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'subject')->end() ?>

                <?= $form->field($model, 'terms_and_conditions', ['options' => ['class' => 'form-group']])->begin() ?>
                <?= Html::activeLabel($model, 'terms_and_conditions', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                <div class="col-lg-12 col-sm-12 col-xs-12">
                    <?= Html::activeTextarea($model, 'terms_and_conditions', ['class' => 'form-control', 'rows' => 8]) ?>
                    <?= Html::error($model, 'terms_and_conditions', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'terms_and_conditions')->end() ?>


                <?= $form->field($model, 'tax_applicable', ['options' => ['class' => 'form-group']])->begin() ?>
                <?= Html::activeLabel($model, 'tax_applicable', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                <div class="col-lg-12 col-sm-12 col-xs-12">
                    <?= Html::activeDropDownList($model, 'tax_applicable', C::LABEL_YESNO, ['class' => 'form-control', "prompt" => "Select One", "id" => "payment_modes"]) ?>
                    <?= Html::error($model, 'tax_applicable', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'tax_applicable')->end() ?>

                <?= $form->field($model, 'remark', ['options' => ['class' => "form-group"]])->begin(); ?>
                <?= Html::activeLabel($model, 'remark', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']) ?>
                <div class="col-lg-12 col-sm-12 col-xs-12">
                    <?= Html::activeTextarea($model, 'remark', ['class' => 'form-control']) ?>
                    <?= Html::error($model, 'remark', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'remark')->end() ?>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Add Package </h3>
                <div class="card-tools">
                    <?= Html::a(Html::tag('span', '', ['class' => 'fa fa-plus']), "#", ['title' => 'Add More', 'class' => 'btn btn-primary btn-sm', "onclick" => "addmoretablerow()"]) ?>
                </div>
            </div>
            <div class="card-body">
                <table id="clonetable">
                    <thead>
                        <tr>
                            <th>Particulars</th>
                            <th>Vehicle</th>
                            <th>Quantity</th>
                            <th>Amount</th>
                            <th>More</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <?= Html::activeDropDownList($model, 'quotation_items[1][plan_id]', $planList, ['class' => 'form-control', 'prompt' => 'Select one']) ?>
                            </td>
                            <td>
                                <?= Html::activeDropDownList($model, 'quotation_items[1][vehicle_id]', $vehicleList, ['class' => 'form-control', 'prompt' => 'Select one']) ?>
                            </td>
                            <td>
                                <?= Html::activeTextInput($model, 'quotation_items[1][quantity]', ['class' => 'form-control']) ?>
                            </td>
                            <td>
                                <?= Html::activeTextInput($model, 'quotation_items[1][amount]', ['class' => 'form-control']) ?>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger">
                                    <span class="fa fa-minus"></span>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card-footer mg-t-auto col-md-12">
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-xs-12 col-sm-offset-3">
                <?= Html::submitButton($model->id ? 'Create' : 'Update', ['class' => 'btn btn-secondary']) ?>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>