<?php

use app\components\Constants as C;

?>9594668945

<div style="display:block;border:1px solid #000;text-align:left;margin:6px;font-size:20px;">
    <table width="100%" style="border:1px solid #000;text-align:center;">
        <tbody>
            <tr>
                <td rowspan="4">
                    <img src="<?= SITE_LOGO ?>">
                </td>
                <td>
                    <h2><?= SITE_NAME ?></h2>
                </td>
                <td rowspan="4">
                    <img src="<?= SITE_LOGO ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <strong><?= SITE_ADDRESS ?></strong>
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Call : </strong><?= SITE_PHONE ?> <strong>/ EMAIL :</strong> <?= SITE_EMAIL ?>
                </td>
            </tr>
            <tr>
                <td>
                    <strong>GST NO : </strong><?= SITE_GSTIN ?> /<strong> PAN No :</strong> <?= SITE_PAN ?>
                </td>
            </tr>
            <tr>
                <td colspan="3"  style="border-top: 1px solid #000;">
                    <div style="text-align: left;padding:6px 0px;">
                        <strong>Company Name</strong> : <?=$model->company_name?>

                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                <div style="text-align: left;padding:6px 0px;">
                        <strong>Name</strong> : <?=$model->first_name .' '.$model->last_name ?>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                <div style="text-align: left;padding:6px 0px;">
                        <strong>Mobile No</strong> : <?=$model->mobile_no?>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                <div style="text-align: left;padding:6px 0px;">
                        <strong>Email Id</strong> : <?=$model->email?>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <div style="text-align: left;">
                        <strong>Address</strong> : <?=$model->address?> Pincode : <?=$model->pincode?>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <table  width="100%" style="border:1px solid #000;text-align:center;">

                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</div>