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
use app\models\PlanAttributes;
use app\models\State;



?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title"></h3>
        <div class="card-tools">
            <?= Html::a(Html::tag('span', '', ['class' => 'fa fa-plus']), \Yii::$app->urlManager->createUrl([$addUrl]), ['title' => "Add New {$title} ", 'class' => 'btn btn-primary btn-sm']) ?>
        </div>
    </div>
    <div class="card-body p-0">
        <?php Pjax::begin(); ?>
        <?php // echo $this->render('_search', ['model' => $searchModel]); 
        ?>
    
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'company_id', 'label' => 'Company',
                    'content' => function ($model) {
                        return !empty($model->company) ? $model->company->name : "";
                    },
                    'filter' => ArrayHelper::map(CompanyMaster::find()->active()->all(), 'id', 'name'),
                ],
                'company_name',
                'first_name',
                //'last_name',
                'email:email',
                'mobile_no',
                //'phone_no',
                'address',
                [
                    'attribute' => 'city_id', 'label' => 'City',
                    'content' => function ($model) {
                        return !empty($model->city) ? $model->city->name : "";
                    },
                    'filter' => ArrayHelper::map(City::find()->active()->all(), 'id', 'name'),
                ],
                //'pincode',
                //'site_address',
                //'site_city_id',
                //'site_pincode',
                //'type',
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
                    "content" => function ($data) use ($seditUrl) {
                        return Html::a(Html::tag('span', '', ['class' => 'fa fa-edit']), \Yii::$app->urlManager->createUrl([$seditUrl, 'id' => $data['id']]), ['title' => "Update Record", 'class' => 'btn btn-primary-alt']);
                    }
                ]
            ],
        ]); ?>

        <?php Pjax::end(); ?>
    </div>
</div>