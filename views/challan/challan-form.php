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

?>
<?php $form = ActiveForm::begin(['id' => 'form-challan', 'options' => ['enctype' => 'multipart/form-data', 'class' => 'form-bordered',]]); ?>
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
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <?= $form->field($model, 'challan_date', ['options' => ['class' => 'form-group']])->begin() ?>
                        <?= Html::activeLabel($model, 'challan_date', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                        <?= Html::activeTextInput($model, 'challan_date', ['class' => 'form-control cal', 'id' => "challan_date"]) ?>
                        <?= Html::error($model, 'challan_date', ['class' => 'error help-block']) ?>
                        <?= $form->field($model, 'challan_date')->end() ?>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <?= $form->field($model, 'challan_no', ['options' => ['class' => 'form-group']])->begin() ?>
                        <?= Html::activeLabel($model, 'challan_no', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                        <?= Html::activeTextInput($model, 'challan_no', ['class' => 'form-control', 'id' => 'challan_no']) ?>
                        <?= Html::error($model, 'challan_no', ['class' => 'error help-block']) ?>
                        <?= $form->field($model, 'challan_no')->end() ?>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <?= $form->field($model, 'site_address', ['options' => ['class' => 'form-group']])->begin() ?>
                        <?= Html::activeLabel($model, 'site_address', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                        <?= Html::activeDropDownList($model, 'site_address',  ArrayHelper::map(ClientSite::find()->where(['client_id' => $model->client_id])->active()->all(), 'id', 'address'), ['class' => 'form-control', 'id' => "challanform_items_0_site_address", 'prompt' => "Select option"]) ?>
                        <?= Html::error($model, 'site_address', ['class' => 'error help-block']) ?>
                        <?= $form->field($model, 'site_address')->end() ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <?= $form->field($model, 'helper_id', ['options' => ['class' => 'form-group']])->begin() ?>
                        <?= Html::activeLabel($model, 'helper_id', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                        <?= Html::activeDropDownList($model, 'helper_id', ArrayHelper::map(EmployeeMaster::find()->active()->all(), 'id', 'name'), ['class' => 'form-control', 'id' => "challanform_items_0_helper_id", 'prompt' => "Select option"]) ?>
                        <?= Html::error($model, 'helper_id', ['class' => 'error help-block']) ?>
                        <?= $form->field($model, 'helper_id')->end() ?>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <?= $form->field($model, 'operator_id', ['options' => ['class' => 'form-group']])->begin() ?>
                        <?= Html::activeLabel($model, 'operator_id', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                        <?= Html::activeDropDownList($model, 'operator_id',  ArrayHelper::map(EmployeeMaster::find()->active()->all(), 'id', 'name'), ['class' => 'form-control', 'prompt' => "Select option"]) ?>
                        <?= Html::error($model, 'operator_id', ['class' => 'error help-block']) ?>
                        <?= $form->field($model, 'operator_id')->end() ?>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <?= $form->field($model, 'vehicle_id', ['options' => ['class' => 'form-group']])->begin() ?>
                        <?= Html::activeLabel($model, 'vehicle_id', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                        <?= Html::activeDropDownList($model, 'vehicle_id', ArrayHelper::map(VehicleMaster::find()->active()->all(), 'id', 'name'), ['class' => 'form-control', 'id' => 'challanform_items_0_vehicle_id', 'prompt' => "Select option"]) ?>
                        <?= Html::error($model, 'vehicle_id', ['class' => 'error help-block']) ?>
                        <?= $form->field($model, 'vehicle_id')->end() ?>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <?= $form->field($model, 'plan_id', ['options' => ['class' => 'form-group']])->begin() ?>
                        <?= Html::activeLabel($model, 'plan_id', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                        <?= Html::activeDropDownList($model, 'plan_id', ArrayHelper::map(PlanMaster::find()->active()->all(), 'id', function($p){ 
                                return $p->name.(!empty($p->shift_hrs)?" (".$p->shift_hrs."hr)":"");
                                }), ['class' => 'form-control challan_options', 'prompt' => "Select option"]) ?>
                        <?= Html::error($model, 'plan_id', ['class' => 'error help-block']) ?>
                        <?= $form->field($model, 'plan_id')->end() ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <?= $form->field($model, 'plan_start_time', ['options' => ['class' => 'form-group', "id" => "plan_start_time"]])->begin() ?>
                        <?= Html::activeLabel($model, 'plan_start_time', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                        <?= Html::activeTextInput($model, 'plan_start_time', ['class' => 'form-control timepick caldiff']) ?>
                        <?= Html::error($model, 'plan_start_time', ['class' => 'error help-block']) ?>
                        <?= $form->field($model, 'plan_start_time')->end() ?>

                        <?= $form->field($model, 'day_wise', ['options' => ['class' => 'form-group', "id" => 'day_wise']])->begin() ?>
                        <?= Html::activeLabel($model, 'day_wise', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                        <?= Html::activeDropDownList($model, 'day_wise', C::DAYWISE_LABEL, ['class' => 'form-control hide', 'prompt' => "Select option"]) ?>
                        <?= Html::error($model, 'day_wise', ['class' => 'error help-block']) ?>
                        <?= $form->field($model, 'day_wise')->end() ?>

                        <?= $form->field($model, 'plan_trip', ['options' => ['class' => 'form-group', "id" => "plan_trip"]])->begin() ?>
                        <?= Html::activeLabel($model, 'plan_trip', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                        <?= Html::activeTextInput($model, 'plan_trip', ['class' => 'form-control hide', "placeholder" => "Trip/Quantity"]) ?>
                        <?= Html::error($model, 'plan_trip', ['class' => 'error help-block']) ?>
                        <?= $form->field($model, 'plan_trip')->end() ?>

                        <?= $form->field($model, 'from_destination', ['options' => ['class' => 'form-group', "id" => "from_destination"]])->begin() ?>
                        <?= Html::activeLabel($model, 'from_destination', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                        <?= Html::activeTextInput($model, 'from_destination', ['class' => 'form-control hide', "placeholder" => "From Destination"]) ?>
                        <?= Html::error($model, 'from_destination', ['class' => 'error help-block']) ?>
                        <?= $form->field($model, 'from_destination')->end() ?>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <?= $form->field($model, 'plan_end_time', ['options' => ['class' => 'form-group', 'id' => "plan_end_time"]])->begin() ?>
                        <?= Html::activeLabel($model, 'plan_end_time', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                        <?= Html::activeTextInput($model, 'plan_end_time', ['class' => 'form-control timepick caldiff']) ?>
                        <?= Html::error($model, 'plan_end_time', ['class' => 'error help-block']) ?>
                        <?= $form->field($model, 'plan_end_time')->end() ?>

                        <?= $form->field($model, 'plan_measure', ['options' => ['class' => 'form-group', "id" => "plan_measure"]])->begin() ?>
                        <?= Html::activeLabel($model, 'plan_measure', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                        <?= Html::activeTextInput($model, 'plan_measure', ['class' => 'form-control hide', "placeholder" => 'Brass/Litre']) ?>
                        <?= Html::error($model, 'plan_measure', ['class' => 'error help-block']) ?>
                        <?= $form->field($model, 'plan_measure')->end() ?>

                        <?= $form->field($model, 'to_destination', ['options' => ['class' => 'form-group', 'id' => "to_destination"]])->begin() ?>
                        <?= Html::activeLabel($model, 'to_destination', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                        <?= Html::activeTextInput($model, 'to_destination', ['class' => 'form-control hide', "placeholder" => "To Destination"]) ?>
                        <?= Html::error($model, 'to_destination', ['class' => 'error help-block']) ?>
                        <?= $form->field($model, 'to_destination')->end() ?>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <?= $form->field($model, 'amount', ['options' => ['class' => 'form-group']])->begin() ?>
                        <?= Html::activeLabel($model, 'amount', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                        <?= Html::activeTextInput($model, 'amount', ['class' => 'form-control', 'id' => 'amount']) ?>
                        <?= Html::error($model, 'amount', ['class' => 'error help-block']) ?>
                        <?= $form->field($model, 'amount')->end() ?>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <?= $form->field($model, 'break_time', ['options' => ['class' => 'form-group', "id" => "break_time"]])->begin() ?>
                        <?= Html::activeLabel($model, 'break_time', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                        <?= Html::activeDropDownList($model, 'break_time', C::getTimeList(), ['class' => 'form-control', 'prompt' => "Select option"]) ?>
                        <?= Html::error($model, 'break_time', ['class' => 'error help-block']) ?>
                        <?= $form->field($model, 'break_time')->end() ?>
                        <span id="break_time_span"></span>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <?= $form->field($model, 'up_time', ['options' => ['class' => 'form-group', "id" => "up_time"]])->begin() ?>
                        <?= Html::activeLabel($model, 'up_time', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                        <?= Html::activeDropDownList($model, 'up_time', C::getTimeList(), ['class' => 'form-control', 'prompt' => "Select option"]) ?>
                        <?= Html::error($model, 'up_time', ['class' => 'error help-block']) ?>
                        <?= $form->field($model, 'up_time')->end() ?>

                        <?= $form->field($model, 'plan_extra_hours', ['options' => ['class' => 'form-group', "id" => "plan_extra_hours"]])->begin() ?>
                        <?= Html::activeLabel($model, 'plan_extra_hours', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                        <?= Html::activeTextInput($model, 'plan_extra_hours', ['class' => 'form-control', "placeholder" => "Extra Hours"]) ?>
                        <?= Html::error($model, 'plan_extra_hours', ['class' => 'error help-block']) ?>
                        <?= $form->field($model, 'plan_extra_hours')->end() ?>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <?= $form->field($model, 'down_time', ['options' => ['class' => 'form-group', "id" => "down_time"]])->begin() ?>
                        <?= Html::activeLabel($model, 'down_time', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                        <?= Html::activeDropDownList($model, 'down_time', C::getTimeList(), ['class' => 'form-control', 'prompt' => "Select option"]) ?>
                        <?= Html::error($model, 'down_time', ['class' => 'error help-block']) ?>
                        <?= $form->field($model, 'down_time')->end() ?>

                        <?= $form->field($model, 'plan_shift_type', ['options' => ['class' => 'form-group', "id" => "plan_shift_type"]])->begin() ?>
                        <?= Html::activeLabel($model, 'plan_shift_type', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                        <?= Html::activeDropDownList($model, 'plan_shift_type', C::PACKAGE_SHIFT_TYPE, ['class' => 'form-control']) ?>
                        <?= Html::error($model, 'plan_shift_type', ['class' => 'error help-block']) ?>
                        <?= $form->field($model, 'plan_shift_type')->end() ?>
                        </td>
                    </div>
                </div>
            </div>
            <div class="card-footer mg-t-auto mg-d-10">
                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-xs-12 col-sm-offset-3">
                        <?= Html::submitButton('Create', ['class' => 'btn btn-secondary']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>

<?php $form = ActiveForm::begin(['id' => 'inactive-form-challan', 'options' => ['enctype' => 'multipart/form-data', 'class' => 'form-bordered']]); ?>
<?= ImsGridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            "attribute" => "challan_date",
            "content" => function ($model) {
                return $model->challan_date;
            },
        ],
        [
            "attribute" => "challan_no", "label" => "Challan No",
            "content" => function ($model) use ($base_controller) {
                return  Html::a($model->challan_no, \Yii::$app->urlManager->createUrl(["{$base_controller}/print-challan", 'id' => $model->id]), ['title' => 'Print ' . $model->challan_no,]);
            },
        ],
        [
            'attribute' => 'plan_id', 'label' => 'Plan',
            'content' => function ($model) {
                return !empty($model->plan) ? $model->plan->name : "";
            },
            'filter' => ArrayHelper::map(PlanMaster::find()->active()->all(), 'id', 'name'),
        ],
        [
            'attribute' => 'id', 'label' => 'D/C No',
            'content' => function ($model) {
                return $model->id;
            },
        ],
        [
            "attribute" => "", "label" => "Total Hours/Qty",
            'content' => function ($model) {
                return $model->plan->type == C::PACKAGE_WISE_TRIP ? $model->plan_trip : date('H:i', mktime(0, (strtotime($model->plan_end_time) - strtotime($model->plan_start_time)) / 60));
            }
        ],
        "plan_start_time",
        "plan_end_time",
        "break_time",
        "up_time",
        "down_time",
        [
            'attribute' => 'base_amount', 'label' => 'Rate',
            'content' => function ($model) {
                return $model->base_amount;
            },
        ],
        "amount",
        [
            "label" => "Action",
            "content" => function ($data) {
                return  Html::a(Html::tag('span', '', ['class' => 'fa fa-trash']), \Yii::$app->urlManager->createUrl(["client/delete-challan-ajax", 'id' => $data['id']]), ['title' => 'Delete ' . $data['challan_no'], 'class' => 'btn btn-primary-alt']);
            }
        ]
    ],
]); ?>

<?php ActiveForm::end(); ?>

<?php

$plans = PlanMaster::find()->active()->asArray()->all();
$customPlan = ClientPlanMapping::find()->where(["client_id" => $model->client_id])->indexBy('plan_id')->asArray()->all();

$plan_amount_mapping = $plan_type_mapping = $plan_shift_mapping = [];
foreach ($plans as $plan) {
    $plan_type_mapping[$plan["id"]] = $plan['type'];
    $plan_amount_mapping[$plan["id"]] =  !empty($customPlan[$plan["id"]]) ? $customPlan[$plan["id"]]["custom_price"] : $plan['price'];
    if ($plan['type'] == C::PACKAGE_WISE_SHIFT) {
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
$("#day_wise").hide();
$("#plan_trip").hide();
$("#from_destination").hide();
$("#plan_shift_type").hide();

$("#plan_measure").hide();
$("#to_destination").hide();
$("#plan_extra_hours").hide();
';

if (!empty($model->plan_id)) {
    if ($plan_type_mapping[$model->plan_id] == C::PACKAGE_WISE_CHALLAN) {
        $js .= '$("#plan_shift_type").hide();
    $("#plan_extra_hours").hide();';
    } else if ($plan_type_mapping[$model->plan_id] == C::PACKAGE_WISE_DAY) {

        $js .= ' $("#break_time").show();
    $("#up_time").show();
    $("#plan_start_time").hide();
    $("#plan_end_time").hide();
    $("#day_wise").hide();
    $("#plan_trip").hide();
    $("#from_destination").hide();
    $("#plan_measure").hide();
    $("#to_destination").hide();
    $("#plan_extra_hours").hide();
    $("#day_wise").show();';
    } else if ($plan_type_mapping[$model->plan_id] == C::PACKAGE_WISE_TRIP) {
        $js .= '
    $("#break_time").show();
    $("#up_time").show();
    $("#plan_trip").show();
    $("#plan_measure").show();
    $("#plan_start_time").hide();
    $("#day_wise").hide();
    $("#plan_end_time").hide();
    $("#from_destination").hide();
    $("#plan_extra_hours").hide();';
    } else if ($plan_type_mapping[$model->plan_id] == C::PACKAGE_WISE_DESTINATION) {
        $js .= '
    $("#from_destination").show();
    $("#to_destination").show();
    $("#plan_start_time").hide();
    $("#plan_end_time").hide();';
    } else if ($plan_type_mapping[$model->plan_id] == C::PACKAGE_WISE_MONTH) {
        $js .= '$("#break_time").show();
    $("#up_time").show();
    $("#plan_start_time").show();
    $("#plan_end_time").show();
    $("#day_wise").hide();
    $("#plan_trip").hide();
    $("#from_destination").hide();
    $("#plan_measure").hide();
    $("#to_destination").hide();
    $("#plan_extra_hours").hide();';
    } else if ($plan_type_mapping[$model->plan_id] == C::PACKAGE_WISE_SHIFT) {
        $js .= '$("#plan_start_time").show();
    $("#plan_end_time").show();
    $("#plan_shift_type").show();
    $("#break_time").hide();
    $("#up_time").hide();
    $("#down_time").hide();
    $("#day_wise").hide();
    $("#plan_trip").hide();
    $("#from_destination").hide();
    $("#plan_measure").hide();
    $("#to_destination").hide();
    $("#plan_extra_hours").show();';
    }
}
$js .= '
$(".caldiff").change(function(){
    var starttime = $("#challanform-plan_start_time").val();
    var endtime = $("#challanform-plan_end_time").val();
    var planid = $("#challanform-plan_id").val();
    if(starttime!=="00:00" && endtime!=="00:00"){
        startArr = starttime.split(":");
        endArr = endtime.split(":");
        diff = endArr[0]-startArr[0];
        $("#break_time_span").html(diff+"hrs");
        extrahours = plan_shift_mapping[planid];
        extra = diff - extrahours;
        if(!isNaN(extra)){
            $("#challanform-plan_extra_hours").val(extra);
        }
    }
});

$("body").on("change", ".challan_options",function () {
    var value = $(this).val();
    var type =  plan_type_mapping[value];
    var amount = plan_amount_mapping[value];
    
    $("#day_wise").hide();
    $("#plan_trip").hide();
    $("#from_destination").hide();
    $("#plan_shift_type").hide();
    $("#plan_measure").hide();
    $("#to_destination").hide();
    $("#plan_extra_hours").hide();
    
    switch (type) {
        case "1":
            $("#plan_shift_type").hide();
            $("#plan_extra_hours").hide();
            break;
        case "2":
            $("#break_time").show();
            $("#up_time").show();
            $("#plan_start_time").hide();
            $("#plan_end_time").hide();
            $("#day_wise").hide();
            $("#plan_trip").hide();
            $("#from_destination").hide();
            $("#plan_measure").hide();
            $("#to_destination").hide();
            $("#plan_extra_hours").hide();
            $("#day_wise").show();
            break;
        case "3":
            $("#break_time").show();
            $("#up_time").show();
            $("#plan_trip").show();
            $("#plan_measure").show();
            $("#plan_start_time").hide();
            $("#day_wise").hide();
            $("#plan_end_time").hide();
            $("#from_destination").hide();
            $("#plan_extra_hours").hide();
            break;
        case "4":
            $("#from_destination").show();
            $("#to_destination").show();
            $("#plan_start_time").hide();
            $("#plan_end_time").hide();
            break;
        case "5":
            $("#break_time").show();
            $("#up_time").show();
            $("#plan_start_time").show();
            $("#plan_end_time").show();
            $("#day_wise").hide();
            $("#plan_trip").hide();
            $("#from_destination").hide();
            $("#plan_measure").hide();
            $("#to_destination").hide();
            $("#plan_extra_hours").hide();
            break;
        case "6":
            $("#plan_start_time").show();
            $("#plan_end_time").show();
            $("#plan_shift_type").show();
            $("#break_time").hide();
            $("#up_time").hide();
            $("#down_time").hide();
            $("#day_wise").hide();
            $("#plan_trip").hide();
            $("#from_destination").hide();
            $("#plan_measure").hide();
            $("#to_destination").hide();
            $("#plan_extra_hours").show();
            break;
    }
    $("#amount").val(amount);
});
';

$this->registerJs($js, View::POS_READY);
