<?php 

$i=1;

?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title"> <?= $title ?></h3>
    </div>
    <div class="card-body p-0">
        <table class="table">
            <tbody>
                <?php
                
                foreach($response as $name=>$count){ 
                    if($i%2==1){
                        echo "<tr>";
                    }    
                    echo "<td>";
                        echo "<h4>".$count."</h3>";
                        echo "<br>";
                        echo ucwords(str_replace("_"," ",$name)) ;
                    echo "</td>";
            
                    if($i%2==0){
                        echo "</tr>";
                    }
                    $i++;
                } 
                ?>
            </tbody>
        </table>
    </div>
</div>