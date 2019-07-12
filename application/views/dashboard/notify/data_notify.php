
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">Notifications Panel</h3>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bell fa-fw"></i> Notifications Panel
                </div>
                <div class="panel-body">
                    <div class="list-group">
                        <a href="JavaScript:void(0);" class="list-group-item" onclick="dataNotifyByName('Closing Unpaid');">
                            <i class="fa fa-shopping-cart fa-fw"></i> Order Masuk Belum Bayar
                            <span class="pull-right text-muted "><?php if(empty($closingunpaid->result)){echo "0";}else{echo $closingunpaid->result;} ?>
                            </span>
                        </a>
                        <a href="JavaScript:void(0);" class="list-group-item" onclick="dataNotifyByName('Closing Paid');"> 
                            <i class="fa fa-shopping-cart fa-fw"></i> Order Masuk Sudah Bayar
                            <span class="pull-right text-muted "><?php if(empty($closingpaid->result)){echo "0";}else{echo $closingpaid->result;} ?>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="datanotifydetail"></div>