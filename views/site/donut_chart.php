
<div class="card card-primary">
    <div class="card-header">
        <h3 class="header-title"><?=$title?></h3>
    </div>
    <div class="card-body">
        <canvas id="<?=$response['id']?>" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
    </div>
</div>


<?php

$js = '
        var donutChartCanvas = $("#'.$response['id'].'").get(0).getContext("2d")
    var donutData        = {
      labels: ["'.implode('","',$response['labels']).'"],
      datasets: [
        {
          data: ['.implode(',',$response['dataset']).'],
          backgroundColor : ["'.implode('","',$response['color']).'"],
        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(donutChartCanvas, {
      type: "doughnut",
      data: donutData,
      options: donutOptions
    })';

    $this->registerJs($js, yii\web\View::POS_READY);   
    ?> 
        
        