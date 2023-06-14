<?php

use app\components\Constants as C;
use app\components\ConstFunc as F;
use yii\helpers\Html;

$f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
$amount = $tax = $total = 0;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
    <p style="padding-top: 3pt;padding-left: 244pt;text-indent: 0pt;text-align: center;"><?= $model->invoice_type == C::INVOICE_TYPE_GST ? "TAX INVOICE" : "PERFORMA INVOICE" ?></p>
    <p style="text-indent: 0pt;text-align: left;"><br /></p>
    <table style="border-collapse:collapse;margin-left:6.31pt" cellspacing="0">
        <tr style="height:75pt">
            <td style="width:288pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="6">
                <p class="s1" style="padding-top: 3pt;padding-left: 4pt;text-indent: 0pt;text-align: left;"><?= SITE_NAME ?></p>
                <p class="s2" style="padding-top: 3pt;padding-left: 4pt;padding-right: 197pt;text-indent: 0pt;line-height: 157%;text-align: left;">Address : <span class="s3"><?= SITE_ADDRESS ?></span></p>
                <p class="s2" style="padding-left: 4pt;text-indent: 0pt;line-height: 9pt;text-align: left;">Call : <span class="s3"><?= SITE_PHONE ?> / </span>Email : <span class="s3"><?= SITE_EMAIL ?></span></p>
                <p class="s2" style="padding-top: 4pt;padding-left: 4pt;text-indent: 0pt;text-align: left;">GSTIN : <span class="s3"><?= SITE_GSTIN ?> / </span>PAN No. : <span class="s3"><?= SITE_PAN ?></span></p>
            </td>
            <td style="width:267pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="4">
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
                <p class="s4" style="padding-left: 80pt;text-indent: 0pt;text-align: left;">
                    <?= !empty(SITE_LOGO) ? Html::img(SITE_LOGO, ["width" => "200px", "height" => "100px"]) : "" ?>
                </p>
            </td>
        </tr>
        <tr style="height:33pt">
            <td style="width:78pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt" colspan="2">
                <p class="s2" style="padding-top: 5pt;padding-left: 6pt;text-indent: 0pt;line-height: 146%;text-align: left;">Invoice No : <br>Invoice Date:</p>
            </td>
            <td style="width:83pt;border-top-style:solid;border-top-width:1pt;border-bottom-style:solid;border-bottom-width:1pt">
                <p class="s2" style="padding-top: 5pt;padding-left: 26pt;text-indent: 0pt;line-height: 146%;text-align: left;"><?= $model->invoice_no ?><br /><?= date("d/m/Y", strtotime($model->invoice_date)) ?></p>
            </td>
            <td style="width:61pt;border-top-style:solid;border-top-width:1pt;border-bottom-style:solid;border-bottom-width:1pt">
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
            </td>
            <td style="width:39pt;border-top-style:solid;border-top-width:1pt;border-bottom-style:solid;border-bottom-width:1pt">
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
            </td>
            <td style="width:27pt;border-top-style:solid;border-top-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
            </td>
            <td style="width:76pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt" colspan="2">
                <p class="s2" style="padding-top: 5pt;padding-left: 6pt;text-indent: 0pt;line-height: 146%;text-align: left;">Place of Supply : Reverse Charge :</p>
            </td>
            <td style="width:119pt;border-top-style:solid;border-top-width:1pt;border-bottom-style:solid;border-bottom-width:1pt">
                <p class="s2" style="padding-top: 5pt;padding-left: 21pt;padding-right: 38pt;text-indent: 0pt;line-height: 146%;text-align: left;"><?= $model->client->city->state->name ?><br> N</p>
            </td>
            <td style="width:72pt;border-top-style:solid;border-top-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
            </td>
        </tr>
        <tr style="height:51pt">
            <td style="width:78pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt" colspan="2">
                <p class="s2" style="padding-top: 3pt;padding-left: 4pt;padding-right: 19pt;text-indent: 0pt;line-height: 139%;text-align: left;">Billed To : <?= $model->client->company_name ?></p>
                <p class="s3" style="padding-left: 4pt;text-indent: 0pt;text-align: left;"> <?= $model->client->site_address ?></p>
                <p class="s3" style="padding-top: 3pt;padding-left: 4pt;text-indent: 0pt;text-align: left;"><?= $model->client->city->name ?> </p>
            </td>
            <td style="width:83pt;border-top-style:solid;border-top-width:1pt">
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
            </td>
            <td style="width:61pt;border-top-style:solid;border-top-width:1pt">
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
            </td>
            <td style="width:39pt;border-top-style:solid;border-top-width:1pt">
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
            </td>
            <td style="width:27pt;border-top-style:solid;border-top-width:1pt;border-right-style:solid;border-right-width:1pt">
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
            </td>
            <td style="width:76pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt" colspan="2">
                <p class="s2" style="padding-top: 3pt;padding-left: 4pt;padding-right: 7pt;text-indent: 0pt;line-height: 139%;text-align: left;">Shipped To : <?= $model->client->city->name ?><br> <?= $model->client->site_address ?></p>
                <p class="s3" style="padding-left: 4pt;text-indent: 0pt;text-align: left;"></p>
            </td>
            <td style="width:119pt;border-top-style:solid;border-top-width:1pt">
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
            </td>
            <td style="width:72pt;border-top-style:solid;border-top-width:1pt;border-right-style:solid;border-right-width:1pt">
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
            </td>
        </tr>
        <tr style="height:43pt">
            <td style="width:78pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt" colspan="2">
                <p class="s3" style="padding-top: 2pt;padding-left: 6pt;text-indent: 0pt;line-height: 146%;text-align: left;">Party Mobile No. :</p>
                <p class="s3" style="padding-top: 2pt;padding-left: 6pt;text-indent: 0pt;line-height: 146%;text-align: left;">Party State :</p>
                <p class="s3" style="padding-top: 2pt;padding-left: 6pt;text-indent: 0pt;line-height: 146%;text-align: left;">GST/UIN No.. :</p>
            </td>
            <td style="width:83pt;border-bottom-style:solid;border-bottom-width:1pt">
                <p class="s3" style="padding-top: 2pt;padding-left: 12pt;text-indent: 0pt;text-align: left;"><?= $model->client->mobile_no ?></p>
                <p class="s3" style="padding-top: 2pt;padding-left: 12pt;text-indent: 0pt;text-align: left;"><?= $model->client->city->state->name ?></p>
                <p class="s3" style="padding-top: 3pt;padding-left: 12pt;text-indent: 0pt;text-align: left;"></p>
            </td>
            <td style="width:61pt;border-bottom-style:solid;border-bottom-width:1pt">
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
            </td>
            <td style="width:39pt;border-bottom-style:solid;border-bottom-width:1pt">
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
            </td>
            <td style="width:27pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
            </td>
            <td style="width:76pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt" colspan="2">
                <p class="s3" style="padding-top: 2pt;padding-left: 6pt;text-indent: 0pt;line-height: 146%;text-align: left;">Party Mobile No. :</p>
                <p class="s3" style="padding-top: 2pt;padding-left: 6pt;text-indent: 0pt;line-height: 146%;text-align: left;">Party State :</p>
                <p class="s3" style="padding-top: 2pt;padding-left: 6pt;text-indent: 0pt;line-height: 146%;text-align: left;">GST/UIN No.. :</p>
            </td>
            <td style="width:119pt;border-bottom-style:solid;border-bottom-width:1pt">
                <p class="s3" style="padding-top: 2pt;padding-left: 12pt;text-indent: 0pt;text-align: left;"><?= $model->client->mobile_no ?></p>
                <p class="s3" style="padding-top: 2pt;padding-left: 12pt;text-indent: 0pt;text-align: left;"><?= $model->client->city->state->name ?></p>
                <p class="s3" style="padding-top: 3pt;padding-left: 12pt;text-indent: 0pt;text-align: left;"></p>
            </td>
            <td style="width:72pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
            </td>
        </tr>
        <tr style="height:17pt">
            <td style="width:288pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="6">
                <p class="s3" style="padding-top: 3pt;padding-left: 4pt;text-indent: 0pt;text-align: left;">W/O NO. : <?= $model->work_order_no ?></p>
            </td>
            <td style="width:267pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="4">
                <p class="s3" style="padding-top: 3pt;padding-left: 4pt;text-indent: 0pt;text-align: left;">VENDOR NO. :<?= $model->vendor_no ?></p>
            </td>
        </tr>
        <tr style="height:17pt">
            <td style="width:555pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="10">
                <p class="s2" style="padding-top: 3pt;padding-left: 4pt;text-indent: 0pt;text-align: left;">Shipping ADDRESS : <?= $model->client->site_address ?></p>
            </td>
        </tr>
        <tr style="height:16pt">
            <td style="width:27pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                <p class="s2" style="padding-top: 3pt;padding-left: 3pt;padding-right: 1pt;text-indent: 0pt;text-align: center;">Sr.no</p>
            </td>
            <td style="width:89pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                <p class="s2" style="padding-top: 3pt;padding-left: 22pt;text-indent: 0pt;text-align: left;">Description</p>
            </td>
            <td style="width:45pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                <p class="s2" style="padding-top: 3pt;padding-left: 4pt;padding-right: 3pt;text-indent: 0pt;text-align: center;">HSN/SAC</p>
            </td>
            <td style="width:61pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                <p class="s2" style="padding-top: 3pt;padding-left: 3pt;padding-right: 2pt;text-indent: 0pt;text-align: center;">Challan No</p>
            </td>
            <td style="width:39pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                <p class="s2" style="padding-top: 3pt;padding-left: 4pt;padding-right: 3pt;text-indent: 0pt;text-align: center;">Qty/Day</p>
            </td>
            <td style="width:33pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                <p class="s2" style="padding-top: 3pt;padding-left: 9pt;text-indent: 0pt;text-align: left;">Unit</p>
            </td>
            <td style="width:44pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                <p class="s2" style="padding-top: 3pt;padding-left: 14pt;text-indent: 0pt;text-align: left;">Rate</p>
            </td>
            <td style="width:145pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="2">
                <p class="s2" style="padding-top: 3pt;padding-left: 62pt;padding-right: 61pt;text-indent: 0pt;text-align: center;">IGST</p>
            </td>
            <td style="width:72pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                <p class="s2" style="padding-top: 3pt;padding-left: 20pt;padding-right: 19pt;text-indent: 0pt;text-align: center;">Total</p>
            </td>
        </tr>
        <tr style="height:16pt">
            <td style="width:27pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
            </td>
            <td style="width:89pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
            </td>
            <td style="width:45pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
            </td>
            <td style="width:61pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
            </td>
            <td style="width:39pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
            </td>
            <td style="width:33pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
            </td>
            <td style="width:44pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
            </td>
            <td style="width:73pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                <p class="s2" style="padding-top: 3pt;padding-left: 27pt;padding-right: 26pt;text-indent: 0pt;text-align: center;">Rate</p>
            </td>
            <td style="width:72pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                <p class="s2" style="padding-top: 3pt;padding-left: 21pt;padding-right: 20pt;text-indent: 0pt;text-align: center;">Amount</p>
            </td>
            <td style="width:72pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
            </td>
        </tr>
        <?php foreach ($model->challans as $i => $challan) { ?>
            <?php
            $tax += $challan['tax'];
            $amount += $challan['amount'] + $challan['extra'];
            $total += $challan['tax'] +  $challan['amount'] + $challan['extra'];
            ?>
            <tr style="height:211pt">
                <td style="width:27pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s3" style="padding-top: 2pt;text-indent: 0pt;text-align: center;"><?= $i + 1 ?></p>
                </td>
                <td style="width:89pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s3" style="padding-top: 2pt;padding-left: 3pt;text-indent: 0pt;text-align: left;"><?= $challan['plan']['name'] ?></p>
                </td>
                <td style="width:45pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s3" style="padding-top: 2pt;padding-left: 4pt;padding-right: 3pt;text-indent: 0pt;text-align: center;"><?= SAC_CODE ?></p>
                </td>
                <td style="width:61pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s3" style="padding-top: 2pt;padding-left: 3pt;padding-right: 2pt;text-indent: 0pt;text-align: center;"><?= $challan->challan_no ?></p>
                </td>
                <td style="width:39pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s3" style="padding-top: 2pt;padding-left: 4pt;padding-right: 3pt;text-indent: 0pt;text-align: center;">
                        <?= $challan['plan']['type'] == C::PACKAGE_WISE_TRIP ? $challan['plan_trip'] : date('H:i', mktime(0, (strtotime($challan['plan_end_time']) - strtotime($challan['plan_start_time'])) / 60)); ?>
                    </p>
                </td>
                <td style="width:33pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s3" style="padding-top: 2pt;padding-left: 9pt;text-indent: 0pt;text-align: left;">    <?= $challan['plan_measure'] ?> <?= $challan['plan']['attr']["name"] ?></p>
                </td>
                <td style="width:44pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s3" style="padding-top: 2pt;padding-left: 14pt;text-indent: 0pt;text-align: left;"><?= $challan["plan"]["price"] ?></p>
                </td>
                <td style="width:73pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s3" style="padding-top: 2pt;padding-left: 27pt;padding-right: 26pt;text-indent: 0pt;text-align: center;"><?= $challan['plan']['tax_slot'] ?></p>
                </td>
                <td style="width:72pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s3" style="padding-top: 2pt;padding-left: 21pt;padding-right: 20pt;text-indent: 0pt;text-align: center;"><?= $challan['tax'] ?></p>
                </td>
                <td style="width:72pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s3" style="padding-top: 2pt;padding-left: 20pt;padding-right: 19pt;text-indent: 0pt;text-align: center;"><?= $challan["total"] ?></p>
                </td>
            </tr>
        <?php } ?>
        <tr style="height:17pt">
            <td style="width:78pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt" colspan="2" rowspan="3">
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
            </td>
            <td style="width:83pt;border-top-style:solid;border-top-width:1pt;border-bottom-style:solid;border-bottom-width:1pt" rowspan="3">
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
            </td>
            <td style="width:61pt;border-top-style:solid;border-top-width:1pt;border-bottom-style:solid;border-bottom-width:1pt" rowspan="3">
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
            </td>
            <td style="width:39pt;border-top-style:solid;border-top-width:1pt;border-bottom-style:solid;border-bottom-width:1pt" rowspan="3">
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
            </td>
            <td style="width:27pt;border-top-style:solid;border-top-width:1pt;border-bottom-style:solid;border-bottom-width:1pt" rowspan="3">
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
                <p class="s2" style="padding-left: 8pt;text-indent: 0pt;text-align: left;">Total</p>
            </td>
            <td style="width:76pt;border-top-style:solid;border-top-width:1pt;border-bottom-style:solid;border-bottom-width:1pt" colspan="2" rowspan="3">
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
            </td>
            <td style="width:119pt;border-top-style:solid;border-top-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" rowspan="3">
                <p class="s3" style="padding-top: 4pt;padding-left: 18pt;padding-right: 43pt;text-indent: 0pt;text-align: center;">Taxable Amount</p>
                <p class="s3" style="padding-left: 18pt;padding-right: 43pt;text-indent: 0pt;line-height: 17pt;text-align: center;">Tax Amount Payable Amount</p>
            </td>
            <td style="width:72pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-right-style:solid;border-right-width:1pt">
                <p class="s2" style="padding-top: 4pt;padding-left: 20pt;padding-right: 19pt;text-indent: 0pt;text-align: center;"><?= $amount ?></p>
            </td>
        </tr>
        <tr style="height:17pt">
            <td style="width:72pt;border-left-style:solid;border-left-width:1pt;border-right-style:solid;border-right-width:1pt">
                <p class="s3" style="padding-top: 3pt;padding-left: 20pt;padding-right: 19pt;text-indent: 0pt;text-align: center;"><?= $tax ?></p>
            </td>
        </tr>
        <tr style="height:18pt">
            <td style="width:72pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                <p class="s2" style="padding-top: 3pt;padding-left: 20pt;padding-right: 19pt;text-indent: 0pt;text-align: center;"><?= $total ?></p>
            </td>
        </tr>
        <tr style="height:20pt">
            <td style="width:555pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="10">
                <p class="s3" style="padding-top: 3pt;padding-left: 4pt;text-indent: 0pt;text-align: left;">Amount Chargeable (in words) : <b><?= ucwords($f->format($total)) ?> only</b></p>
            </td>
        </tr>
        <tr style="height:14pt">
            <td style="width:288pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="6">
                <p class="s2" style="padding-top: 3pt;padding-left: 4pt;text-indent: 0pt;text-align: left;">Bank Details :</p>
            </td>
            <td style="width:267pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="4">
                <p class="s2" style="padding-top: 3pt;padding-left: 4pt;text-indent: 0pt;text-align: left;">Other Details :</p>
            </td>
        </tr>
        <tr style="height:12pt">
            <td style="width:288pt;border-left-style:solid;border-left-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="6">
                <p class="s2" style="padding-top: 1pt;padding-left: 4pt;text-indent: 0pt;text-align: left;">A/c Name :</p>
            </td>
            <td style="width:267pt;border-left-style:solid;border-left-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="4">
                <?php foreach ($model->challans as $c) { ?>
                    <p class="s2" style="padding-top: 1pt;padding-left: 4pt;text-indent: 0pt;text-align: left;"><?=$c['plan']['name']?>: 
                    <?=$c['plan']['type']==C::PACKAGE_WISE_TRIP?$c['plan_measure']:(
                        !empty($c["plan_shift_type"]) ? C::PACKAGE_SHIFT_TYPE[$c["plan_shift_type"]]:
                            (!empty($c['plan_extra_hours'])? $c['plan_extra_hours']: $c['to_destination'])
                        )
                    ?>
                        <span class="s3"><?=$challan['plan']['attr']['name']?></span>
                </p>
                <?php } ?>
            </td>
        </tr>
        <tr style="height:12pt">
            <td style="width:288pt;border-left-style:solid;border-left-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="6">
                <p class="s2" style="padding-top: 1pt;padding-left: 4pt;text-indent: 0pt;text-align: left;">A/c Number :</p>
            </td>
            <td style="width:267pt;border-left-style:solid;border-left-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="4">
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
            </td>
        </tr>
        <tr style="height:12pt">
            <td style="width:288pt;border-left-style:solid;border-left-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="6">
                <p class="s2" style="padding-top: 1pt;padding-left: 4pt;text-indent: 0pt;text-align: left;">Bank Name :</p>
            </td>
            <td style="width:267pt;border-left-style:solid;border-left-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="4">
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
            </td>
        </tr>
        <tr style="height:17pt">
            <td style="width:288pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="6">
                <p class="s2" style="padding-top: 1pt;padding-left: 4pt;text-indent: 0pt;text-align: left;">Branch IFSC :</p>
            </td>
            <td style="width:267pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="4">
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
            </td>
        </tr>
        <tr style="height:75pt">
            <td style="width:288pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="6">
                <p class="s5" style="padding-top: 3pt;padding-left: 4pt;text-indent: 0pt;text-align: left;">Terms &amp; Conditions :-</p>
                <ol id="l1" style="font-size:10px">
                    <li>Goods once sold will not be taken back</li>
                    <li>Interest @18% p.a will be charged if the payment is not made with in the stipulated time.</li>
                    <li>Subject of Maharashtra jurisdiction only.</li>
                </ol>
            </td>
            <td style="width:107pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="2">
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
                <p class="s6" style="padding-left: 26pt;text-indent: 0pt;text-align: left;">RECEIVER SIGN</p>
            </td>
            <td style="width:160pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt" colspan="2">
                <p class="s6" style="padding-top: 3pt;padding-left: 49pt;padding-right: 48pt;text-indent: 0pt;text-align: center;">FOR <?= SITE_NAME ?></p>
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
                <p class="s6" style="padding-left: 49pt;padding-right: 48pt;text-indent: 0pt;text-align: center;">PROPRIETOR</p>
            </td>
        </tr>
    </table>
</body>

</html>