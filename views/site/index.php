<?php

use app\components\Constants as C;

$baseUrl = $client_type == C::CLIENT_TYPE_CUSTOMER ? "customer" : "vendor";

?>
<div class="row">
    <?= $this->render('_level1', ['model' => $model]); ?>
</div>
<div class="row">
    <div class="col-md-4">
        <?= $this->render('_table', [
            "title" => "  Customer Invoice Summary",
            "header" => ["Month", "Count", "Amount"],
            "response" => $model->monthlyOutstanding
        ]) ?>
    </div>
    <div class="col-md-4">
        <?= $this->render('_table', [
            "title" => "Customer Challan Summary ",
            "header" => ["Month", "Count", "Amount"],
            "response" => $model->monthlyChallanOutstanding
        ]) ?>
    </div>
    <div class="col-md-4">
        <?= $this->render('_details_table', [
            "title" => "Invoice Summary",
            "header" => ["Month", "Count", "Amount"],
            "response" => $model->customerInvoiceSummary
        ]) ?>
    </div>
</div>
<div class="row">
    
    <div class="col-md-6">
        <?= $this->render('_details_table', [
            "title" => " Challan Summary",
            "header" => ["Month", "Count", "Amount"],
            "response" => $model->customerChallanSummary
        ]) ?>
    </div>
    <div class="col-md-6">
        <?= $this->render('_table', [
            "title" => " Vehicle Summary",
            "header" => ["Vehicle No", "Sales Amount", "Expenses Amount", "Profit/Loss"],
            "response" => $model->vehicleSummary
        ]) ?>
    </div>
</div>
<div class="row">
  
    <div class="col-md-6">
        <?= $this->render('bar_chart', [
            "title" => "Invoice",
            "response" => [
                "id"=>"invoicebargraph",
                "invoice_gst" => $model->getMonthlyInvoiceWithoutGst(false),
                "invoice" => $model->getMonthlyInvoiceGst(false)
            ]
        ]) ?>
    </div>
    <div class="col-md-6">
        <?= $this->render('donut_chart', [
            "title" => "  Top 5 Vehicle Sales",
            "response" => $model->topFiveVehicle
        ]) ?>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <?= $this->render('_table', [
            "title" => " Monthly GST",
            "header" => ["Month", "Count", "Amount"],
            "response" => $model->monthlyInvoiceGst
        ]) ?>
    </div>
    <div class="col-md-6">
        <?= $this->render('_table', [
            "title" => " Monthly Without GST",
            "header" => ["Month", "Count", "Amount"],
            "response" => $model->monthlyInvoiceWithoutGst
        ]) ?>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <?= $this->render('_table', [
            "title" => "  New Sales & Collection Summary ",
            "header" => ["Month", "New Vendor", "Total Bills", "Total Amount", "Pending Bills", "Pending Amount", "Collected Bills", "Collected Amount"],
            "response" => $model->Summary
        ]) ?>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <?= $this->render('_table', [
            "title" => "Monthly Expenses",
            "header" => ["Month", "Count", "Amount"],
            "response" => $model->monthlyExpenses
        ]) ?>
    </div>
    <div class="col-md-3">
        <?= $this->render('_table', [
            "title" => "Today Expenses",
            "header" => ["Month", "Count", "Amount"],
            "response" => $model->todaysExpenses
        ]) ?>
    </div>
    <div class="col-md-3">
        <?= $this->render('_table', [
            "title" => "Vehicle Expenses",
            "header" => ["Month", "Count", "Amount"],
            "response" => $model->vehicleExpense
        ]) ?>
    </div>
    <div class="col-md-3">
        <?= $this->render('_table', [
            "title" => "Staff Expenses",
            "header" => ["Staff", "Count", "Amount"],
            "response" => $model->staffExpense
        ]) ?>
    </div>
</div>