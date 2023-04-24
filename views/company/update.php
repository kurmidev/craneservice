<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\CompanyMaster $model */

$this->title = 'Update Company Master: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Company Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="company-master-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
