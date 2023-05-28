
<div class="col-2 col-sm-2 col-md-2">
    <div class="info-box mb-3">
        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
        <div class="info-box-content">
            <span class="info-box-text">Customer <br> &nbsp;</span>
            <span class="info-box-number"><?=$model->totalCustomer?></span>
        </div>

    </div>
</div>

<div class="col-2 col-sm-2 col-md-2">
    <div class="info-box mb-3">
        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
        <div class="info-box-content">
            <span class="info-box-text">Invoice <br> &nbsp; </span>
            <span class="info-box-number"><?=$model->totalInvoice?></span>
        </div>
    </div>
</div>

<div class="col-2 col-sm-2 col-md-2">
    <div class="info-box mb-3">
        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>
        <div class="info-box-content">
            <span class="info-box-text">Outstanding <br> &nbsp; </span>
            <span class="info-box-number"><?=$model->totalOutstanding?></span>
        </div>
    </div>
</div>

<div class="col-2 col-sm-2 col-md-2">
    <div class="info-box mb-3">
        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-thumbs-up"></i></span>
        <div class="info-box-content">
            <span class="info-box-text">Paid <br> &nbsp;</span>
            <span class="info-box-number"><?=$model->totalPaid?></span>
        </div>
    </div>
</div>



<div class="col-2 col-sm-2 col-md-2">
    <div class="info-box">
        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-atom"></i></span>
        <div class="info-box-content">
            <span class="info-box-text">Total <br> Challan</span>
            <span class="info-box-number">
                <?=$model->totalChallan?>
            </span>
        </div>
    </div>
</div>

<div class="col-2 col-sm-2 col-md-2">
    <div class="info-box">
        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-people-carry"></i></span>
        <div class="info-box-content">
            <span class="info-box-text">Pending <br> Challan</span>
            <span class="info-box-number">
                <?=$model->pendingChallan?>
            </span>
        </div>
    </div>
</div>




