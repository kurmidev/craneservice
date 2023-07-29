<?php

use app\components\Constants as C;
use yii\bootstrap5\Html;

$i = 1;
$total = $base_amount = $tax = 0;
$f = new NumberFormatter("in", NumberFormatter::SPELLOUT);
$bank = !empty($model->client->company->banks[1]) ? $model->client->company->banks[1] : (!empty($model->client->company->banks[0]) ? $model->client->company->banks[0] : []);

?>
<div style="display:block;border:1px solid #000;text-align:left;margin:10px;font-size:12pt;">


    <table style="display:block;border:1px solid #000;text-align:left;border-collapse:collapse;" cellspacing="0" width="100%">
        <tr>
            <td>
                <b><?= !empty($model->client->company->name) ? $model->client->company->name : SITE_NAME ?></b>
            </td>
            <td rowspan="4" style="text-align:center;width:50%;border:1px solid #000;">
                <?= !empty(SITE_LOGO) ? Html::img(SITE_LOGO, ["width" => "100px", "height" => "100px"]) : "" ?>
            </td>
        </tr>
        <tr>
            <td>
                <b>Address: </b> <?= !empty($model->client->company->billing_address) ? $model->client->company->billing_address : SITE_ADDRESS ?>
            </td>
        </tr>
        <tr>
            <td> <b>Call :</b> <?= !empty($model->client->company->mobile_no) ? $model->client->company->mobile_no : SITE_PHONE ?> /<b> Email :</b>
                <?= !empty($model->client->company->email) ? $model->client->company->email : SITE_EMAIL ?>
            </td>
        </tr>
        <tr>
            <td>
                <b>GSTIN :</b> <?= !empty($model->client->company->gst_in) ? $model->client->company->gst_in : "" ?> / <b>PAN No. :</b> <?= !empty($model->client->company->pan_no) ? $model->client->company->pan_no : "" ?>
            </td>
        </tr>
        <tr style="display:block;text-align:left;">
            <td style="border-right:1px solid #000;border-top:1px solid #000;">
                <b>Invoice No : </b> <?= $model->invoice_no ?>
            </td>
            <td style="border-left:1px solid #000;border-top:1px solid #000;">
                <b>Place of Supply : </b> <?= $model->client->city->name ?>
            </td>
        </tr>
        <tr>
            <td style="border-right:1px solid #000;">
                <b>Invoice Date : </b> <?= date("d/m/Y", strtotime($model->invoice_date)) ?>
            </td>
            <td style="border-left:1px solid #000;">
                <b>Reverse Charge : </b>
            </td>
        </tr>
        <tr>
            <td style="border-right:1px solid #000;border-top:1px solid #000;padding:3px;"><b>Billed To:</b></td>
            <td style="border-left:1px solid #000;border-top:1px solid #000;padding:3px;"><b>Shipped To:</b></td>
        </tr>
        <tr>
            <td style="border-right:1px solid #000;"><?= $model->client->company_name ?></td>
            <td style="border-left:1px solid #000;"><?= $model->client->company_name ?></td>
        </tr>
        <tr>
            <td style="border-right:1px solid #000;"><?= $model->client->address ?></td>
            <td style="border-left:1px solid #000;"><?= $model->client->address ?></td>
        </tr>
        <tr>
            <td style="border-right:1px solid #000;padding:3px;"> <b>Party Mobile No:</b><?= $model->client->mobile_no ?> </td>
            <td style="border-left:1px solid #000;padding:3px;"><b>Party Mobile No:</b><?= $model->client->mobile_no ?></td>
        </tr>
        <tr>
            <td style="border-right:1px solid #000;padding:3px;"><b>Party State</b>:<?= $model->client->city->state->name ?></td>
            <td style="border-left:1px solid #000;padding:3px;"> <b>Party State</b>:<?= $model->client->city->state->name ?></td>
        </tr>
        <tr>
            <td style="border-right:1px solid #000;padding:3px;"><b>GST/UIN No </b></td>
            <td style="border-left:1px solid #000;padding:3px;"><b>GST/UIN No </b></td>
        </tr>
        <tr>
            <td style="border-right:1px solid #000;border-top:1px solid #000;padding:3px;"><b>W/O NO. : </b></td>
            <td style="border-left:1px solid #000;border-top:1px solid #000;padding:3px;"><b>VENDOR NO. : </b></td>
        </tr>
        <tr>
            <td colspan="2" style="border-right:1px solid #000;border-top:1px solid #000;border-bottom:1px solid #000;padding:3px;"><b>SITE ADDRESS : </b></td>
        </tr>
        <tr>
            <td colspan="2">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Sr.no</th>
                            <th>Description</th>
                            <th>HSN/SAC</th>
                            <th>Challan No</th>
                            <th>Qty/Day</th>
                            <th>Unit</th>
                            <th>Rate</th>
                            <?php if ($model->invoice_type == C::INVOICE_TYPE_GST) { ?>
                                <th>CGST</th>
                                <th>SGST</th>
                            <?php } ?>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($model->challans as $challan) { ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $challan->plan->name ?></td>
                                <td>997319</td>
                                <td><?= $challan->challan_no ?></td>
                                <td><?= !empty($challan->day_wise) ? $challan->day_wise : (!empty($challan->package_trip) ? $challan->package_trip : (!empty($challan->from_destination) ? $challan->from_destination : date("H:m", (strtotime($challan->plan_end_time) - strtotime($challan->plan_start_time))) . "hr")) ?></td>
                                <td><?= !empty($challan->day_wise_check) ? $challan->day_wise_check : (!empty($challan->package_measure) ? $challan->package_measure : (!empty($challan->to_destination) ? $challan->to_destination : $challan->plan_end_time)) ?></td>
                                <td><?= $challan->base_amount ?></td>
                                <?php if ($model->invoice_type == C::INVOICE_TYPE_GST) { ?>
                                    <td><?= round(($challan->tax / 2), 2) ?></td>
                                    <td><?= round(($challan->tax / 2), 2) ?></td>
                                <?php } ?>
                                <td><?= round($challan->amount + $challan->extra, 2) ?></td>
                                <?php $base_amount += $challan->amount ?>
                                <?php $tax += $challan->tax ?>
                                <?php $total += ($model->invoice_type== C::INVOICE_TYPE_GST)?($challan->amount + $challan->extra + $challan->tax) :(($challan->amount + $challan->extra)) ?>
                            </tr>
                        <?php } ?>
                        <?php if ($model->invoice_type == C::INVOICE_TYPE_GST) { ?>
                            <tr>
                                <td colspan="6"></td>
                                <td colspan="2">Taxable Amount</td>
                                <td colspan="2" style="text-align:right;"><?= $base_amount ?></td>
                            </tr>
                            <tr>
                                <td colspan="6"></td>
                                <td colspan="2">Tax Amount</td>
                                <td colspan="2" style="text-align:right;"><?= $tax ?></td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td colspan="<?=($model->invoice_type== C::INVOICE_TYPE_GST)?6:4?>"></td>
                            <td colspan="2">Payable Amount</td>
                            <td colspan="2" style="text-align:right;"><?= $total ?></td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="13" style="border-top:1px solid #000;border-bottom:1px solid #000;padding:3px;">
                Amount Chargeable (in words) : <b><?= ucwords($f->format(round($total, 2))) . " only" ?></b>
            </td>
        </tr>
        <tr>
            <td style="border-right:1px solid #000;"><b>Bank Details:</b></td>
            <td><b>Other Details:</b></td>
        </tr>
        <tr>
            <td style="border-right:1px solid #000;"><b>A/c Name:</b> <?= $bank['name'] ?></td>
            <td rowspan="4">
                <?php foreach ($model->challans as $challan) { ?>
                    <?= $challan->plan->name ?>:
                    <?= !empty($challan->day_wise) ? $challan->day_wise : (!empty($challan->package_trip) ? $challan->package_trip * $challan->package_measure : (!empty($challan->from_destination) ? $challan->from_destination . "-" . $challan->to_destination :
                        date("H:m", (strtotime($challan->plan_end_time) - strtotime($challan->plan_start_time))) . "hr")) ?>
                    <br>
                <?php  } ?>
            </td>
        </tr>
        <tr>
            <td style="border-right:1px solid #000;"><b>A/c Number:</b> <?= $bank['account_number'] ?></td>
        </tr>
        <tr>
            <td style="border-right:1px solid #000;"><b>Bank Name:</b> <?= $bank['bank_name'] ?></td>
        </tr>
        <tr>
            <td style="border-right:1px solid #000;"><b>Branch IFSC:</b> <?= $bank['ifsc_code'] ?></td>
        </tr>
        <tr>
            <td rowspan="2" style="border-right:1px solid #000;border-top:1px solid #000;padding:3px;">
                <b>Terms & Conditions :-</b><br>
                <ol>
                    <li> Goods once sold will not be taken back</li>
                    <li>Interest @18% p.a will be charged if the payment is not made with in the
                        stipulated time.</li>
                    <li>Subject of Maharashtra jurisdiction only</li>
                </ol>
            </td>
            <td style="border-top:1px solid #000;padding:3px;">
                <table>
                    <tbody>
                        <tr>
                            <td style="text-align:left;">
                                <br><br><br>
                                RECEIVER SIGN
                            </td>
                            <td style="text-align:right;">
                                FOR <?= SITE_NAME ?>
                                <br><br><br>

                                PROPRIETOR
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </table>

</div>