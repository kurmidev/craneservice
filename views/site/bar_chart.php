<?php

use yii\helpers\ArrayHelper;

$invoice_month = [];
if(!empty($response)){
  $invm = ArrayHelper::getColumn($response['invoice'],'invoice_month');
  foreach($invm as $d){
    $invoice_month[date("M y",strtotime($d))] = date("M y",strtotime($d));
  }

  $invm = ArrayHelper::getColumn($response['invoice_gst'],'invoice_month');
  foreach($invm as $d){
    $invoice_month[date("M y",strtotime($d))] = date("M y",strtotime($d));
  }

  $gstInvoice = ArrayHelper::getColumn($response['invoice_gst'],'pending_amount',false);
  $performaInvoice = ArrayHelper::getColumn($response['invoice'],'pending_amount',false);
}

?>
<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title"><?=$title?></h3>
    </div>
    <div class="card-body">
        <div class="chart">
            <canvas id="<?=$response["id"]?>" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
        </div>
    </div>
</div>

<?php

$js = '


var areaChartData = {
  labels  : ["'.implode('","',$invoice_month).'"],
  datasets: [
    {
      label               : "Performa",
      backgroundColor     : "rgba(60,141,188,0.9)",
      borderColor         : "rgba(60,141,188,0.8)",
      pointRadius          : false,
      pointColor          :  "#3b8bba",
      pointStrokeColor    : "rgba(60,141,188,1)",
      pointHighlightFill  : "#fff",
      pointHighlightStroke: "rgba(60,141,188,1)",
      data                : ['.implode(',',$performaInvoice).']
    },
    {
      label               : "GST Invoice",
      backgroundColor     : "rgba(210, 214, 222, 1)",
      borderColor         : "rgba(210, 214, 222, 1)",
      pointRadius         : false,
      pointColor          : "rgba(210, 214, 222, 1)",
      pointStrokeColor    : "#c1c7d1",
      pointHighlightFill  : "#fff",
      pointHighlightStroke: "rgba(220,220,220,1)",
      data                : ['.implode(',',$gstInvoice).']
    },
  ]
};

var stackedBarChartCanvas = $("#'.$response['id'].'").get(0).getContext("2d")
var barChartCanvas = $("#'.$response["id"].'").get(0).getContext("2d")
    var barChartData = $.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    var temp1 = areaChartData.datasets[1]
    barChartData.datasets[0] = temp1
    barChartData.datasets[1] = temp0

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    new Chart(barChartCanvas, {
      type: "bar",
      data: barChartData,
      options: barChartOptions
    })

';

$this->registerJs($js, yii\web\View::POS_READY);   
    ?> 
    