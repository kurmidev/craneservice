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
                    <b>Amount : </b> <?= $model->amount_paid ?>
                </td>
                <td  style="padding:10px;"><b>Tds :-</b> Rs 0</td>
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
                    <b>For Payment Of : </b>Rental Service
                </td>
                <td  style="padding:10px;">
                   <b> Against Bill No. :-</b> <?= $model->invoice_list ?>
                </td>
            </tr>
            <tr>
                <td></td>
                <td  style="padding:10px;">
                    <table style="border-collapse:collapse;" cellspacing="0">
                        <tr style="height:24pt">
                            <td style="width:45%;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                                <p class="s6" style="padding-top: 5pt;padding-left: 6pt;text-indent: 0pt;text-align: left;">Account ID</p>
                            </td>
                            <td style="width:55%;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                                <p class="s7" style="padding-top: 5pt;padding-left: 6pt;text-indent: 0pt;text-align: left;"></p>
                            </td>
                        </tr>
                        <tr style="height:24pt">
                            <td style="width:40%;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                                <p class="s6" style="padding-top: 5pt;padding-left: 9pt;text-indent: 0pt;text-align: left;">Balance</p>
                            </td>
                            <td style="width:60%;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                                <p class="s7" style="padding-top: 5pt;padding-left: 6pt;text-indent: 0pt;text-align: left;">Rs.  </p>
                            </td>
                        </tr>
                    </table>
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