<div class="invoice p-3 mb-3">


    <div class="row">
        <div class="col-12">
            <h4>
                <i class="fas fa-globe"></i> <?=SITE_NAME?>
                <small class="float-right">Date: <?=date("d/m/Y")?></small>
            </h4>
        </div>

    </div>

    <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
            From
            <address>
                <strong><?=SITE_NAME?></strong><br>
                <?=SITE_ADDRESS?>
                Phone: <?=SITE_PHONE?><br>
                Email: <?=SITE_EMAIL?>
            </address>
        </div>

        <div class="col-sm-4 invoice-col">
            To
            <address>
                <strong><?=$model->client->company_name?></strong><br>
                <?=$model->client->site_address?>
                Phone: <?=$model->client->phone_no?><br>
                Email: <?=$model->client->email?>
            </address>
        </div>

        <div class="col-sm-4 invoice-col">
            <b>Invoice #<?=$model->challan_no?></b><br>
            <br>
            <b>Challan Date:</b> <?=$model->challan_date?><br>
            <b>Particular :</b> <?=$model->plan->name?><br>
            <b>vehicle No:</b> <?=$model->vehicle->name?>
        </div>

    </div>


    <div class="row">
        <div class="col-12 table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Hours</th>
                        <th>Charges</th>
                        <th>Extra Amt</th>
                        <th>Tax Amt</th>
                        <th>Total Amt</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?=$model->plan_start_time?></td>
                        <td><?=$model->plan_end_time?></td>
                        <td><?=date("H", strtotime($model->plan_end_time) - strtotime($model->plan_start_time))?></td>
                        <td><?=$model->extra?></td>
                        <td><?=$model->amount?></td>
                        <td><?=$model->tax?></td>
                        <td><?=$model->total?></td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>


   

</div>