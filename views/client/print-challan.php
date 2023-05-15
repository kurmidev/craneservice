<?php

use app\components\Constants as C;

?>

<div class="invoice p-3 mb-3">


    <div class="row">
        <div class="col-12">
            <h4>
                <i class="fas fa-globe"></i> <?= SITE_NAME ?>
                <small class="float-right">Date: <?= date("d/m/Y") ?></small>
            </h4>
        </div>

    </div>

    <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
            From
            <address>
                <strong><?= SITE_NAME ?></strong><br>
                <?= SITE_ADDRESS ?>
                Phone: <?= SITE_PHONE ?><br>
                Email: <?= SITE_EMAIL ?>
            </address>
        </div>

        <div class="col-sm-4 invoice-col">
            To
            <address>
                <strong><?= $model->client->company_name ?></strong><br>
                <?= $model->client->site_address ?>
                Phone: <?= $model->client->phone_no ?><br>
                Email: <?= $model->client->email ?>
            </address>
        </div>

        <div class="col-sm-4 invoice-col">
            <b>Invoice #<?= $model->challan_no ?></b><br>
            <b>Challan Date:</b> <?= $model->challan_date ?><br>
            <b>Particular :</b> <?= $model->plan->name ?><br>
            <b>vehicle No:</b> <?= $model->vehicle->name ?>
        </div>

    </div>


    <div class="row">
        <div class="col-12 table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <?php
                        switch ($model->plan->type) {
                            case C::PACKAGE_WISE_CHALLAN: ?>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Break</th>
                                <th>Up-Time</th>
                                <th>Down Time </th>
                                <th>Hours</th>
                            <?php break;
                            case C::PACKAGE_WISE_DAY: ?>
                                <th>Package Name</th>
                                <th>Vehicle No</th>
                                <th>Day</th>
                                <th>Amount</th>
                                <th>Remark</th>
                            <?php break;
                            case C::PACKAGE_WISE_TRIP: ?>
                                <th>Package Name</th>
                                <th>Vehicle No</th>
                                <th>Trip/Qty</th>
                                <th>Brass/Litre</th>
                                <th>Amount</th>
                                <th>Remark</th>
                            <?php break;
                            case C::PACKAGE_WISE_DESTINATION: ?>
                                <th>Package Name</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Amount</th>
                                <th>Remark</th>
                            <?php
                                break;
                            case C::PACKAGE_WISE_MONTH: ?>
                                <th>Date</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Total Time </th>
                                <th>Overtime</th>
                            <?php

                                break;
                            case C::PACKAGE_WISE_SHIFT: ?>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Hours</th>
                                <th>Extra</th>
                                <th>Extra Amt </th>
                                <th>Total Amt</th>
                        <?php
                                break;

                            default:

                                break;
                        } ?>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php
                        switch ($model->plan->type) {
                            case C::PACKAGE_WISE_CHALLAN: ?>
                                <td><?= $model->plan_start_time ?></td>
                                <td><?= $model->plan_end_time ?></td>
                                <td><?= $model->break_time ?></td>
                                <td><?= $model->up_time ?></td>
                                <td><?= $model->down_time ?></td>
                                <td><?= date('H:i', mktime(0, (strtotime($model->plan_end_time) - strtotime($model->plan_start_time)) / 60)); ?></td>
                            <?php break;
                            case C::PACKAGE_WISE_DAY: ?>
                                <td><?= $model->plan->name ?></td>
                                <td><?= $model->vehicle->name ?></td>
                                <td><?= !empty(C::DAYWISE_LABEL[$model->day_wise]) ? C::DAYWISE_LABEL[$model->day_wise] : "" ?></td>
                                <td><?= round($model->total, 2) ?></td>
                                <td></td>
                            <?php break;
                            case C::PACKAGE_WISE_TRIP: ?>
                                <td><?= $model->plan->name ?></td>
                                <td><?= $model->vehicle->name ?></td>
                                <td><?= $model->plan_trip ?></td>
                                <td><?= $model->plan_measure ?></td>
                                <td><?= round($model->total, 2) ?></td>
                                <td></td>
                            <?php break;
                            case C::PACKAGE_WISE_DESTINATION: ?>
                                <td><?= $model->plan->name ?></td>
                                <td><?= $model->from_destination ?></td>
                                <td><?= $model->to_destination ?></td>
                                <td><?= round($model->total, 2) ?></td>
                                <td></td>
                            <?php
                                break;
                            case C::PACKAGE_WISE_MONTH: ?>
                                <td><?=$model->challan_date?></td>
                                <td><?=$model->plan_start_time?></td>
                                <td><?=$model->plan_end_time?></td>
                                <td><?= date('H:i', mktime(0, (strtotime($model->plan_end_time) - strtotime($model->plan_start_time)) / 60)); ?></td>
                                <td>0Hrs</td>
                            <?php

                                break;
                            case C::PACKAGE_WISE_SHIFT:
                                $totalHrs = (strtotime($model->plan_end_time) - strtotime($model->plan_start_time));
                                $extraHrs = $totalHrs > $model->plan->shift_hrs ?  $totalHrs - $model->plan->shift_hrs : 0;
                            ?>
                                <td><?= $model->plan_start_time ?></td>
                                <td><?= $model->plan_end_time ?></td>
                                <td><?= date('H:i', mktime(0, (strtotime($model->plan_end_time) - strtotime($model->plan_start_time)) / 60)); ?>Hrs</td>
                                <td><?= date('H:i', mktime(0, $extraHrs / 60)); ?>Hrs</td>
                                <td><?= $model->extra ?></td>
                                <td><?= $model->total ?></td>
                        <?php
                                break;
                            default:

                                break;
                        } ?>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>