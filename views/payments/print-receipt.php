<?php

use app\components\Constants;

$f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style type="text/css">
        p {
            text-align: justify;
        }

        .left {
            width: 65%;
            float: left;
        }

        .right {
            width: 35%;
            float: right;
        }
    </style>

</head>

<body>
    <div style="display:block;text-align:left;border:2px solid #000;padding:10px;margin:10px;">

        <p style="text-align:center;"><strong>RECEIPT - <?= SITE_NAME ?></strong></p>

        <div>
            <p class="left">Date :- <?= date("d/m/Y H:i:s", strtotime($model->payment_date)) ?></p>
            <p class="right">Receipt No : <?= $model->receipt_no ?></p>
        </div>
        <div>
            <p class="left">Received From :- <?= $model->actionBy ?></p>
            <p class="right">Amount :- : <?= $model->amount_paid ?> </p>
        </div>
        <div>
            <p class="left"></p>
            <p class="right">Tds :- Rs 0</p>
        </div>
        <div>
            <p class="left">
                <span style="width:85%;position:relative;float:left;">Amount (In Ruppes) :- <?= ucwords($f->format($model->amount_paid)) ?>Only</span>
            </p>
            <p class="right">Paid By :- <?= Constants::PAYMENT_MODE_LIST[$model->payment_mode] ?></p>
        </div>
        <div>
            <p class="left">For Payment Of : Rental Service</p>
            <p class="right">Against Bill No. :- <?= $model->invoice_list ?></p>
        </div>
        <div>

            <table style="border-collapse:collapse;margin-left:65%" cellspacing="0">
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
                        <p class="s7" style="padding-top: 5pt;padding-left: 6pt;text-indent: 0pt;text-align: left;">Rs. <?= $model->client->getBalance() ?></p>
                    </td>
                </tr>
            </table>

        </div>

        <div>
            <p style="padding: 5px;text-align: center;">This is a computer generated receipt and does not require any signature.</p>
        </div>

</body>

</html>