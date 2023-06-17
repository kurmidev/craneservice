<?php

use app\forms\SearchForm;
use yii\widgets\ActiveForm;
use yii\bootstrap5\Html;
?>


<ul class="navbar-nav ml-auto">
    <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
            <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block" style="display: none;">
            <?php $form = ActiveForm::begin(['id' => 'form-search', "action" => Yii::$app->urlManager->createUrl(['site/search']), 'options' => ['enctype' => 'mutipart/form-data', 'class' => 'form-inline']]); ?>
            <div class="input-group input-group-sm">
                <?= Html::activeDropDownList($model, 'search_type', SearchForm::SEARCH_TYPE_LIST, ["class" => "form-control form-control-navbar","prompt"=>"search by"]) ?>
                <?= Html::activeTextInput($model, "search_value", ["class" => "form-control form-control-navbar", "placeholder" => "Search", "aria-label" => "Search"]) ?>
                <div class="input-group-append">
                    <?= Html::activeHiddenInput($model, 'current_page', ["value" => urlencode($_SERVER["REQUEST_URI"])]) ?>
                    <?= Html::submitButton('<i class="fas fa-search"></i>', ["class" => "btn btn-navbar"]) ?>
                    <?= Html::submitButton('<i class="fas fa-times"></i>', ["class" => "btn btn-navbar", "data-widget" => "navbar-search"]) ?>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </li>

</ul>