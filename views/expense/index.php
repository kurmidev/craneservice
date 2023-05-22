<?php


use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\components\Constants as C;
use app\components\ConstFunc as F;

$title = $type == C::EXPENSE_TYPE_NORMAL ? ' Expenses' : 'Staff Expenses';
$addUrl = $type == C::EXPENSE_TYPE_NORMAL ? 'expense/add-expenses' : 'expense/add-staffexpenses';

?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title"></h3>
        <div class="card-tools">
            <?= Html::a(Html::tag('span', '', ['class' => 'fa fa-plus']), \Yii::$app->urlManager->createUrl([$addUrl]), ['title' => "Add New {$title} ", 'class' => 'btn btn-primary btn-sm']) ?>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <?php // echo $this->render('_search', ['model' => $searchModel]); 
            ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'date',
                    [
                        "attribute" => "voucher_no", "label" => "Voucher No",
                        'content' => function ($model) {
                            return Html::a($model->voucher_no, \Yii::$app->urlManager->createUrl(["expense/print-expense", 'id' => $model->id]), ["target" => "_blank"]);
                        }
                    ],
                    'against_bill_no',
                    [
                        "attribute" => '', 'label' => $type == C::EXPENSE_TYPE_NORMAL ? 'Vendor' : 'Staff',
                        'content' => function ($model) {
                            if ($model->expense_type == C::EXPENSE_TYPE_NORMAL) {
                                return !empty($model->vendor) ? $model->vendor->company_name : "";
                            } else {
                                return !empty($model->staff) ? $model->staff->name : "";
                            }
                        }
                    ],
                    "quantity",
                    "total",
                    'actionOn',
                    'actionBy',
                    [
                        "label" => "Action",
                        "content" => function ($data)  use ($type) {
                            $url = $type == C::EXPENSE_TYPE_NORMAL ? 'expense/edit-expenses' : 'expense/edit-staffexpenses';
                            return Html::a(Html::tag('span', '', ['class' => 'fa fa-edit']), \Yii::$app->urlManager->createUrl([$url, 'id' => $data['id']]), ['title' => 'Update ' . $data['voucher_no'], 'class' => 'btn btn-primary-alt']);
                        }
                    ]
                ],
            ]); ?>
        </div>
    </div>
</div>