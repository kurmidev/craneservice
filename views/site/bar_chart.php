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
var stackedBarChartCanvas = $("#"'.$response['id'].').get(0).getContext("2d")
var stackedBarChartData = $.extend(true, {}, barChartData)

var stackedBarChartOptions = {
  responsive              : true,
  maintainAspectRatio     : false,
  scales: {
    xAxes: [{
      stacked: true,
    }],
    yAxes: [{
      stacked: true
    }]
  }
}

new Chart(stackedBarChartCanvas, {
  type: "bar",
  data: stackedBarChartData,
  options: stackedBarChartOptions
})
})
';

$this->registerJs($js, yii\web\View::POS_READY);   
    ?> 
    