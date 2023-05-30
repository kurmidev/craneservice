<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\components\Constants as C;
use app\models\ClientPlanMapping;
use app\models\PlanMaster;

$clientList = ClientPlanMapping::find()->andWhere(['client_id' => $model->client_id])->indexBy('plan_id')->asArray()->all();
$planObj = PlanMaster::find()->active();
if(empty($model->id)){
    $planObj->andWhere(['not', ['id' => array_values($clientList)]]);
}

$planList = $planObj->asArray()->all()
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <?= ($model->isNewRecord ? "Add Custom Price" : "Update Custom Price") ?>
                </div>
            </div>
            <div class="card-body">
                <?php $form = ActiveForm::begin(['id' => 'form-custom-price', 'options' => ['enctype' => 'multipart/form-data', 'class' => 'form-horizontal form-bordered']]); ?>

                <?= $form->field($model, 'plan_id', ['options' => ['class' => 'form-group']])->begin() ?>
                <?= Html::activeLabel($model, 'plan_id', ['class' => 'col-lg-3 col-sm-3 col-xs-3 control-label']); ?>
                <div class="col-lg-6 col-sm-6 col-xs-6">
                    <?= Html::activeDropDownList($model, 'plan_id', ArrayHelper::map($planList, 'id', 'name'), ['class' => 'form-control','prompt'=>"Select one"]) ?>
                    <?= Html::error($model, 'plan_id', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'plan_id')->end() ?>

                <?= $form->field($model, 'custom_price', ['options' => ['class' => "form-group"]])->begin(); ?>
                <?= Html::activeLabel($model, 'custom_price', ['class' => 'col-lg-3 col-sm-3 col-xs-3 control-label']) ?>
                <div class="col-lg-6 col-sm-6 col-xs-6">
                    <?= Html::activeTextInput($model, 'custom_price', ['class' => 'form-control']) ?>
                    <?= Html::error($model, 'custom_price', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'custom_price')->end() ?>

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