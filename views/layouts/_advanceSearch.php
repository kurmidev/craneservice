<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$result = [];

foreach ($search as $s) {
    $field = "";
    switch ($s['type']) {
        case "text":
            $field = Html::activeTextInput($model, $s['attribute'], ['class' => "form-control", "placeholder" => "Enter " . $s['label']]);
            break;
        case "dropdown":
            $field = Html::activeDropDownList($model, $s['attribute'], $s['list'], ['class' => "form-control chosen-select", "prompt" => "select " . $s['label']]);
            break;
        case "date_range":
            $f = Html::activeTextInput($model, $s['attribute'] . "_start", ['class' => "form-control col-md-4 cal", "placeholder" => "Select " . $s['label'] . " start"]);
            $f .= "&nbsp;&nbsp;";
            $f .= Html::activeTextInput($model, $s['attribute'] . "_end", ['class' => "form-control col-md-4 cal", "placeholder" => "Select " . $s['label'] . " end"]);

            $field = Html::tag("div",$f, ["class" => "row"]);
          
            break;
        case "date":
            $field = Html::activeTextInput($model, $s['attribute'], ['class' => "form-control cal", "placeholder" => "select " . $s['label']]);
            break;
    }
    $label = Html::tag("label", $s['label'], ['class' => "form-control-label"]);
    $r = Html::tag("div", $label . $field, ['class' => "form-group"]);
    $result[] = Html::tag("div", $r, ['class' => "col-md-4"]);
}

$show_hide = Html::button('<div><i class="fa fa-search" title="Search"></i></div>', ["class" => "btn btn-dark btn-icon rounded-circle mg-r-5 mg-b-10 float-right", "onclick" => '$(".searchd").toggle()']);
$submit = Html::submitButton("Search", ["class" => "btn btn-info mr-10"]);
$reset = Html::button("Reset", ["class" => "btn btn-info ml-10", "onclick" => "$('#form-search:input')
  .not(':button, :submit, :reset, :hidden').val('').prop('checked', false).prop('selected', false);"]);

$reset = Html::a("Reset", Yii::$app->urlManager->createUrl(Yii::$app->controller->id . "/" . Yii::$app->controller->action->id), ["class" => "btn btn-info ml-10"]);
$submit = Html::tag("div", $submit . '&nbsp;' . $reset, ["class" => "form-layout-footer bd pd-20 bd-t-0"]);

$searchBody = Html::tag("div",
                Html::tag("div", implode("", $result), ['class' => "row"]) .
                $submit, ["class" => "card-body p-10 searchd"]
);

$form = ActiveForm::begin(['id' => 'form-search', 'method' => 'get', 'options' => ['enctype' => 'mutipart/form-data']]);

$header = Html::tag("div",Html::tag("h3", "Search", ["class" => "card-title"]).$show_hide, ['class' => "card-header","width"=>"100%"]);
echo Html::tag("div",
        $header.
        $searchBody, ['class' => "card"]);

ActiveForm::end();
