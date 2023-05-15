<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\components\Constants as C;
use app\models\City;
use app\models\ClientSite;
use app\models\CompanyMaster;
use app\models\EmployeeMaster;
use app\models\PlanMaster;
use app\models\VehicleMaster;
use yii\web\View;

?>
<?php $form = ActiveForm::begin(['id' => 'form-client', 'options' => ['enctype' => 'multipart/form-data', 'class' => 'form-bordered', 'enableAjaxValidation' => true]]); ?>
<div class="row">
    <div class="col-lg-12 col-sm-12 col-xs-12">
        <div class="card card-secondary">
            <div class="card-header">
                <div class="card-title">
                    Add Challan
                </div>
            </div>
            <div class="card-body">
                <?= $form->field($model, 'challan_date', ['options' => ['class' => 'form-group']])->begin() ?>
                <?= Html::activeLabel($model, 'challan_date', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                <div class="col-lg-6 col-sm-6 col-xs-6">
                    <?= Html::activeTextInput($model, 'challan_date', ['class' => 'form-control cal']) ?>
                    <?= Html::error($model, 'challan_date', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'challan_date')->end() ?>

                <?= $form->field($model, 'challan_image', ['options' => ['class' => 'form-group']])->begin() ?>
                <?= Html::activeLabel($model, 'challan_image', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                <div class="col-lg-6 col-sm-6 col-xs-6">
                    <?= Html::activeFileInput($model, 'challan_image', ['class' => 'form-control ']) ?>
                    <?= Html::error($model, 'challan_image', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'challan_image')->end() ?>

                <?php if($model->client_type==C::CLIENT_TYPE_CUSTOMER){?>

                <?= $form->field($model, 'site_address', ['options' => ['class' => 'form-group']])->begin() ?>
                <?= Html::activeLabel($model, 'site_address', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                <div class="col-lg-6 col-sm-6 col-xs-6">
                    <?= Html::activeDropDownList($model, 'site_address',ArrayHelper::map(ClientSite::find()->where(['client_id'=>$model->client_id])->active()->all(),'id','address'), ['class' => 'form-control','prompt'=>"Select one"]) ?>
                    <?= Html::error($model, 'site_address', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'site_address')->end() ?>

                <?= $form->field($model, 'helper_id', ['options' => ['class' => 'form-group']])->begin() ?>
                <?= Html::activeLabel($model, 'helper_id', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                <div class="col-lg-6 col-sm-6 col-xs-6">
                    <?= Html::activeDropDownList($model, 'helper_id', ArrayHelper::map(EmployeeMaster::find()->active()->all(),'id','name'),['class' => 'form-control','prompt'=>"Select One"]) ?>
                    <?= Html::error($model, 'helper_id', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'helper_id')->end() ?>

                <?= $form->field($model, 'operator_id', ['options' => ['class' => 'form-group']])->begin() ?>
                <?= Html::activeLabel($model, 'operator_id', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                <div class="col-lg-6 col-sm-6 col-xs-6">
                    <?= Html::activeDropDownList($model, 'operator_id', ArrayHelper::map(EmployeeMaster::find()->active()->all(),'id','name'),['class' => 'form-control','prompt'=>"Select One"]) ?>
                    <?= Html::error($model, 'operator_id', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'operator_id')->end() ?>


                <?php } ?>


            </div>
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-xs-12">
        <div class="card card-secondary">
            <div class="card-header">
                <div class="card-title">
                    ADD Package
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Particulars</th>
                            <th>Vehicle</th>
                            <th>Challan No.</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Amount</th>
                            <th>Break Time</th>
                            <th>Up Time</th>
                            <th>Down Time</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr id="ids">
                            <td>
                                <?= $form->field($model, 'items[0][plan_id]', ['options' => ['class' => 'form-group']])->begin() ?>
                                <div class="col-lg-12 col-sm-12 col-xs-12">
                                    <?= Html::activeDropDownList($model, 'items[0][plan_id]', ArrayHelper::map(PlanMaster::find()->active()->all(), 'id', 'name'), ['class' => 'form-control challan_options', 'id' => "challanform_items_0_plan_id", 'prompt' => "Select option", "rel" => "challanform_items_0"]) ?>
                                    <?= Html::error($model, 'items[0][plan_id]', ['class' => 'error help-block']) ?>
                                </div>
                                <?= $form->field($model, 'items[0][plan_id]')->end() ?>
                            </td>
                            <td>
                                <?= $form->field($model, 'items[0][vehicle_id]', ['options' => ['class' => 'form-group']])->begin() ?>
                                <div class="col-lg-12 col-sm-12 col-xs-12">
                                    <?= Html::activeDropDownList($model, 'items[0][vehicle_id]', ArrayHelper::map(VehicleMaster::find()->active()->all(), 'id', 'name'), ['class' => 'form-control', 'id' => 'challanform_items_0_vehicle_id', 'prompt' => "Select option"]) ?>
                                    <?= Html::error($model, 'items[0][vehicle_id]', ['class' => 'error help-block']) ?>
                                </div>
                                <?= $form->field($model, 'items[0][vehicle_id]')->end() ?>
                            </td>
                            <td>
                                <?= $form->field($model, 'items[0][challan_no]', ['options' => ['class' => 'form-group']])->begin() ?>
                                <div class="col-lg-12 col-sm-12 col-xs-12">
                                    <?= Html::activeTextInput($model, 'items[0][challan_no]', ['class' => 'form-control', 'id' => 'challanform_items_0_challan_no']) ?>
                                    <?= Html::error($model, 'items[0][challan_no]', ['class' => 'error help-block']) ?>
                                </div>
                                <?= $form->field($model, 'items[0][challan_no]')->end() ?>
                            </td>

                            <td>
                                <?= $form->field($model, 'items[0][plan_start_time]', ['options' => ['class' => 'form-group']])->begin() ?>
                                <div class="col-lg-12 col-sm-12 col-xs-12">
                                    <?= Html::activeTextInput($model, 'items[0][plan_start_time]', ['class' => 'form-control timepick caldiff', "id" => "challanform_items_0_plan_start_time","rel" => "challanform_items_0"]) ?>
                                    <?= Html::error($model, 'items[0][plan_start_time]', ['class' => 'error help-block']) ?>
                                </div>
                                <?= $form->field($model, 'items[0][plan_start_time]')->end() ?>

                                <?= $form->field($model, 'items[0][day_wise]', ['options' => ['class' => 'form-group']])->begin() ?>
                                <div class="col-lg-12 col-sm-12 col-xs-12">
                                    <?= Html::activeDropDownList($model, 'items[0][day_wise]', C::DAYWISE_LABEL, ['class' => 'form-control hide', 'prompt' => "Select option", "id" => 'challanform_items_0_day_wise']) ?>
                                    <?= Html::error($model, 'items[0][day_wise]', ['class' => 'error help-block']) ?>
                                </div>
                                <?= $form->field($model, 'items[0][day_wise]')->end() ?>

                                <?= $form->field($model, 'items[0][plan_trip]', ['options' => ['class' => 'form-group']])->begin() ?>
                                <div class="col-lg-12 col-sm-12 col-xs-12">
                                    <?= Html::activeTextInput($model, 'items[0][plan_trip]', ['class' => 'form-control hide', "id" => "challanform_items_0_plan_trip"]) ?>
                                    <?= Html::error($model, 'items[0][plan_trip]', ['class' => 'error help-block']) ?>
                                </div>
                                <?= $form->field($model, 'items[0][plan_trip]')->end() ?>

                                <?= $form->field($model, 'items[0][from_destination]', ['options' => ['class' => 'form-group']])->begin() ?>
                                <div class="col-lg-12 col-sm-12 col-xs-12">
                                    <?= Html::activeTextInput($model, 'items[0][from_destination]', ['class' => 'form-control hide', "id" => "challanform_items_0_from_destination"]) ?>
                                    <?= Html::error($model, 'items[0][from_destination]', ['class' => 'error help-block']) ?>
                                </div>
                                <?= $form->field($model, 'items[0][from_destination]')->end() ?>

                            </td>

                            <td>
                                <?= $form->field($model, 'items[0][plan_end_time]', ['options' => ['class' => 'form-group']])->begin() ?>
                                <div class="col-lg-12 col-sm-12 col-xs-12">
                                    <?= Html::activeTextInput($model, 'items[0][plan_end_time]', ['class' => 'form-control timepick caldiff', 'id' => "challanform_items_0_plan_end_time","rel" => "challanform_items_0"]) ?>
                                    <?= Html::error($model, 'items[0][plan_end_time]', ['class' => 'error help-block']) ?>
                                </div>
                                <?= $form->field($model, 'items[0][plan_end_time]')->end() ?>

                                <?= $form->field($model, 'items[0][plan_measure]', ['options' => ['class' => 'form-group']])->begin() ?>
                                <div class="col-lg-12 col-sm-12 col-xs-12">
                                    <?= Html::activeTextInput($model, 'items[0][plan_measure]', ['class' => 'form-control hide', "id" => "challanform_items_0_plan_measure"]) ?>
                                    <?= Html::error($model, 'items[0][plan_measure]', ['class' => 'error help-block']) ?>
                                </div>
                                <?= $form->field($model, 'items[0][plan_measure]')->end() ?>

                                <?= $form->field($model, 'items[0][to_destination]', ['options' => ['class' => 'form-group']])->begin() ?>
                                <div class="col-lg-12 col-sm-12 col-xs-12">
                                    <?= Html::activeTextInput($model, 'items[0][to_destination]', ['class' => 'form-control hide', 'id' => "challanform_items_0_to_destination"]) ?>
                                    <?= Html::error($model, 'items[0][to_destination]', ['class' => 'error help-block']) ?>
                                </div>
                                <?= $form->field($model, 'items[0][to_destination]')->end() ?>

                            </td>

                            <td>
                                <?= $form->field($model, 'items[0][amount]', ['options' => ['class' => 'form-group']])->begin() ?>
                                <div class="col-lg-12 col-sm-12 col-xs-12">
                                    <?= Html::activeTextInput($model, 'items[0][amount]', ['class' => 'form-control', 'id' => 'challanform_items_0_amount']) ?>
                                    <?= Html::error($model, 'items[0][amount]', ['class' => 'error help-block']) ?>
                                </div>
                                <?= $form->field($model, 'items[0][amount]')->end() ?>
                            </td>
                            <td>
                                <?= $form->field($model, 'items[0][break_time]', ['options' => ['class' => 'form-group']])->begin() ?>
                                <div class="col-lg-12 col-sm-12 col-xs-12">
                                    <?= Html::activeDropDownList($model, 'items[0][break_time]', C::getTimeList(), ['class' => 'form-control', 'prompt' => "Select option", "id" => "challanform_items_0_break_time"]) ?>
                                    <?= Html::error($model, 'items[0][break_time]', ['class' => 'error help-block']) ?>
                                </div>
                                <?= $form->field($model, 'items[0][break_time]')->end() ?>
                                <span id="challanform_items_0_break_time_span"></span>
                            </td>

                            <td>
                                <?= $form->field($model, 'items[0][up_time]', ['options' => ['class' => 'form-group']])->begin() ?>
                                <div class="col-lg-12 col-sm-12 col-xs-12">
                                    <?= Html::activeDropDownList($model, 'items[0][up_time]', C::getTimeList(), ['class' => 'form-control', 'prompt' => "Select option", "id" => "challanform_items_0_up_time"]) ?>
                                    <?= Html::error($model, 'items[0][up_time]', ['class' => 'error help-block']) ?>
                                </div>
                                <?= $form->field($model, 'items[0][up_time]')->end() ?>

                                <?= $form->field($model, 'items[0][plan_extra_hours]', ['options' => ['class' => 'form-group']])->begin() ?>
                                <div class="col-lg-12 col-sm-12 col-xs-12">
                                    <?= Html::activeTextInput($model, 'items[0][plan_extra_hours]', ['class' => 'form-control', "id" => "challanform_items_0_plan_extra_hours"]) ?>
                                    <?= Html::error($model, 'items[0][plan_extra_hours]', ['class' => 'error help-block']) ?>
                                </div>
                                <?= $form->field($model, 'items[0][plan_extra_hours]')->end() ?>


                            </td>
                            <td>
                                <?= $form->field($model, 'items[0][down_time]', ['options' => ['class' => 'form-group']])->begin() ?>
                                <div class="col-lg-12 col-sm-12 col-xs-12">
                                    <?= Html::activeDropDownList($model, 'items[0][down_time]', C::getTimeList(), ['class' => 'form-control', 'prompt' => "Select option", "id" => "challanform_items_0_down_time"]) ?>
                                    <?= Html::error($model, 'items[0][down_time]', ['class' => 'error help-block']) ?>
                                </div>
                                <?= $form->field($model, 'items[0][down_time]')->end() ?>

                                <?= $form->field($model, 'items[0][plan_shift_type]', ['options' => ['class' => 'form-group']])->begin() ?>
                                <div class="col-lg-12 col-sm-12 col-xs-12">
                                    <?= Html::activeDropDownList($model, 'items[0][plan_shift_type]',C::PACKAGE_SHIFT_TYPE ,['class' => 'form-control', "id" => "challanform_items_0_plan_shift_type"]) ?>
                                    <?= Html::error($model, 'items[0][plan_shift_type]', ['class' => 'error help-block']) ?>
                                </div>
                                <?= $form->field($model, 'items[0][plan_shift_type]')->end() ?>

                            </td>

                            <td>
                                <span></span>
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
                <?= Html::submitButton(empty($model->id) ? 'Create' : 'Update', ['class' => 'btn btn-secondary']) ?>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>


<?php

$plans = PlanMaster::find()->active()->asArray()->all();

$plan_amount_mapping = $plan_type_mapping = $plan_shift_mapping = [];
foreach ($plans as $plan) {
    $plan_type_mapping[$plan["id"]] = $plan['type'];
    $plan_amount_mapping[$plan["id"]] = $plan['price'];
    if($plan['type']==C::PACKAGE_WISE_SHIFT){
        $plan_shift_mapping[$plan["id"]] = $plan['shift_hrs'];
    }
    
}

$js = '
    var plan_type_mapping = ' . json_encode($plan_type_mapping) . ';
    var plan_amount_mapping = ' . json_encode($plan_amount_mapping) . ';
    var plan_shift_mapping = ' . json_encode($plan_shift_mapping) . ';
    
';

$this->registerJs($js, View::POS_HEAD);

$js = '
$("#challanform_items_0_day_wise").hide();
$("#challanform_items_0_plan_trip").hide();
$("#challanform_items_0_from_destination").hide();
$("#challanform_items_0_plan_shift_type").hide();

$("#challanform_items_0_plan_measure").hide();
$("#challanform_items_0_to_destination").hide();
$("#challanform_items_0_plan_extra_hours").hide();

$(".caldiff").change(function(){
    var rel = $(this).attr("rel");
    var starttime = $("#"+rel+"_plan_start_time").val();
    var endtime = $("#"+rel+"_plan_end_time").val();
    var planid = $("#"+rel+"_plan_id").val();
    if(starttime!=="00:00" && endtime!=="00:00"){
        startArr = starttime.split(":");
        endArr = endtime.split(":");
        diff = endArr[0]-startArr[0];
        $("#"+rel+"_break_time_span").html(diff+"hrs");
        extrahours = plan_shift_mapping[planid];
        extra = diff - extrahours;
        if(!isNaN(extra)){
            $("#"+rel+"_plan_extra_hours").val(extra);
        }
    }
});

$(".challan_options").change(function () {
    var rel = $(this).attr("rel");
    var value = $(this).val();
    var type =  plan_type_mapping[value];
    var amount = plan_amount_mapping[value];
    

    $("#"+rel+"_day_wise").hide();
    $("#"+rel+"_plan_trip").hide();
    $("#"+rel+"_from_destination").hide();
    $("#"+rel+"_plan_shift_type").hide();
    
    $("#challanform_items_0_plan_measure").hide();
    $("#challanform_items_0_to_destination").hide();
    $("#challanform_items_0_plan_extra_hours").hide();
    


    switch (type) {
        case "1":
            alert("1");
            $("#"+rel+"_plan_shift_type").hide();
            $("#"+rel+"_plan_extra_hours").hide();
            break;
        case "2":
            alert(2);
            $("#"+rel+"_break_time").show();
            $("#"+rel+"_up_time").show();
            $("#"+rel+"_plan_start_time").hide();
            $("#"+rel+"_plan_end_time").hide();
            $("#"+rel+"_day_wise").hide();
            $("#"+rel+"_plan_trip").hide();
            $("#"+rel+"_from_destination").hide();
            $("#"+rel+"_plan_measure").hide();
            $("#"+rel+"_to_destination").hide();
            $("#"+rel+"_plan_extra_hours").hide();
            $("#"+rel+"_day_wise").show();
            break;
        case "3":
            alert(3);
            $("#"+rel+"_break_time").show();
            $("#"+rel+"_up_time").show();
            $("#"+rel+"_plan_trip").show();
            $("#"+rel+"_plan_measure").show();
            $("#"+rel+"_plan_start_time").hide();
            $("#"+rel+"_day_wise").hide();
            $("#"+rel+"_plan_end_time").hide();
            $("#"+rel+"_from_destination").hide();
            $("#"+rel+"_plan_extra_hours").hide();
            break;
        case "4":
            alert("4");
            $("#"+rel+"_from_destination").show();
            $("#"+rel+"_to_destination").show();
            $("#"+rel+"_plan_start_time").hide();
            $("#"+rel+"_plan_end_time").hide();
            break;
        case "5":
            alert(5);
            $("#"+rel+"_break_time").show();
            $("#"+rel+"_up_time").show();
            $("#"+rel+"_plan_start_time").show();
            $("#"+rel+"_plan_end_time").show();
            $("#"+rel+"_day_wise").hide();
            $("#"+rel+"_plan_trip").hide();
            $("#"+rel+"_from_destination").hide();
            $("#"+rel+"_plan_measure").hide();
            $("#"+rel+"_to_destination").hide();
            $("#"+rel+"_plan_extra_hours").hide();
            break;
        case "6":
            alert(6);
            $("#"+rel+"_plan_start_time").show();
            $("#"+rel+"_plan_end_time").show();
            $("#"+rel+"_plan_shift_type").show();
            $("#"+rel+"_break_time").hide();
            $("#"+rel+"_up_time").hide();
            $("#"+rel+"_down_time").hide();
            $("#"+rel+"_day_wise").hide();
            $("#"+rel+"_plan_trip").hide();
            $("#"+rel+"_from_destination").hide();
            $("#"+rel+"_plan_measure").hide();
            $("#"+rel+"_to_destination").hide();
            $("#"+rel+"_plan_extra_hours").show();
            break;
    }
    $("#"+rel+"_amount").val(amount);
});
';

$this->registerJs($js, View::POS_READY);
