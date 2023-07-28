<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\components\Constants as C;
use app\models\City;
use app\models\ClientPlanMapping;
use app\models\ClientSite;
use app\models\CompanyMaster;
use app\models\EmployeeMaster;
use app\models\PlanMaster;
use app\models\VehicleMaster;
use yii\web\View;
use app\components\ImsGridView;
use app\models\ClientMaster;
$time = time();

$client_id = ClientMaster::find()->active()->andWhere(['client_type' => $model->client_type])->all();

$planList = PlanMaster::find()->active()->asArray()->indexBy('id')->all();
$assignedList = [];
if (!empty($model->client_id)) {
    $assignedList = ClientPlanMapping::find()->andWhere(['client_id' => $model->client_id])->asArray()->indexBy('plan_id')->all();
}

?>
<?php $form = ActiveForm::begin(['id' => 'form-challan', 'options' => ['enctype' => 'multipart/form-data', 'class' => 'form-bordered']]); ?>
<div class="row">
    <div class="col-lg-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Add Challan Form
                </h3>
                <div class="card-tools">
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php if (empty($model->client_id)) { ?>
                        <div class="col-lg-4 col-sm-4 col-xs-4">
                            <?= $form->field($model, 'client_id', ['options' => ['class' => 'form-group']])->begin() ?>
                            <?= Html::activeLabel($model, 'client_id', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                            <?= Html::activeDropDownList($model, 'client_id', ArrayHelper::map($client_id, 'id', 'company_name'), $options = ['class' => 'form-control', 'prompt' => "Select options"]) ?>
                            <?= Html::error($model, 'client_id', ['class' => 'error help-block', 'id' => "error_client_id"]) ?>
                            <?= $form->field($model, 'client_id')->end() ?>
                        </div>
                    <?php } ?>

                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <?= $form->field($model, 'challan_date', ['options' => ['class' => 'form-group']])->begin() ?>
                        <?= Html::activeLabel($model, 'challan_date', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                        <?= Html::activeTextInput($model, 'challan_date', ['class' => 'form-control cal', 'id' => "challan_date"]) ?>
                        <?= Html::error($model, 'challan_date', ['class' => 'error help-block', 'id' => "error_challan_date"]) ?>
                        <?= $form->field($model, 'challan_date')->end() ?>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <?= $form->field($model, 'challan_no', ['options' => ['class' => 'form-group']])->begin() ?>
                        <?= Html::activeLabel($model, 'challan_no', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                        <?= Html::activeTextInput($model, 'challan_no', ['class' => 'form-control', 'id' => 'challan_no']) ?>
                        <?= Html::error($model, 'challan_no', ['class' => 'error help-block', 'id' => "error_challan_no"]) ?>
                        <?= $form->field($model, 'challan_no')->end() ?>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <?= $form->field($model, 'site_address', ['options' => ['class' => 'form-group']])->begin() ?>
                        <?= Html::activeLabel($model, 'site_address', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                        <?= Html::activeDropDownList($model, 'site_address',  ArrayHelper::map(ClientSite::find()->where(['client_id' => $model->client_id])->active()->all(), 'id', 'address'), ['class' => 'form-control', 'id' => "challanform_items_0_site_address", 'prompt' => "Select option"]) ?>
                        <?= Html::error($model, 'site_address', ['class' => 'error help-block', 'id' => "error_site_address"]) ?>
                        <?= $form->field($model, 'site_address')->end() ?>
                    </div>

                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <?= $form->field($model, 'helper_id', ['options' => ['class' => 'form-group']])->begin() ?>
                        <?= Html::activeLabel($model, 'helper_id', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                        <?= Html::activeDropDownList($model, 'helper_id', ArrayHelper::map(EmployeeMaster::find()->active()->all(), 'id', 'name'), ['class' => 'form-control', 'id' => "challanform_items_0_helper_id", 'prompt' => "Select option"]) ?>
                        <?= Html::error($model, 'helper_id', ['class' => 'error help-block', 'id' => "error_helper_id"]) ?>
                        <?= $form->field($model, 'helper_id')->end() ?>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <?= $form->field($model, 'operator_id', ['options' => ['class' => 'form-group']])->begin() ?>
                        <?= Html::activeLabel($model, 'operator_id', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                        <?= Html::activeDropDownList($model, 'operator_id',  ArrayHelper::map(EmployeeMaster::find()->active()->all(), 'id', 'name'), ['class' => 'form-control', 'prompt' => "Select option"]) ?>
                        <?= Html::error($model, 'operator_id', ['class' => 'error help-block', 'id' => "error_operator_id"]) ?>
                        <?= $form->field($model, 'operator_id')->end() ?>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <?= $form->field($model, 'vehicle_id', ['options' => ['class' => 'form-group']])->begin() ?>
                        <?= Html::activeLabel($model, 'vehicle_id', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                        <?= Html::activeDropDownList($model, 'vehicle_id', ArrayHelper::map(VehicleMaster::find()->active()->all(), 'id', 'vehicle_no'), ['class' => 'form-control', 'id' => 'challanform_items_0_vehicle_id', 'prompt' => "Select option"]) ?>
                        <?= Html::error($model, 'vehicle_id', ['class' => 'error help-block', 'id' => 'error_vehicle_id']) ?>
                        <?= $form->field($model, 'vehicle_id')->end() ?>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <?= $form->field($model, 'plan_id', ['options' => ['class' => 'form-group']])->begin() ?>
                        <?= Html::activeLabel($model, 'plan_id', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                        <select id="challanform-plan_id" class="form-control" name="ChallanForm[plan_id]" aria-required="true">
                            <option value="">Select option</option>>
                            <?php foreach ($planList as $plan_id => $plan_data) { ?>
                                <option value="<?= $plan_id ?>" price="<?= !empty($assignedList[$plan_id]) ? $assignedList[$plan_id]['custom_price'] : $plan_data['price'] ?>" plan_type="<?= $plan_data['type'] ?>"><?= $plan_data['name'] ?><?= !empty($plan_data['shift_hrs']) ? "(" . $plan_data['shift_hrs'] . "hrs)" : "" ?></option>
                            <?php } ?>
                        </select>
                        <?= Html::error($model, 'plan_id', ['class' => 'error help-block', 'id' => "error_plan_id"]) ?>
                        <?= $form->field($model, 'plan_id')->end() ?>
                    </div>
                </div>
                <div class="row">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>
                                    <?= $form->field($model, 'plan_start_time', ['options' => ['class' => 'form-group lvl1', "id" => "plan_start_time"]])->begin() ?>
                                    <?= Html::activeLabel($model, 'plan_start_time', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                                    <?= Html::activeTextInput($model, 'plan_start_time', ['class' => 'form-control timepick caldiff']) ?>
                                    <?= Html::error($model, 'plan_start_time', ['class' => 'error help-block', 'id' => "error_plan_start_time"]) ?>
                                    <?= $form->field($model, 'plan_start_time')->end() ?>

                                    <?= $form->field($model, 'day_wise', ['options' => ['class' => 'form-group lvl2', "id" => 'day_wise']])->begin() ?>
                                    <?= Html::activeLabel($model, 'day_wise', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                                    <?= Html::activeDropDownList($model, 'day_wise', C::DAYWISE_LABEL, ['class' => 'form-control hide', 'prompt' => "Select option"]) ?>
                                    <?= Html::error($model, 'day_wise', ['class' => 'error help-block', 'id' => "error_day_wise"]) ?>
                                    <?= $form->field($model, 'day_wise')->end() ?>

                                    <?= $form->field($model, 'plan_trip', ['options' => ['class' => 'form-group lvl3', "id" => "plan_trip"]])->begin() ?>
                                    <?= Html::activeLabel($model, 'plan_trip', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                                    <?= Html::activeTextInput($model, 'plan_trip', ['class' => 'form-control hide', "placeholder" => "Trip/Quantity"]) ?>
                                    <?= Html::error($model, 'plan_trip', ['class' => 'error help-block', 'id' => "error_plan_trip"]) ?>
                                    <?= $form->field($model, 'plan_trip')->end() ?>

                                    <?= $form->field($model, 'from_destination', ['options' => ['class' => 'form-group lvl4', "id" => "from_destination"]])->begin() ?>
                                    <?= Html::activeLabel($model, 'from_destination', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                                    <?= Html::activeTextInput($model, 'from_destination', ['class' => 'form-control hide', "placeholder" => "From Destination"]) ?>
                                    <?= Html::error($model, 'from_destination', ['class' => 'error help-block', 'id' => "error_from_destination"]) ?>
                                    <?= $form->field($model, 'from_destination')->end() ?>
                                </td>
                                <td>
                                    <?= $form->field($model, 'plan_end_time', ['options' => ['class' => 'form-group lvl1', 'id' => "plan_end_time"]])->begin() ?>
                                    <?= Html::activeLabel($model, 'plan_end_time', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                                    <?= Html::activeTextInput($model, 'plan_end_time', ['class' => 'form-control timepick caldiff']) ?>
                                    <?= Html::error($model, 'plan_end_time', ['class' => 'error help-block', 'id' => "error_plan_end_time"]) ?>
                                    <?= $form->field($model, 'plan_end_time')->end() ?>

                                    <?= $form->field($model, 'plan_measure', ['options' => ['class' => 'form-group lvl2', "id" => "plan_measure"]])->begin() ?>
                                    <?= Html::activeLabel($model, 'plan_measure', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                                    <?= Html::activeTextInput($model, 'plan_measure', ['class' => 'form-control hide', "placeholder" => 'Brass/Litre']) ?>
                                    <?= Html::error($model, 'plan_measure', ['class' => 'error help-block', 'id' => "error_plan_measure"]) ?>
                                    <?= $form->field($model, 'plan_measure')->end() ?>

                                    <?= $form->field($model, 'to_destination', ['options' => ['class' => 'form-group lvl3', 'id' => "to_destination"]])->begin() ?>
                                    <?= Html::activeLabel($model, 'to_destination', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                                    <?= Html::activeTextInput($model, 'to_destination', ['class' => 'form-control hide', "placeholder" => "To Destination"]) ?>
                                    <?= Html::error($model, 'to_destination', ['class' => 'error help-block', 'id' => "error_to_destination"]) ?>
                                    <?= $form->field($model, 'to_destination')->end() ?>
                                    <span class="text-danger level" id="total_time"></span>
                                </td>
                                <td>
                                    <?= $form->field($model, 'break_time', ['options' => ['class' => 'form-group', "id" => "break_time"]])->begin() ?>
                                    <?= Html::activeLabel($model, 'break_time', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                                    <?= Html::activeDropDownList($model, 'break_time', C::getTimeList(), ['class' => 'form-control  caldiff', 'prompt' => "Select option"]) ?>
                                    <?= Html::error($model, 'break_time', ['class' => 'error help-block', 'id' => "error_break_time"]) ?>
                                    <?= $form->field($model, 'break_time')->end() ?>
                                    <span id="break_time_span"></span>
                                </td>
                                <td>
                                    <?= $form->field($model, 'up_time', ['options' => ['class' => 'form-group lvl1', "id" => "up_time"]])->begin() ?>
                                    <?= Html::activeLabel($model, 'up_time', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                                    <?= Html::activeDropDownList($model, 'up_time', C::getTimeList(), ['class' => 'form-control  caldiff', 'prompt' => "Select option"]) ?>
                                    <?= Html::error($model, 'up_time', ['class' => 'error help-block', "id" => "error_up_time"]) ?>
                                    <?= $form->field($model, 'up_time')->end() ?>

                                    <?= $form->field($model, 'plan_extra_hours', ['options' => ['class' => 'form-group lvl2', "id" => "plan_extra_hours"]])->begin() ?>
                                    <?= Html::activeLabel($model, 'plan_extra_hours', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                                    <?= Html::activeTextInput($model, 'plan_extra_hours', ['class' => 'form-control', "placeholder" => "Extra Hours"]) ?>
                                    <?= Html::error($model, 'plan_extra_hours', ['class' => 'error help-block', 'id' => "error_plan_extra_hours"]) ?>
                                    <?= $form->field($model, 'plan_extra_hours')->end() ?>
                                </td>
                                <td>
                                    <?= $form->field($model, 'down_time', ['options' => ['class' => 'form-group lvl1', "id" => "down_time"]])->begin() ?>
                                    <?= Html::activeLabel($model, 'down_time', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                                    <?= Html::activeDropDownList($model, 'down_time', C::getTimeList(), ['class' => 'form-control  caldiff', 'prompt' => "Select option"]) ?>
                                    <?= Html::error($model, 'down_time', ['class' => 'error help-block', 'id' => "error_down_time"]) ?>
                                    <?= $form->field($model, 'down_time')->end() ?>

                                    <?= $form->field($model, 'plan_shift_type', ['options' => ['class' => 'form-group lvl2', "id" => "plan_shift_type"]])->begin() ?>
                                    <?= Html::activeLabel($model, 'plan_shift_type', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                                    <?= Html::activeDropDownList($model, 'plan_shift_type', C::PACKAGE_SHIFT_TYPE, ['class' => 'form-control']) ?>
                                    <?= Html::error($model, 'plan_shift_type', ['class' => 'error help-block', 'id' => "error_plan_shift_type"]) ?>
                                    <?= $form->field($model, 'plan_shift_type')->end() ?>
                                </td>
                                <td>
                                    <?= $form->field($model, 'amount', ['options' => ['class' => 'form-group']])->begin() ?>
                                    <?= Html::activeLabel($model, 'amount', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                                    <?= Html::activeTextInput($model, 'amount', ['class' => 'form-control', 'id' => 'amount']) ?>
                                    <?= Html::error($model, 'amount', ['class' => 'error help-block', 'id' => "error_amount"]) ?>
                                    <?= $form->field($model, 'amount')->end() ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card-footer mg-t-auto mg-d-10">
            <div class="row">
                <div class="col-lg-12 col-sm-12 col-xs-12 col-sm-offset-3">
                    <?=Html::activeHiddenInput($model,'add_group_id',['value'=>$time])?>
                    <?= Html::button('Create', ['class' => 'btn btn-secondary','id'=>'challan-submit']) ?>
                </div>
            </div>
        </div>
    </div>
</div>


<?php ActiveForm::end(); ?>

<?php $form = ActiveForm::begin(['id' => 'form-challan','action'=>Yii::$app->urlManager->createUrl(['client/add-multiple-challan']), 'options' => ['enctype' => 'multipart/form-data', 'class' => 'form-bordered']]); ?>
<div class="row">
    <div class="col-lg-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Challan List
                </h3>
                <div class="card-tools">
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <table class="table table-responsive" id="adddata">
                        <tr>
                            <td>Challan Date</td>
                            <td>Challan No</td>
                            <td>Address</td>
                            <td>Helper</td>
                            <td>Operator</td>
                            <td>Vehicle</td>
                            <td>Plan</td>
                            <td>Start Time</td>
                            <td>End Time</td>
                            <td>Break Time</td>
                            <td>Up Time</td>
                            <td>Down Time</td>
                            <td>Amount</td>
                            <td>Action</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="card-footer mg-t-auto mg-d-10">
            <div class="row">
                <div class="col-lg-12 col-sm-12 col-xs-12 col-sm-offset-3">
                    <?=Html::activeHiddenInput($model,'add_group_id',['value'=>$time])?>
                    <?= Html::submitButton('Create', ['class' => 'btn btn-secondary']) ?>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>