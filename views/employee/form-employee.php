<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\components\Constants as C;
use app\models\City;
use app\models\CompanyMaster;
use app\models\Department;

?>
<?php $form = ActiveForm::begin(['id' => 'form-department', 'options' => ['enctype' => 'multipart/form-data', 'class' => 'form-horizontal form-bordered']]); ?>

<div class="row">
    <div class="col-md-6">
        <div class="card card-secondary">
            <div class="card-header">
                <div class="card-title">
                    Employee Details
                </div>
            </div>
            <div class="card-body">
                <?= $form->field($model, 'name', ['options' => ['class' => 'form-group']])->begin() ?>
                <?= Html::activeLabel($model, 'name', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                <div class="col-lg-12 col-sm-12 col-xs-12">
                    <?= Html::activeTextInput($model, 'name', ['class' => 'form-control']) ?>
                    <?= Html::error($model, 'name', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'name')->end() ?>

                <?= $form->field($model, 'company_id', ['options' => ['class' => 'form-group']])->begin() ?>
                <?= Html::activeLabel($model, 'company_id', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                <div class="col-lg-12 col-sm-12 col-xs-12">
                    <?= Html::activeDropDownList($model, 'company_id', ArrayHelper::map(CompanyMaster::find()->active()->all(), 'id', 'name'), ['class' => 'form-control select2',"multiple"=>true]) ?>
                    <?= Html::error($model, 'company_id', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'company_id')->end() ?>

                <?= $form->field($model, 'department_id', ['options' => ['class' => 'form-group']])->begin() ?>
                <?= Html::activeLabel($model, 'department_id', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                <div class="col-lg-12 col-sm-12 col-xs-12">
                    <?= Html::activeDropDownList($model, 'department_id', ArrayHelper::map(Department::find()->active()->all(), 'id', 'name'), ['class' => 'form-control',"prompt"=>"Select one"]) ?>
                    <?= Html::error($model, 'department_id', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'department_id')->end() ?>

                <?= $form->field($model, 'email', ['options' => ['class' => 'form-group']])->begin() ?>
                <?= Html::activeLabel($model, 'email', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                <div class="col-lg-12 col-sm-12 col-xs-12">
                    <?= Html::activeTextInput($model, 'email', ['class' => 'form-control']) ?>
                    <?= Html::error($model, 'email', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'email')->end() ?>

                <?= $form->field($model, 'mobile_no', ['options' => ['class' => 'form-group']])->begin() ?>
                <?= Html::activeLabel($model, 'mobile_no', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                <div class="col-lg-12 col-sm-12 col-xs-12">
                    <?= Html::activeTextInput($model, 'mobile_no', ['class' => 'form-control', "maxlength" => 10, "minlength" => 10]) ?>
                    <?= Html::error($model, 'mobile_no', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'mobile_no')->end() ?>


                <?= $form->field($model, 'phone_no', ['options' => ['class' => 'form-group']])->begin() ?>
                <?= Html::activeLabel($model, 'phone_no', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                <div class="col-lg-12 col-sm-12 col-xs-12">
                    <?= Html::activeTextInput($model, 'phone_no', ['class' => 'form-control', "maxlength" => 10, "minlength" => 10]) ?>
                    <?= Html::error($model, 'phone_no', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'phone_no')->end() ?>

                <?= $form->field($model, 'status', ['options' => ['class' => "form-group"]])->begin(); ?>
                <?= Html::activeLabel($model, 'status', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']) ?>
                <div class="col-lg-12 col-sm-12 col-xs-12">
                    <?= Html::activeDropDownList($model, 'status', C::LABEL_STATUS, ['class' => 'form-control', "prompt" => "Select One"]) ?>
                    <?= Html::error($model, 'status', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'status')->end() ?>
            </div>
        </div>
        <div class="card card-secondary">
            <div class="card-header">
                <div class="card-title">
                    Credentials
                </div>
            </div>
            <div class="card-body">
            <?= $form->field($model, 'username', ['options' => ['class' => 'form-group']])->begin() ?>
                <?= Html::activeLabel($model, 'username', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                <div class="col-lg-12 col-sm-12 col-xs-12">
                    <?= Html::activeTextInput($model, 'username', ['class' => 'form-control']) ?>
                    <?= Html::error($model, 'username', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'username')->end() ?>

                <?= $form->field($model, 'password', ['options' => ['class' => 'form-group']])->begin() ?>
                <?= Html::activeLabel($model, 'password', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                <div class="col-lg-12 col-sm-12 col-xs-12">
                    <?= Html::activeTextInput($model, 'password', ['class' => 'form-control']) ?>
                    <?= Html::error($model, 'password', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'password')->end() ?>

                <?= $form->field($model, 'confirm_password', ['options' => ['class' => 'form-group']])->begin() ?>
                <?= Html::activeLabel($model, 'confirm_password', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                <div class="col-lg-12 col-sm-12 col-xs-12">
                    <?= Html::activeTextInput($model, 'confirm_password', ['class' => 'form-control']) ?>
                    <?= Html::error($model, 'confirm_password', ['class' => 'error help-block']) ?>
                </div>
                <?= $form->field($model, 'confirm_password')->end() ?>

            </div>
        </div>

    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-secondary">
                    <div class="card-header">
                        <div class="card-title">
                            Contact Details
                        </div>
                    </div>
                    <div class="card-body">
                        <?= $form->field($model, 'address', ['options' => ['class' => 'form-group']])->begin() ?>
                        <?= Html::activeLabel($model, 'address', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                        <div class="col-lg-12 col-sm-12 col-xs-12">
                            <?= Html::activeTextarea($model, 'address', ['class' => 'form-control']) ?>
                            <?= Html::error($model, 'address', ['class' => 'error help-block']) ?>
                        </div>
                        <?= $form->field($model, 'address')->end() ?>

                        <?= $form->field($model, 'city_id', ['options' => ['class' => 'form-group']])->begin() ?>
                        <?= Html::activeLabel($model, 'city_id', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                        <div class="col-lg-12 col-sm-12 col-xs-12">
                            <?= Html::activeDropDownList($model, 'city_id', ArrayHelper::map(City::find()->active()->all(), 'id', 'name'), ['class' => 'form-control',"prompt"=>'Select one']) ?>
                            <?= Html::error($model, 'city_id', ['class' => 'error help-block']) ?>
                        </div>
                        <?= $form->field($model, 'city_id')->end() ?>

                        <?= $form->field($model, 'pincode', ['options' => ['class' => 'form-group']])->begin() ?>
                        <?= Html::activeLabel($model, 'pincode', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                        <div class="col-lg-12 col-sm-12 col-xs-12">
                            <?= Html::activeTextInput($model, 'pincode', ['class' => 'form-control','minlength'=>6,'maxlength'=>6]) ?>
                            <?= Html::error($model, 'pincode', ['class' => 'error help-block']) ?>
                        </div>
                        <?= $form->field($model, 'pincode')->end() ?>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card card-secondary">
                    <div class="card-header">
                        <div class="card-title">
                            Job Details
                        </div>
                    </div>
                    <div class="card-body">
                        <?= $form->field($model, 'start_time', ['options' => ['class' => 'form-group']])->begin() ?>
                        <?= Html::activeLabel($model, 'start_time', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                        <div class="col-lg-12 col-sm-12 col-xs-12">
                            <?= Html::activeTextInput($model, 'start_time', ['class' => 'form-control timepick', "readonly" => true]) ?>
                            <?= Html::error($model, 'start_time', ['class' => 'error help-block']) ?>
                        </div>
                        <?= $form->field($model, 'start_time')->end() ?>


                        <?= $form->field($model, 'end_time', ['options' => ['class' => 'form-group']])->begin() ?>
                        <?= Html::activeLabel($model, 'end_time', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                        <div class="col-lg-12 col-sm-12 col-xs-12">
                            <?= Html::activeTextInput($model, 'end_time', ['class' => 'form-control timepick', "readonly" => true]) ?>
                            <?= Html::error($model, 'end_time', ['class' => 'error help-block']) ?>
                        </div>
                        <?= $form->field($model, 'end_time')->end() ?>

                        <?= $form->field($model, 'salary', ['options' => ['class' => 'form-group']])->begin() ?>
                        <?= Html::activeLabel($model, 'salary', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                        <div class="col-lg-12 col-sm-12 col-xs-12">
                            <?= Html::activeTextInput($model, 'salary', ['class' => 'form-control']) ?>
                            <?= Html::error($model, 'salary', ['class' => 'error help-block']) ?>
                        </div>
                        <?= $form->field($model, 'salary')->end() ?>

                        <?= $form->field($model, 'overtime_salary', ['options' => ['class' => 'form-group']])->begin() ?>
                        <?= Html::activeLabel($model, 'overtime_salary', ['class' => 'col-lg-12 col-sm-12 col-xs-12 control-label']); ?>
                        <div class="col-lg-12 col-sm-12 col-xs-12">
                            <?= Html::activeTextInput($model, 'overtime_salary', ['class' => 'form-control','placeholder'=>"Per Hour"]) ?>
                            <?= Html::error($model, 'overtime_salary', ['class' => 'error help-block']) ?>
                        </div>
                        <?= $form->field($model, 'overtime_salary')->end() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer mg-t-auto mg-d-10">
        <div class="row">
            <div class="col-lg-6 col-sm-6 col-xs-6 col-sm-offset-3">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-secondary']) ?>
            </div>
        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>