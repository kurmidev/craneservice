<?php


use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\components\Constants as C;
use app\components\ConstFunc as F;
use app\models\City;
use app\models\CompanyMaster;
use app\models\Department;

?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title"></h3>
        <div class="card-tools">
            <?= Html::a(Html::tag('span', '', ['class' => 'fa fa-plus']), \Yii::$app->urlManager->createUrl(['employee/add-employee']), ['title' => 'Add New Employee', 'class' => 'btn btn-primary btn-sm']) ?>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <?php Pjax::begin(); ?>
            <?php // echo $this->render('_search', ['model' => $searchModel]); 
            ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'name',
                    [
                        'label' => 'Company',
                        'content' => function ($model) {
                            return !empty($model->companyMapping) ? implode(", ",ArrayHelper::getColumn($model->companyMapping,"company.name")) : "";
                        },
                        'filter' => ArrayHelper::map(CompanyMaster::find()->active()->all(), 'id', 'name'),
                    ],
                    [
                        'attribute' => 'department_id', 'label' => 'Department',
                        'content' => function ($model) {
                            return !empty($model->department) ? $model->department->name : "";
                        },
                        'filter' => ArrayHelper::map(Department::find()->active()->all(), 'id', 'name'),
                    ],
                    'email:email',
                    'phone_no',
                    'start_time',
                    'end_time',
                    'salary',
                    //'overtime_salary',
                    //'address',
                    [
                        'attribute' => 'city_id', 'label' => 'City',
                        'content' => function ($model) {
                            return !empty($model->city) ? $model->city->name : "";
                        },
                        'filter' => ArrayHelper::map(City::find()->active()->all(), 'id', 'name'),
                    ],
                    //'pincode',
                    [
                        'attribute' => 'status', 'label' => 'Status',
                        'content' => function ($model) {
                            return F::getLabels(C::LABEL_STATUS, $model->status);
                        },
                        'filter' => C::LABEL_STATUS,
                    ],
                    'actionOn',
                    'actionBy',
                    [
                        "label" => "Action",
                        "content" => function ($data) {
                            return Html::a(Html::tag('span', '', ['class' => 'fa fa-edit']), \Yii::$app->urlManager->createUrl(['employee/edit-employee', 'id' => $data['id']]), ['title' => 'Update ' . $data['name'], 'class' => 'btn btn-primary-alt']);
                        }
                    ]
                ],
            ]); ?>


            <?php Pjax::end(); ?>
        </div>
    </div>
</div>