<?php

use app\components\Constants as C;

?>
<table width="100%">
    <thead>
        <tr>
            <th>
                <table class="table table-borderless">
                    <tr>
                        <th style="text-align:center;">
                            <h3 style="font-size:24px;padding:5px;">
                                <?= !empty($model->company->name) ? $model->company->name : SITE_NAME ?>
                            </h3>
                        </th>
                    </tr>
                    <tr>
                        <th style="text-align:center;"><?= !empty($model->company->billing_address) ? $model->company->billing_address : SITE_ADDRESS ?></th>
                    </tr>
                    <tr>
                        <th style="text-align:center;"> Call : <?= !empty($model->company->mobile_no) ? $model->company->mobile_no : SITE_PHONE ?> / Email : <?= !empty($model->company->email) ? $model->company->email : SITE_EMAIL ?></th>
                    </tr>
                    <tr>
                        <th style="text-align:center;"> GSTIN : <?= !empty($model->company->gst_in) ? $model->company->gst_in : "" ?> / PAN No. : <?= !empty($model->company->pan_no) ? $model->company->pan_no : "" ?></th>
                    </tr>
                </table>
            </th>
        </tr>
        <tr>
            <td style="text-align:left;padding:2px;">
                <b>Company Name :</b> <?= $model->company_name ?>
            </td>
        </tr>
        <tr>
            <td style="text-align:left;padding:2px;">
                <b>Name :</b> <?= $model->first_name . " " . $model->last_name ?>
            </td>
        </tr>
        <tr>
            <td style="text-align:left;padding:2px;">
                <b>Mobile No :</b> <?= $model->mobile_no ?>
            </td>
        </tr>
        <tr>
            <td style="text-align:left;padding:2px;">
                <b>Email :</b> <?= $model->email ?>
            </td>
        </tr>
        <tr>
            <td style="text-align:left;padding:2px;">
                <b>Address :</b> <?= $model->address ?>
            </td>
        </tr>
    </thead>
</table>

<?= $this->render("export-details", ['dataProvider' => $dataProvider, 'pg' => $pg]) ?>