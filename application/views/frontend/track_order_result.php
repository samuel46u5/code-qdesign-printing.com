<?php echo $header; ?>
<div class="bread-crumb-detail bgwhite flex-w p-l-52 p-r-15 p-t-50 p-l-15-sm">
    <a href="<?php echo base_url('') ?>" class="s-text16">
        Home
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>
    <span class="s-text17">
        Lacak Order
    </span>
</div>
<?php if (empty($orderresult)) { ?>
    <section class="bgwhite p-t-10 p-b-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bo17 p-l-10 p-r-10 p-t-20 m-t-30 m-r-0 m-l-r-auto p-lr-15-sm">
                        <div class="alert alert-info">Mohon maaf ID Order yang Anda cari tidak di temukan. <br> Silahkan cek kembali ID Order Anda atau silahkan hubungi CS kami. <a href="<?php echo base_url('pages/track-order') ?>"><u>kembali ke form track order</u></a></div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
<?php } else { ?>
    <section class="bgwhite p-t-20 p-b-30">
        <div class="container">
            <?php if ($this->session->flashdata('MSG')) { ?>
                <?= $this->session->flashdata('MSG') ?>
            <?php } ?>
            <div class="bo17 p-l-10 p-r-10 p-t-20 p-b-38 m-t-30 m-r-0 m-l-r-auto p-lr-15-sm">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="border-0 text-uppercase small font-weight-bold">ID Order</th>
                                <th class="border-0 text-uppercase small font-weight-bold">Status</th>
                                <th class="border-0 text-uppercase small font-weight-bold">No Resi</th>
                                <th class="border-0 text-uppercase small font-weight-bold">Tanggal Update</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo $orderresult->idorder; ?></td>
                                <td><?php
                                    if ($orderresult->status == "process shiping") {
                                        echo "<span class='text-success'><b>" . $orderresult->status . " </b></span>( Order Anda telah kami kirim sesuai alamat )";
                                    } elseif ($orderresult->status == "closing paid") {
                                        echo $orderresult->status . " (Order Anda sedang kami proses)";
                                    } else {
                                        echo $orderresult->status;
                                    }
                                    ?></td>
                                <td><?php echo $ordershiping->receiptNumber; ?></td>
                                <td><?php echo $orderresult->dateVerify; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <?php if(($orderresult->status != "add to cart") && ($orderresult->status != "insert data customer") && ($orderresult->status != "insert shiping") && ($orderresult->status && "payment method")){?>
    <section class="bgwhite p-t-10 p-b-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body p-0 bo17">
                            <div class="mb-2 bo18 p-2 bg-dark text-center text-white">
                                <h4>Invoice # <?php echo $invoice->idorder; ?><br> Status <?php
                                    if ($invoice->invoiceStatus == "UNPAID") {
                                        echo "<span class='text-danger'>" . $invoice->invoiceStatus . "</span>";
                                    } else {
                                        echo "<span class='text-success'>" . $orderresult->status . "</span>";
                                    }
                                    ?>
                                </h4>
                            </div>
                            <div class="row p-r-20 p-l-20 p-t-20 p-b-20">
                                <div class="col-md-6 text-left">
                                    <img src="<?php echo site_url('asset/img/uploads/banner/' . $logo->image . ''); ?>" style="max-width: 120px;">
                                    <p class="mb-1"><?php echo $profile->address1 . " <br>Telp." . $profile->phone1; ?></p>

                                </div>

                                <div class="col-md-6 text-right">
                                    <p class="mb-1">Tanggal Invoice : <?php echo $invoice->invoiceDate; ?></p>
                                    <p class="mb-1 text-danger">Jatuh Tempo : <b><?php echo $invoice->dueDate; ?></b></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row pb-5 p-4">
                                <div class="col-md-6">
                                    <p class="font-weight-bold mb-4">Ditagihkan Kepada</p>
                                    <p class="mb-1"><?php echo $ordershiping->firstName . " " . $ordershiping->lastName; ?></p>
                                    <p class="mb-1"><b>Email</b> : <?php echo $ordershiping->custEmail; ?></p>
                                    <p><b>Alamat </b>: <?php echo $ordershiping->desa . ", " . $ordershiping->rt . " " . $ordershiping->rw . " , " . $ordershiping->kecamatan . " , " . $ordershiping->namaKabupaten . " , " . $ordershiping->namaProvinsi . ". (kode pos: " . $ordershiping->kodePos . " )."; ?></p>
                                    <p class="mb-1"><b>Telp. </b><?php echo $ordershiping->custHp; ?></p>
                                </div>
                                <div class="col-md-6 text-right">
                                    <p class="font-weight-bold mb-4">Informasi Pengiriman</p>
                                    <p class="mb-1"><b>Kurir</b> : <?php echo $ordershiping->shipingName; ?></p>
                                    <p class="mb-1"><b>Biaya</b> : <?php echo "Rp. <span class='money'>" . $ordershiping->shipingCarge . "</span>"; ?></p>
                                </div>
                            </div>
                            <div class="row p-4">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="border-0 text-uppercase small font-weight-bold">Item</th>
                                                    <th class="border-0 text-uppercase small font-weight-bold">Description</th>
                                                    <th class="border-0 text-uppercase small font-weight-bold">Quantity</th>
                                                    <th class="border-0 text-uppercase small font-weight-bold">Unit Cost</th>
                                                    <th class="border-0 text-uppercase small font-weight-bold">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($detailorder as $value) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $value->idproduct; ?></td>
                                                        <td><?php echo $value->productName; ?></td>
                                                        <td><?php echo $value->productQty; ?></td>
                                                        <td><?php echo "Rp. <span class='money'>" . $value->productPrice . "</span>"; ?></td>
                                                        <td><?php echo "Rp. <span class='money'>" . $value->subtotalPrice . "</span>"; ?></td>
                                                    </tr>
                                                <?php } ?>
                                                <tr>
                                                    <td><?php echo $ordershiping->shipingName; ?></td>
                                                    <td>Jasa Pengiriman Barang</td>
                                                    <td><?php echo ceil(($ordershiping->totalWeight) / 1000); ?> Kg</td>
                                                    <td><?php echo "Rp. <span class='money'>" . ($ordershiping->shipingCarge) / (ceil(($ordershiping->totalWeight) / 1000)) . "</span>"; ?></td>
                                                    <td><?php echo "Rp. <span class='money'>" . $ordershiping->shipingCarge . "</span>"; ?></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>Subtotal</td>
                                                    <td>Rp. <span class="money"><?php echo $ordershiping->totalPrice ?></span></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>Discount Partner</td>
                                                    <td>Rp. - <span class="money"><?php echo $orderresult->partnerDiscount ?></span></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>Voucher</td>
                                                    <td>Rp. - <span class="money"><?php echo $orderresult->voucherPrice ?></span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-row-reverse bg-dark text-white p-4">
                                <div class="py-3 px-5 text-right">
                                    <div class="mb-2">Grand Total</div>
                                    <div class="h2 font-weight-light"><?php echo "Rp. <span class='money'>" . $orderresult->orderSumary . "</span>"; ?></div>
                                </div>

                                <div class="py-3 px-5 text-right">
                                    <div class="mb-2">Uniq Payment</div>
                                    <div class="h2 font-weight-light"><?php
                                        $countstr = strlen($orderresult->orderSumary);
                                        echo "Rp. <span class='money'>" . substr($orderresult->orderSumary, $countstr - 3) . "</span>"
                                        ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 p-t-30">
                    <div class="card">
                        <div class="card-body p-0 bo17">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="border-0 text-uppercase small font-weight-bold">Cara Pembayaran</th>
                                                <th class="border-0 text-uppercase small font-weight-bold">Bank</th>
                                                <th class="border-0 text-uppercase small font-weight-bold">Atas Nama</th>
                                                <th class="border-0 text-uppercase small font-weight-bold">Uniq Payment</th>
                                                <th class="border-0 text-uppercase small font-weight-bold">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Transfer Bank</td>
                                                <td><?php echo $invoice->paymentMethod; ?></td>
                                                <td><?php echo $invoice->bankAccountName; ?></td>
                                                <td><?php
                                                    $countstr = strlen($orderresult->orderSumary);
                                                    echo "Rp. <span class='money'>" . substr($orderresult->orderSumary, $countstr - 3) . "</span>"
                                                    ?></td>
                                                <td> <?php echo "Rp. <span class='money'>" . $invoice->invoicePrice . "</span>"; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="p-2">
                                    <?php
                                    if ($invoice->invoiceStatus == "PAID") {?>
                                         <br>
                                         <a class="btn btn-block subs_btn form-control" type="button" href="<?php echo base_url('d/Exportdata/export_invoice_pdf?idorder='.$invoice->idorder.'')?>" target="_blank">
                                         Cetak
                                     </a>
                                    <?php }else {
                                        ?>
                                        <button class="btn btn-block subs_btn form-control" type="button" data-toggle="modal" data-target="#modalPayment">
                                            Konfirmasi Sudah Bayar
                                        </button>
                                    <?php } ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>
<?php } ?>
<?php echo $footer; ?>
</body>
</html>