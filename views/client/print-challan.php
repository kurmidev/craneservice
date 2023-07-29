<?php

use app\components\Constants as C;

?>

<div style="display:block;border:1px solid #000;text-align:left;margin:10px;font-size:20px;">
    <table style="border:1px solid #000; border-collapse: collapse;width:100%;">
        <tbody>
            <tr>
                <td rowspan="5" style="padding:20px;">
                    <h2><?= SITE_NAME ?></h2>
                    <p>
                        <b>Address :</b> <?= SITE_ADDRESS ?>
                        <br>
                        <b>Call:</b><?= SITE_PHONE ?>
                        <br>
                        <b>GSTN/UIN :</b> <?= SITE_GSTIN ?>
                        <br>
                        <b>PAN No. :</b> <?= SITE_PAN ?>
                    </p>
                </td>
                <td  style="border:1px solid #000; border-collapse: collapse;padding:8px">
                    Challan No : <?= $model->challan_no ?>
                </td>
            </tr>
            <tr>
                <td style="border:1px solid #000; border-collapse: collapse;padding:8px">
                    Challan Date : <?= $model->challan_date ?>
                </td>
            </tr>
            <tr>
                <td style="border:1px solid #000; border-collapse: collapse;padding:8px">
                    Particular : <?= $model->plan->name ?>
                </td>
            </tr>
            <tr>
                <td style="border:1px solid #000; border-collapse: collapse;padding:8px">
                    Vehicle No : <?= $model->vehicle->name ?>
                </td>
            </tr>
            <tr>
                <td style="border:1px solid #000; border-collapse: collapse;padding:8px">
                    Phone No : <?= $model->client->mobile_no ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="border:1px solid #000; border-collapse: collapse;width:99.99%;padding:8px;">
                    <b>Party Name :</b> <?= $model->client->company_name ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="border:1px solid #000; border-collapse: collapse;width:99.99%;padding:8px;">
                    <b>Site Address : </b> <?= $model->client->site_address ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="padding:0px;">
                    <div style="display:block;padding:0px;">
                    <table style="border:1px solid #000; border-collapse: collapse;width:100%">
                        <thead>
                            <tr>
                                <?php
                                switch ($model->plan->type) {
                                    case C::PACKAGE_WISE_CHALLAN: ?>
                                        <th style="border:1px solid #000; border-collapse: collapse;padding:5px;">Start Time</th>
                                        <th style="border:1px solid #000; border-collapse: collapse;padding:5px;">End Time</th>
                                        <th style="border:1px solid #000; border-collapse: collapse;padding:5px;">Break</th>
                                        <th style="border:1px solid #000; border-collapse: collapse;padding:5px;">Up-Time</th>
                                        <th style="border:1px solid #000; border-collapse: collapse;padding:5px;">Down Time </th>
                                        <th style="border:1px solid #000; border-collapse: collapse;padding:5px;">Hours</th>
                                    <?php break;
                                    case C::PACKAGE_WISE_DAY: ?>
                                        <th style="border:1px solid #000; border-collapse: collapse;padding:5px;">Package Name</th>
                                        <th style="border:1px solid #000; border-collapse: collapse;padding:5px;">Vehicle No</th>
                                        <th style="border:1px solid #000; border-collapse: collapse;padding:5px;">Day</th>
                                        <th style="border:1px solid #000; border-collapse: collapse;padding:5px;">Amount</th>
                                        <th style="border:1px solid #000; border-collapse: collapse;padding:5px;">Remark</th>
                                    <?php break;
                                    case C::PACKAGE_WISE_TRIP: ?>
                                        <th style="border:1px solid #000; border-collapse: collapse;padding:5px;">Package Name</th>
                                        <th style="border:1px solid #000; border-collapse: collapse;padding:5px;">Vehicle No</th>
                                        <th style="border:1px solid #000; border-collapse: collapse;padding:5px;">Trip/Qty</th>
                                        <th style="border:1px solid #000; border-collapse: collapse;padding:5px;">Brass/Litre</th>
                                        <th style="border:1px solid #000; border-collapse: collapse;padding:5px;">Amount</th>
                                        <th style="border:1px solid #000; border-collapse: collapse;padding:5px;">Remark</th>
                                    <?php break;
                                    case C::PACKAGE_WISE_DESTINATION: ?>
                                        <th style="border:1px solid #000; border-collapse: collapse;padding:5px;">Package Name</th>
                                        <th style="border:1px solid #000; border-collapse: collapse;padding:5px;">From</th>
                                        <th style="border:1px solid #000; border-collapse: collapse;padding:5px;">To</th>
                                        <th style="border:1px solid #000; border-collapse: collapse;padding:5px;">Amount</th>
                                        <th style="border:1px solid #000; border-collapse: collapse;padding:5px;">Remark</th>
                                    <?php
                                        break;
                                    case C::PACKAGE_WISE_MONTH: ?>
                                        <th style="border:1px solid #000; border-collapse: collapse;padding:5px;">Date</th>
                                        <th style="border:1px solid #000; border-collapse: collapse;padding:5px;">Start Time</th>
                                        <th style="border:1px solid #000; border-collapse: collapse;padding:5px;">End Time</th>
                                        <th style="border:1px solid #000; border-collapse: collapse;padding:5px;">Total Time </th>
                                        <th style="border:1px solid #000; border-collapse: collapse;padding:5px;">Overtime</th>
                                    <?php

                                        break;
                                    case C::PACKAGE_WISE_SHIFT: ?>
                                        <th style="border:1px solid #000; border-collapse: collapse;padding:5px;">Start Time</th>
                                        <th style="border:1px solid #000; border-collapse: collapse;padding:5px;">End Time</th>
                                        <th style="border:1px solid #000; border-collapse: collapse;padding:5px;">Hours</th>
                                        <th style="border:1px solid #000; border-collapse: collapse;padding:5px;">Amount</th>
                                <?php
                                        break;

                                    default:

                                        break;
                                } ?>
                            </tr>
                        </thead>
                        <tbody>
                            
                                <?php
                                switch ($model->plan->type) {
                                    case C::PACKAGE_WISE_CHALLAN: ?>
                                    <tr>
                                        <td style="border:1px solid #000; border-collapse: collapse;padding:5px;"><?= $model->plan_start_time ?></td>
                                        <td style="border:1px solid #000; border-collapse: collapse;padding:5px;"><?= $model->plan_end_time ?></td>
                                        <td style="border:1px solid #000; border-collapse: collapse;padding:5px;"><?= $model->break_time ?></td>
                                        <td style="border:1px solid #000; border-collapse: collapse;padding:5px;"><?= $model->up_time ?></td>
                                        <td style="border:1px solid #000; border-collapse: collapse;padding:5px;"><?= $model->down_time ?></td>
                                        <td style="border:1px solid #000; border-collapse: collapse;padding:5px;"><?= date('H:i', mktime(0, (strtotime($model->plan_end_time) - strtotime($model->plan_start_time)) / 60)); ?></td>
                                    </tr>
                                    <?php break;
                                    case C::PACKAGE_WISE_DAY: ?>
                                    <tr>
                                        <td style="border:1px solid #000; border-collapse: collapse;padding:5px;"><?= $model->plan->name ?></td>
                                        <td style="border:1px solid #000; border-collapse: collapse;padding:5px;"><?= $model->vehicle->name ?></td>
                                        <td style="border:1px solid #000; border-collapse: collapse;padding:5px;"><?= !empty(C::DAYWISE_LABEL[$model->day_wise]) ? C::DAYWISE_LABEL[$model->day_wise] : "" ?></td>
                                        <td style="border:1px solid #000; border-collapse: collapse;padding:5px;"><?= round($model->amount, 2) ?></td>
                                        <td style="border:1px solid #000; border-collapse: collapse;padding:5px;"></td>
                                    </tr>
                                    <?php break;
                                    case C::PACKAGE_WISE_TRIP: ?>
                                    <tr>
                                        <td style="border:1px solid #000; border-collapse: collapse;padding:5px;"><?= $model->plan->name ?></td>
                                        <td style="border:1px solid #000; border-collapse: collapse;padding:5px;"><?= $model->vehicle->name ?></td>
                                        <td style="border:1px solid #000; border-collapse: collapse;padding:5px;"><?= $model->plan_trip ?></td>
                                        <td style="border:1px solid #000; border-collapse: collapse;padding:5px;"><?= $model->plan_measure ?></td>
                                        <td style="border:1px solid #000; border-collapse: collapse;padding:5px;"><?= round($model->amount, 2) ?></td>
                                        <td style="border:1px solid #000; border-collapse: collapse;padding:5px;"></td>
                                    </tr>
                                    <?php break;
                                    case C::PACKAGE_WISE_DESTINATION: ?>
                                    <tr>
                                        <td style="border:1px solid #000; border-collapse: collapse;padding:5px;"><?= $model->plan->name ?></td>
                                        <td style="border:1px solid #000; border-collapse: collapse;padding:5px;"><?= $model->from_destination ?></td>
                                        <td style="border:1px solid #000; border-collapse: collapse;padding:5px;"><?= $model->to_destination ?></td>
                                        <td style="border:1px solid #000; border-collapse: collapse;padding:5px;"><?= round($model->amount, 2) ?></td>
                                        <td style="border:1px solid #000; border-collapse: collapse;padding:5px;"></td>
                                    </tr>
                                    <?php
                                        break;
                                    case C::PACKAGE_WISE_MONTH: ?>
                                    <tr>
                                        <td style="border:1px solid #000; border-collapse: collapse;padding:5px;"><?= $model->challan_date ?></td>
                                        <td style="border:1px solid #000; border-collapse: collapse;padding:5px;"><?= $model->plan_start_time ?></td>
                                        <td style="border:1px solid #000; border-collapse: collapse;padding:5px;"><?= $model->plan_end_time ?></td>
                                        <td style="border:1px solid #000; border-collapse: collapse;padding:5px;"><?= date('H:i', mktime(0, (strtotime($model->plan_end_time) - strtotime($model->plan_start_time)) / 60)); ?></td>
                                        <td style="border:1px solid #000; border-collapse: collapse;padding:5px;">0Hrs</td>
                                    </tr>
                                    <?php

                                        break;
                                    case C::PACKAGE_WISE_SHIFT:
                                        $totalHrs = (strtotime($model->plan_end_time) - strtotime($model->plan_start_time));
                                        $extraHrs = $totalHrs > $model->plan->shift_hrs ?  $totalHrs - $model->plan->shift_hrs : 0;
                                    ?>
                                    <tr>
                                        <td style="border:1px solid #000; border-collapse: collapse;padding:5px;"><?= $model->plan_start_time ?></td>
                                        <td style="border:1px solid #000; border-collapse: collapse;padding:5px;"><?= $model->plan_end_time ?></td>
                                        <td style="border:1px solid #000; border-collapse: collapse;padding:5px;"><?= date('H:i', mktime(0, (strtotime($model->plan_end_time) - strtotime($model->plan_start_time)) / 60)); ?>Hrs</td>
                                        <td style="border:1px solid #000; border-collapse: collapse;padding:5px;"><?= $model->amount ?></td>
                                    </tr>
                                    <tr>
                                        <td style="border:1px solid #000; border-collapse: collapse;padding:5px;"></td>
                                        <td style="border:1px solid #000; border-collapse: collapse;padding:5px;"></td>
                                        <td style="border:1px solid #000; border-collapse: collapse;padding:5px;"><?= date('H:i', mktime(0, $extraHrs / 60)); ?>Hrs</td>
                                        <td style="border:1px solid #000; border-collapse: collapse;padding:5px;"><?= $model->extra ?></td>
                                    </tr>
                                <?php
                                        break;
                                    default:

                                        break;
                                } ?>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="padding:40px;">


                </td>
            </tr>
            <tr>
                <td></td>
                <td style="text-align:right;margin-right:10px;">
                    Signature
                </td>
            </tr>
            <tr>
                <td  style="padding:10px;"></td>
                <td  style="padding:10px;"></td>
            </tr>
        </tbody>
    </table>
</div>