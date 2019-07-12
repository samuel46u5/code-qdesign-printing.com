<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">
        </h3>
        <div class="row" id="tableorder">
            <div class="col-lg-12">
                <div class="row">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            Detail Order , status : <b><?php echo $orderresult->status; ?></b>
                            <a href="JavaScript:void(0);" onclick="close();"><span class="pull-right"><i class="fa fa-close"></i></span></a>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>ID Order</th>
                                        <td><?php echo $orderresult->idorder; ?></td>
                                    </tr>
                                    <tr>
                                        <th>ID User</th>
                                        <td><?php echo $orderresult->iduser; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Order</th>
                                        <td><?php echo $orderresult->orderDate; ?></td>
                                    </tr>
                                    <tr class="bg-default">
                                        <th colspan="2">Rincian Order</th>
                                    </tr>

                                    <?php
                                    $i = 1;
                                    if (!empty($detailorder)) {
                                        foreach ($detailorder as $value) {
                                            ?>
                                            <tr>
                                                <th><?php echo "(" . $value->idproduct . ") " . $value->productName; ?> <img src="<?php echo base_url('asset/img/uploads/product/thumb/'.$value->thumbImage.'')?>"></th>
                                                <td><?php echo $value->productQty . " pcs, satuan: Rp" . number_format($value->productPrice) . " ( Rp." . number_format($value->subtotalPrice) . ")"; ?> | <?php echo "Note :" . $value->note; ?> 
                                                 <?php $link = substr($value->fileDesign,0,4); if($link == "http"){?>
                                                    <a class="btn btn-sm btn-primary" href="<?php echo $value->fileDesign;?>" target="_blank">download file</a>
                                                 <?php }elseif(empty($value->fileDesign)){?>
                                                 <?php  } else{?>
                                                    <a class="btn btn-sm btn-primary" href="<?php echo base_url('d/Sales/download_file_design?filename='.$value->fileDesign.'');?>" target="_blank">download file</a></td>
                                                 <?php  }?>
                                            </tr> 
                                            <?php
                                        }
                                    }
                                    ?>
                                    <tr class="bg-default">
                                        <th colspan="2">Rincian Kurir</th>
                                    </tr>

                                    <tr>
                                        <th>Layanan Kurir</th>
                                        <td><?php echo $ordershiping->shipingName; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Perkiraan Biaya</th>
                                        <td><?php echo number_format($ordershiping->shipingCarge); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Nama Penerima</th>
                                        <td><?php echo $ordershiping->firstName . " " . $ordershiping->lastName; ?></td>
                                    </tr>

                                    <tr>
                                        <th>Alamat</th>
                                        <td><?php echo $ordershiping->desa . ", RT" . $ordershiping->rt . "- RW" . $ordershiping->rw . ", " . $ordershiping->kecamatan . ", " . $ordershiping->namaKabupaten . ", " . $ordershiping->namaProvinsi . ", " . $ordershiping->kodePos; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Alamat Detail</th>
                                        <td><?php echo $ordershiping->fullAddress; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Kontak</th>
                                        <td> <?php echo $ordershiping->custEmail . ", Telepon :" . $ordershiping->custHp; ?></td>
                                    </tr>

                                    <tr class="bg-default">
                                        <th colspan="2">Rincian Total</th>
                                    </tr>

                                    <tr>
                                        <th>Subtotal Order + Kurir</th>
                                        <td><?php echo "Rp. " . number_format($ordershiping->totalPrice); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Voucher</th>
                                        <td><?php echo "Rp. " . number_format($orderresult->voucherPrice); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Uniq Payment</th>
                                        <td><?php
                                            $countstr = strlen($orderresult->orderSumary);
                                            echo "Rp. " . substr($orderresult->orderSumary, $countstr - 3);
                                            ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Total</th>
                                        <td><b><?php echo "Rp. " . number_format($orderresult->orderSumary); ?></b></td>
                                    </tr>

                                    <tr class="bg-default">
                                        <th colspan="2">Cara pembayaran</th>
                                    </tr>

                                    <tr>
                                        <th>Cara pembayaran</th>
                                        <td><?php
                                            if (!empty($invoice)) {
                                                echo $invoice->paymentMethod;
                                            } else {
                                                echo "null";
                                            }
                                            ?></td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Transfer</th>
                                        <td><?php
                                            if (!empty($invoice)) {
                                                echo $invoice->dateConfirmPayment;
                                            } else {
                                                echo "null";
                                            }
                                            ?></td>
                                    </tr>
                                    <tr>
                                        <th>Jumlah Transfer</th>
                                        <td><b><?php
                                                if (!empty($invoice)) {
                                                    echo "Rp. " . number_format($invoice->invoicePrice);
                                                } else {
                                                    echo "null";
                                                }
                                                ?></b></td>
                                    </tr>

                                    <tr>
                                        <th>Bukti Transfer</th>
                                        <td><a href="<?php
                                            if (!empty($invoice)) {
                                                echo base_url('asset/img/uploads/buktitransfer/') . $invoice->paymentImage;
                                            } else {
                                                echo "null";
                                            }
                                            ?>" target="_blank"><?php
                                                   if (!empty($invoice)) {
                                                       echo $invoice->paymentImage;
                                                   } else {
                                                       echo "null";
                                                   }
                                                   ?></a></td>
                                    </tr>
                                    <?php if ($orderresult->status == "closing paid") { ?>
                                        <tr>
                                            <th>Aksi</th>
                                            <td><button class="btn btn-block btn-success" onclick="confirmOrder('<?php echo $orderresult->idorder; ?>', '<?php echo $ordershiping->custEmail; ?>', '<?php echo $ordershiping->shipingName; ?>');"><i class="fa fa-truck"></i> Konfirmasi Order ke pengiriman</button></td>
                                        </tr>
                                    <?php } ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>      
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function confirmOrder1(id) {
        var id = id;
        swal({
            title: "Konfirmasi Order",
            text: "Konfirmasi Order ini dan mengirimkan email? Anda diwajibkan menginputkan resi pengiriman.",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#5cb85c",
            confirmButtonText: "Konfirmasi",
            cancelButtonText: "Batal",
            closeOnConfirm: false,
            closeOnCancel: false
        },
                function (isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url: '<?php echo base_url('d/Sales/confirm_order'); ?>',
                            method: "POST",
                            data: {"id": id},
                            success: function (data) {
                                $('#alert').html(data);
                                dataOrder('closing paid');
                            }
                        });
                        swal("Sukses!", "", "success");
                    } else {
                        swal("", "", "error");
                    }
                });

    }

    function confirmOrder(id, email, kurir) {
        swal({
            title: "Konfirmasi Order!",
            text: "Masukan Kode Resi pengiriman:",
            type: "input",
            showCancelButton: true,
            confirmButtonColor: "#5cb85c",
            confirmButtonText: "Konfirmasi",
            cancelButtonText: "Batal",
            closeOnConfirm: false,
            animation: "slide-from-top",
            inputPlaceholder: "kode Resi Pengiriman"
        },
                function (inputValue) {
                    if (inputValue === false)
                        return false;

                    if (inputValue === "") {
                        swal.showInputError("Masukan kode Resi Pengiriman!");
                        return false;
                    }
                    $.ajax({
                        url: '<?php echo base_url('d/Sales/confirm_order'); ?>',
                        method: "POST",
                        data: {"id": id, "resi": inputValue, "email": email, "kurir": kurir},
                        success: function (data) {
                            $('#alert').html(data);
                            dataOrder('closing paid');
                        }
                    }),
                            swal("Sedang di proses system", "" + inputValue, "success");
                    window.open('<?php echo base_url('d/Exportdata/export_shiping_label_pdf?idorder=' . $orderresult->idorder . '') ?>');
                });
    }
    function close() {
        $('#tableorder').hide();
    }
</script>