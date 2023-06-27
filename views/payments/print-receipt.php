<?php

use app\components\Constants;

$f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
?>
<div style="display:block;border:1px solid #000;text-align:left;margin:10px;font-size:20px;">
    <table style="border:1px solid #000; border-collapse: collapse;width:100%;">
        <tbody>
            <tr>
                <td colspan="2" style="text-align:center;padding:10px;">
                    <h4>RECEIPT - <?= SITE_NAME ?></h4>
                </td>
            </tr>
            <tr>
                <td width="70%" style="padding:10px;">
                    <b>Date : </b> <?= date("d/m/Y", strtotime($model->payment_date)) ?>
                </td>
                <td  style="padding:10px;">
                    <b>Receipt No :</b> <?= $model->receipt_no ?>
                </td>
            </tr>
            <tr>
                <td width="70%" style="padding:10px;">
                    <b>Amount : </b> Rs. <?=round( $model->amount_paid,2) ?>
                </td>
                <td  style="padding:10px;"><b>Tds :-</b> Rs <?=$model->totalTds?></td>
            </tr>
            <tr>
                <td  style="padding:10px;">
                   <b> Amount (In Ruppes) :-</b> <?= ucwords($f->format($model->amount_paid)) ?>Only
                </td>
                <td  style="padding:10px;">
                    <b>Paid By :-</b> <?= Constants::PAYMENT_MODE_LIST[$model->payment_mode] ?>
                </td>
            </tr>
            <tr>
                <td  style="padding:10px;">
                    
                </td>
                <td  style="padding:10px;">
                   <b> Against Bill No. :-</b> <?= $model->invoice_list ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;margin-bottom:10px;padding:10px;">
                    <p style="padding: 5px;">This is a computer generated receipt and does not require any signature.</p>
                </td>
            </tr>
        </tbody>
    </table>
</div>