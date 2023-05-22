<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\PlanAttributes;
use app\components\Constants as C;
use app\models\ClientMaster;
use app\models\CompanyMaster;
use app\models\EmployeeMaster;
use app\models\ExpenseCategory;
use app\models\VehicleMaster;

$companyList = ArrayHelper::map(CompanyMaster::find()->active()->asArray()->all(), 'id', 'name');
$vehicleList = ArrayHelper::map(VehicleMaster::find()->active()->asArray()->all(), 'id', 'name');
$employeeList = ArrayHelper::map(EmployeeMaster::find()->active()->asArray()->all(), 'id', 'name');
$categoryList = ArrayHelper::map(ExpenseCategory::find()->active()->asArray()->all(), 'id', 'name');
$vendorList = ArrayHelper::map(ClientMaster::find()->active()->isVendor()->asArray()->all(), 'id', 'company_name');
?>

<?php $form = ActiveForm::begin(['id' => 'form-expense', 'options' => ['enctype' => 'mutipart/form-data', 'class' => 'form-horizontal form-bordered']]); ?>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <?= $form->field($model, 'company_id', ['options' => ['class' => 'form-group']])->begin() ?>
                <?= Html::activeLabel($model, 'company_id', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                <div class="col-lg-12 col-sm-12 col-xs-12">
                    <?= Html::activeDropDownList($model, 'company_id', $companyList, ['class' => 'form-control', 'prompt' => 'Select one']) ?>
                    <?= Html::error($model, 'company_id', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'company_id')->end() ?>

                <?php if ($model->expense_type == C::EXPENSE_TYPE_NORMAL) { ?>
                    <?= $form->field($model, 'type', ['options' => ['class' => 'form-group']])->begin() ?>
                    <?= Html::activeLabel($model, 'type', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                    <div class="col-lg-12 col-sm-12 col-xs-12">
                        <?= Html::activeDropDownList($model, 'type', C::EXPENSE_TYPE_LIST, ['class' => 'form-control', 'prompt' => 'Select one']) ?>
                        <?= Html::error($model, 'type', ['class' => 'error help-block']) ?>
                    </div>
                    <?= $form->field($model, 'type')->end() ?>
                <?php } ?>


                <?= $form->field($model, 'paid_by', ['options' => ['class' => 'form-group']])->begin() ?>
                <?= Html::activeLabel($model, 'paid_by', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                <div class="col-lg-12 col-sm-12 col-xs-12">
                    <?= Html::activeDropDownList($model, 'paid_by', $employeeList, ['class' => 'form-control', 'prompt' => 'Select one']) ?>
                    <?= Html::error($model, 'paid_by', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'paid_by')->end() ?>


                <?= $form->field($model, 'payment_mode', ['options' => ['class' => 'form-group']])->begin() ?>
                <?= Html::activeLabel($model, 'payment_mode', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                <div class="col-lg-12 col-sm-12 col-xs-12">
                    <?= Html::activeDropDownList($model, 'payment_mode', C::PAYMENT_MODE_LIST, ['class' => 'form-control', "prompt" => "Select One", "id" => "payment_modes"]) ?>
                    <?= Html::error($model, 'payment_mode', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'payment_mode')->end() ?>

                <?= $form->field($model, 'against_bill_no', ['options' => ['class' => "form-group"]])->begin(); ?>
                <?= Html::activeLabel($model, 'against_bill_no', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']) ?>
                <div class="col-lg-12 col-sm-12 col-xs-12">
                    <?= Html::activeTextInput($model, 'against_bill_no', ['class' => 'form-control']) ?>
                    <?= Html::error($model, 'against_bill_no', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'against_bill_no')->end() ?>

                <?php if ($model->expense_type == C::EXPENSE_TYPE_NORMAL) { ?>
                    <?= $form->field($model, 'vehicle_id', ['options' => ['class' => "form-group"]])->begin(); ?>
                    <?= Html::activeLabel($model, 'vehicle_id', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']) ?>
                    <div class="col-lg-12 col-sm-12 col-xs-12">
                        <?= Html::activeDropDownList($model, 'vehicle_id', $vehicleList, ['class' => 'form-control']) ?>
                        <?= Html::error($model, 'vehicle_id', ['class' => 'error help-block']) ?>
                    </div>
                    <?= $form->field($model, 'vehicle_id')->end() ?>
                <?php } ?>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <?php if ($model->expense_type == C::EXPENSE_TYPE_NORMAL) { ?>
                    <?= $form->field($model, 'vendor_id', ['options' => ['class' => 'form-group']])->begin() ?>
                    <?= Html::activeLabel($model, 'vendor_id', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                    <div class="col-lg-12 col-sm-12 col-xs-12">
                        <?= Html::activeDropDownList($model, 'vendor_id', $vendorList, ['class' => 'form-control', 'prompt' => "Select one"]) ?>
                        <?= Html::error($model, 'vendor_id', ['class' => 'error help-block']) ?>
                    </div>
                    <?= $form->field($model, 'vendor_id')->end() ?>
                <?php } ?>

                <?php if ($model->expense_type == C::EXPENSE_TYPE_STAFF) { ?>
                    <?= $form->field($model, 'staff_id', ['options' => ['class' => 'form-group']])->begin() ?>
                    <?= Html::activeLabel($model, 'staff_id', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                    <div class="col-lg-12 col-sm-12 col-xs-12">
                        <?= Html::activeDropDownList($model, 'staff_id', $employeeList, ['class' => 'form-control', 'prompt' => "Select one"]) ?>
                        <?= Html::error($model, 'staff_id', ['class' => 'error help-block']) ?>
                    </div>
                    <?= $form->field($model, 'staff_id')->end() ?>
                <?php } ?>

                <?= $form->field($model, 'date', ['options' => ['class' => 'form-group']])->begin() ?>
                <?= Html::activeLabel($model, 'date', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                <div class="col-lg-12 col-sm-12 col-xs-12">
                    <?= Html::activeTextInput($model, 'date', ['class' => 'form-control cal']) ?>
                    <?= Html::error($model, 'date', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'date')->end() ?>

                <?= $form->field($model, 'paid_by', ['options' => ['class' => 'form-group']])->begin() ?>
                <?= Html::activeLabel($model, 'paid_by', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                <div class="col-lg-12 col-sm-12 col-xs-12">
                    <?= Html::activeDropDownList($model, 'paid_by', $employeeList, ['class' => 'form-control', 'prompt' => "Select one"]) ?>
                    <?= Html::error($model, 'paid_by', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'paid_by')->end() ?>


                <?= $form->field($model, 'passed_by', ['options' => ['class' => 'form-group']])->begin() ?>
                <?= Html::activeLabel($model, 'passed_by', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                <div class="col-lg-12 col-sm-12 col-xs-12">
                    <?= Html::activeDropDownList($model, 'passed_by', $employeeList, ['class' => 'form-control', "prompt" => "Select One", "id" => "payment_modes"]) ?>
                    <?= Html::error($model, 'passed_by', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'passed_by')->end() ?>

                <?= $form->field($model, 'file_details', ['options' => ['class' => "form-group"]])->begin(); ?>
                <?= Html::activeLabel($model, 'file_details', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']) ?>
                <div class="col-lg-12 col-sm-12 col-xs-12">
                    <?= Html::activeFileInput($model, 'file_details', ['class' => 'form-control']) ?>
                    <?= Html::error($model, 'file_details', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'file_details')->end() ?>


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

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Add Ca tegory</h3>
                <div class="card-tools">
                    <?= Html::a(Html::tag('span', '', ['class' => 'fa fa-plus']), "#", ['title' => 'Add More', 'class' => 'btn btn-primary btn-sm', "onclick" => "addmoretablerow()"]) ?>
                </div>
            </div>
            <div class="card-body">
                <table id="clonetable" class="table">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Quantity</th>
                            <th>Amount</th>
                            <th>More</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        if (!empty($expense->expenseItems)) {
                            foreach ($expense->expenseItems as $e) {

                        ?>
                                <tr>
                                    <td>
                                        <?= Html::activeDropDownList($model, 'expense_items[' . $i . '][category_id]', $categoryList, ['class' => 'form-control', 'prompt' => 'Select one', 'options' => [$e['category_id'] => ["selected" => true]]]) ?>
                                    </td>
                                    <td>
                                        <?= Html::activeTextInput($model, 'expense_items[' . $i . '][quantity]', ['class' => 'form-control', 'value' => $e['quantity']]) ?>
                                    </td>
                                    <td>
                                        <?= Html::activeTextInput($model, 'expense_items[' . $i . '][amount]', ['class' => 'form-control', 'value' => $e['amount']]) ?>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger">
                                            <span class="fa fa-minus" onclick="<?= $i > 0 ? "$(this).closest('tr').remove();" : "" ?>"></span>
                                        </button>
                                    </td>

                            <?php
                                $i++;
                            }
                        }
                            ?>
                                <tr>
                                    <td>
                                        <?= Html::activeDropDownList($model, 'expense_items[' . $i . '][category_id]', $categoryList, ['class' => 'form-control', 'prompt' => 'Select one']) ?>
                                    </td>
                                    <td>
                                        <?= Html::activeTextInput($model, 'expense_items[' . $i . '][quantity]', ['class' => 'form-control']) ?>
                                    </td>
                                    <td>
                                        <?= Html::activeTextInput($model, 'expense_items[' . $i . '][amount]', ['class' => 'form-control']) ?>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger">
                                            <span class="fa fa-minus" onclick="<?= $i > 0 ? "$(this).closest('tr').remove();" : "" ?>"></span>
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