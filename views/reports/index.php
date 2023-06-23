<?php

use app\components\ImsGridView;
use yii\bootstrap5\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\CitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = $title;
$this->params['breadcrumbs'][] = $this->title;
$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";  
$CurPageURL = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']."&is_pdf=1";  
?>

<?php if(!$is_pdf){?>
<?= $this->render('@app/views/layouts/_advanceSearch', ['search' => $search, 'model' => $searchModel]) ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
        <?=!empty($amount)?("Total :". CURRENCY_SYMBOL." ".$amount):"" ?>
        </h3>
        <div class="card-tools">
            <?= Html::a(Html::tag('span', '', ['class' => 'fa fa-download']),$CurPageURL, ['title' => 'Export', 'class' => 'btn btn-primary btn-sm']) ?>
        </div>
    </div>
</div>
<?php  } ?>


<?=
ImsGridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => $columns,
]);
?>