<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header"></h3>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-cart-plus fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php if(empty($neworder->neworder)){echo "0";}else{echo $neworder->neworder;} ?></div>
                            <div>Order (Bayar)</div>
                        </div>
                    </div>
                </div>
                <a href="JavaScript:void(0);" onclick="dataOrder('closing paid');">
                    <div class="panel-footer">
                        <span class="pull-left">Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-cart-plus fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php if(empty($neworderunpaid->neworderunpaid)){echo "0";}else{echo $neworderunpaid->neworderunpaid; }?></div>
                            <div>Order (Belum Bayar)</div>
                        </div>
                    </div>
                </div>
                <a href="JavaScript:void(0);" onclick="dataInvoiceUnpaid();">
                    <div class="panel-footer">
                        <span class="pull-left">Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-heart-o fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $wishlist->wishlist; ?></div>
                            <div>Wishlist</div>
                        </div>
                    </div>
                </div>
                <a href="JavaScript:void(0);" onclick="dataWishlist();">
                    <div class="panel-footer">
                        <span class="pull-left">Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-users fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $newpartner->newpartner; ?></div>
                            <div>Partner Baru</div>
                        </div>
                    </div>
                </div>
                <a href="JavaScript:void(0);" onclick="dataInvoicePartner();">
                    <div class="panel-footer">
                        <span class="pull-left">Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-cart-plus fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">Total Belanja dari Toko buka
                            <div class="huge"><?php echo "Rp. " .number_format($countshoping->countshoping); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-tags fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">Total Barang di unggah
                            <div class="huge"><?php echo $countproduct->countproduct; ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-tags fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">Total Barang Stok kosong
                            <div class="huge"><?php echo $countproductoutstock->countproductoutstock; ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-tags fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">Total Barang In Stok
                            <div class="huge"><?php echo $countproductinstock->countproductinstock; ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>