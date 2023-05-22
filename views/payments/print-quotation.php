<?php

use app\components\ConstFunc as F;
$f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
$base_amount = $final_total = 0;

?>
<div id="page1-div">
    <div style="display:block;border:1px solid #000;text-align:center;">
        <h2 style="font-size:20"><strong><?= SITE_NAME ?></strong></h2>
        <p><?= SITE_ADDRESS ?></p>
        <p><b>E-mail :</b><?= SITE_EMAIL ?> <b>Mob :</b><?= SITE_PHONE ?></p>
        <p><b>GSTIN : <?= SITE_GSTIN ?></b></p>
    </div>
    <div style="display:block;border:1px solid #000;text-align:left;width:auto;min-height:800px;">
        <div style="white-space:nowrap;text-align:center;padding:5px"><b>QUOTATION</b></div>
        <div style="text-align:left;padding:5px;margin-left:18px;display:block;">
            <table style="width:100%;">
                <tbody>
                    <tr>
                        <td style="width:80%;">
                            <p><b>To,</b><br>
                                <b><?= $model->client->company_name ?></b><br>
                                <?= $model->client->site_address ?><br>
                                <?= $model->client->city->name ?> - <?= $model->client->site_pincode ?>
                            </p>
                        </td>
                        <td style="width:20%;">
                            <p><b>DATE: <?= date("d/m/Y", strtotime($model->date)) ?></b></p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div style="margin-left: 20px;">
            <p>
                <b>Subject : <?= $model->subject ?></b>
                <br>
                Respected Sir,<br><br>

                &nbsp;&nbsp; We at <?= SITE_NAME ?>, are Pleased To Introduce Ourselves As One Of The Leading Firm In Crane Service Provider For<br />
                Heavy Machinery Loading, Unloading, Shifting, As Well As Erection Of The Same, To Satisfy The Need Of Customer At A Reasonable Price.

                <br>
                <br>
            </p>
        </div>
        <div style="display:block;padding:0px;margin:0px;">
            <table style="border:1px solid #000; border-collapse: collapse;width:99.99%;font-size:12px;">
                <thead>
                    <tr>
                        <th style="border:1px solid #000;width:10%;">Sr No.</th>
                        <th style="border:1px solid #000;">Particulars</th>
                        <th style="border:1px solid #000;width:12%;">Quantity</th>
                        <th style="border:1px solid #000;width:12%;">Price</th>
                        <th style="border:1px solid #000;width:12%;">GST</th>
                        <th style="border:1px solid #000;width:12%;">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0; ?>
                    <?php foreach ($model->quotationItems as $item) { ?>
                        <?php
                        $i++;
                        $amount = $item["amount"] * $item["quantity"];
                        $tax = F::calculateTax($amount, $model->tax_applicable);
                        $total = $amount + $tax;
                        $base_amount += $amount;
                        $final_total += $total;
                        ?>
                        <tr>
                            <td style="border:1px solid #000;"><?= $i ?></td>
                            <td style="border:1px solid #000;"><?= $item['plan']['name'] ?></td>
                            <td style="border:1px solid #000;"><?= $item["quantity"] ?></td>
                            <td style="border:1px solid #000;"><?= $amount ?></td>
                            <td style="border:1px solid #000;"><?= $tax ?></td>
                            <td style="border:1px solid #000;"><?= $total ?></td>
                        </tr>
                    <?php } ?>
                    <?php for ($j = 0; $j < (18 - $i); $j++) { ?>
                        <tr>
                            <td style="border:1px solid #000;">&nbsp;</td>
                            <td style="border:1px solid #000;">&nbsp;</td>
                            <td style="border:1px solid #000;">&nbsp;</td>
                            <td style="border:1px solid #000;">&nbsp;</td>
                            <td style="border:1px solid #000;">&nbsp;</td>
                            <td style="border:1px solid #000;">&nbsp;</td>
                        </tr>
                    <?php } ?>

                    <tr>
                        <td style="border:1px solid #000;"></td>
                        <td style="border:1px solid #000;"><b>Total</b></td>
                        <td style="border:1px solid #000;"></td>
                        <td style="border:1px solid #000;"></td>
                        <td style="border:1px solid #000;"><b><?= F::calculateTax($base_amount, $model->tax_applicable); ?></b></td>
                        <td style="border:1px solid #000;"><b><?= $final_total ?></b></td>
                    </tr>
                    <tr>
                        <td colspan="3" rowspan="3" style="border:1px solid #000; border-collapse: collapse;">
                            <div style="padding:1px; margin-left:5px;">
                                <b>Term & Conditions</b><br />
                                1. Gst tax18% as per government rule will be added.<br>
                                2. Payment terms charges &monthly billing payment will be done within 10
                                days of bill<br>
                                submission of monthly bill.<br>
                                3. Shift- the given quotation is for 10 hrs shift (including lunch )in a single
                                strength & 26 shifts for a month.<br>
                                4. Reaching time will be extra 30 min
                            </div>
                        </td>
                        <td colspan="3" style="border:1px solid #000; border-collapse: collapse;">
                            Amounts :
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" rowspan="2" style="border:1px solid #000; border-collapse: collapse;">
                            <table style="width:99.99%;">
                                <tbody>
                                    <tr>
                                        <td><b>Sub Total </b></td>
                                        <td><?= $base_amount ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>CGST 9% </b></td>
                                        <td><?= F::calculateTax($base_amount, 9) ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>SGST 9% </b></td>
                                        <td><?= F::calculateTax($base_amount, 9) ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Total </b></td>
                                        <td><?= $final_total ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div style="border:1px solid #000; border-collapse: collapse;padding:15px;">
            <p>
                Please Let Us Know For Any Requirement Of The Same And To Serve You At Our Best.
            </p>
            <p>Thanks and Regards.</p>
            <p>For,</p>

            <p style="padding:20px;">

            </p>

            <p><?= SITE_NAME ?></p>
        </div>
    </div>
</div>