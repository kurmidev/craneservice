<?php

use app\components\Constants;
use app\components\Constants as C;

$f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
?>
<div style="display:block;border:1px solid #000;text-align:left;margin:10px;font-size:20px;">
    <table style="border:1px solid #000; border-collapse: collapse;width:100%;">
        <tbody>
            <tr>
                <td colspan="2" style="text-align:right;border:1px solid #000; border-collapse: collapse;text-align:right;padding-top:2px;vertical-align:bottom;background">
                    <h4>Cash Voucher</h4>
                </td>
            </tr>
            <tr>
                <td width="70%" style="padding:10px;">
                    <b>Pay To : </b> <?= $model->expense_type == C::EXPENSE_TYPE_NORMAL ? $model->vendor->company_name : $model->staff->name ?>
                </td>
                <td style="padding:10px;">
                    <b> No :</b> <?= $model->voucher_no ?>
                </td>
            </tr>
            <tr>
                <td width="70%" style="padding:10px;">
                    <b>Accoutn Of : </b>
                </td>
                <td style="padding:10px;">
                    <b> Date :</b> <?= date("d/m/y", strtotime($model->date)) ?>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table style="border:1px solid #000; border-collapse: collapse;width:100%;">
                        <thead>
                            <tr>
                                <th style="border:1px solid #000; border-collapse: collapse;">Category</th>
                                <th style="border:1px solid #000; border-collapse: collapse;">Quantity</th>
                                <th style="border:1px solid #000; border-collapse: collapse;">Rate</th>
                                <th style="border:1px solid #000; border-collapse: collapse;">Rs</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total = 0;
                            foreach ($model->expenseItems as $item) { ?>
                                <?php $total += ($item['amount'] * $item['quantity']); ?>
                                <tr>
                                    <td style="border:1px solid #000; border-collapse: collapse;padding:5px;"><?= $item['category']['name'] ?></td>
                                    <td style="border:1px solid #000; border-collapse: collapse;padding:5px;"><?= $item['quantity'] ?></td>
                                    <td style="border:1px solid #000; border-collapse: collapse;padding:5px;"><?= $item['amount'] ?></td>
                                    <td style="border:1px solid #000; border-collapse: collapse;padding:5px;"><?= $item['amount'] * $item['quantity'] ?></td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td colspan="3" style="border:1px solid #000; border-collapse: collapse;padding:5px;text-align:right;"><b> Total</b> </td>
                                <td style="border:1px solid #000; border-collapse: collapse;padding:5px;"><?= $total ?></td>
                            </tr>
                            <tr>
                                <td style="border:1px solid #000; border-collapse: collapse;padding:5px;">Rs in Words</td>
                                <td colspan="3" style="border:1px solid #000; border-collapse: collapse;padding:5px;"> <?= ucwords($f->format($model->total)) ?>Only </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="width:100%;padding:5px 10px 20px 10px;" colspan="2">
                    <table style="border-collapse: collapse;width:100%;line-height:30px;">
                        <tbody>
                            <tr>
                                <td width="15%">
                                    Prepared By
                                </td>
                                <td style="border-bottom:1px solid #000; border-collapse: collapse;padding:5px;">
                                    <?= $model->actionBy ?>
                                </td>
                                <td width="15%" style= "text-align:right;">
                                    Passed By
                                </td>
                                <td style="border-bottom:1px solid #000; border-collapse: collapse;padding:5px;">
                                    <?= $model->passed->name ?>
                                </td>
                                <td rowspan="4"  style= "text-align:end;">
                                    <div style="display:block;margin-top:30px;">
                                        <b>signature</b>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Cheque No.
                                </td>
                                <td style="border-bottom:1px solid #000; border-collapse: collapse;padding:5px;">
                                    <?= $model->instrument_number ?>
                                </td>
                                <td style= "text-align:right;">
                                    Dated
                                </td>
                                <td style="border-bottom:1px solid #000; border-collapse: collapse;padding:5px;">
                                    <?= $model->instrument_date ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</div>