<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">Kirim E-mail ke <?php echo $data->firstName; ?>
    </h3>
    <div class="row">
        <div class="panel panel-green">
            <div class="panel-body">
                <form role="form" method="POST" accept-charset="UTF-8" enctype="multipart/form-data" id="formemail">
                    <div class="form-group">
                        <label>Kepada</label>
                        <input class="form-control" name="email" id="email" type="email" required="" value="<?php echo $data->custEmail; ?>">
                        <p class="help-block"  onclick="showCC();" id="showcc"><i class="fa fa-plus"></i> tampilkan CC/BCC</p>
                        <p class="help-block"  onclick="hideCC();" id="hidecc"><i class="fa fa-minus"></i> sembunyikan CC/BCC</p>
                    </div>
                    <div class="form-group" id="cc">
                        <label>CC.</label>
                        <input class="form-control" type="email" id="cc" name="cc">
                    </div>
                    <div class="form-group">
                        <label>Judul</label>
                        <input class="form-control" placeholder="Enter text" required="" value="<?php echo "Konfirmasi Order " . $data->idorder . " dengan Status " . $data->status; ?> ">
                    </div>
                    <div class="form-group">
                        <label for="">Pesan</label>
                        <textarea id="wysiwyg" class="textarea required form-control" rows="15" name="pesan" id="pesan" required>Halo kak <?php echo $data->firstName . " " . $data->lastName . "<br> Status Order Kakak " . $data->status.", Berrikut detail Order ". $data->idorder ." :<br>"; ?> 

                        <ul>
                            <li>ID Order</li>
                            <ul>
                                <li><?php echo $orderresult->idorder; ?></li>
                            </ul>
                        </ul>
                        <ul>
                            <li>ID User</li>
                            <ul>
                                <li><?php echo $orderresult->iduser; ?></li>
                            </ul>
                        </ul>
                        <ul>
                            <li>Tanggal Order</li>
                            <ul>
                                <li><?php echo $orderresult->orderDate; ?></li>
                            </ul>
                        </ul>
                        <p><b>Rincian Order</b></p>

                        <?php
                        $i = 1;
                        if (!empty($detailorder)) {
                            foreach ($detailorder as $value) {
                                ?>
                                <ul>

                                    <li><?php echo "(" . $value->idproduct . ") " . $value->productName; ?> <?php echo $value->productQty . " pcs, satuan: Rp" . number_format($value->productPrice) . " ( Rp." . number_format($value->subtotalPrice) . ")"; ?> | <?php echo "Note :" . $value->note; ?>

                                </li>
                            </ul> 
                        <?php } }?>

                        <p><b>Rincian Kurir</b></p>

                        <ul>
                            <li>Layanan Kurir</li>
                            <ul>
                                <li><?php echo $ordershiping->shipingName; ?></li>
                            </ul>
                        </ul>

                        <ul>
                            <li>Perkiraan Biaya</li>
                            <ul>
                                <li><?php echo number_format($ordershiping->shipingCarge); ?></li>
                            </ul>
                        </ul>
                        <ul>
                            <li>Nama Penerima</li>
                            <ul>
                                <li><?php echo $ordershiping->firstName . " " . $ordershiping->lastName; ?></li>
                            </ul>
                        </ul>

                        <ul>
                            <li>Alamat</li>
                            <ul>
                                <li><?php echo $ordershiping->desa . ", RT" . $ordershiping->rt . "- RW" . $ordershiping->rw . ", " . $ordershiping->kecamatan . ", " . $ordershiping->namaKabupaten . ", " . $ordershiping->namaProvinsi . ", " . $ordershiping->kodePos; ?></li>
                            </ul>
                        </ul>
                        <ul>
                            <li>Alamat Detail</li>
                            <ul>
                                <li><?php echo $ordershiping->fullAddress; ?></li>
                            </ul>
                        </ul>
                        <ul>
                            <li>Kontak</li>
                            <ul>
                                <li> <?php echo $ordershiping->custEmail . ", Telepon :" . $ordershiping->custHp; ?></li>
                            </ul>
                        </ul>

                        <p><b>Rincian Total</b></p>

                        <ul>
                            <li>Subtotal Order + Kurir</li>
                            <ul>
                                <li><?php echo "Rp. " . number_format($ordershiping->totalPrice); ?></li>
                            </ul>
                        </ul>
                        <ul>
                            <li>Voucher</li>
                            <ul>
                                <li><?php echo "Rp. " . number_format($orderresult->voucherPrice); ?></li>
                            </ul>
                        </ul>
                        <ul>
                            <li>Uniq Payment</li>
                            <ul>
                                <li><?php
                                $countstr = strlen($orderresult->orderSumary);
                                echo "Rp. " . substr($orderresult->orderSumary, $countstr - 3);
                                ?></li>
                            </ul>
                        </ul>
                        <ul>
                            <li>Total</li>
                            <ul>
                                <li><b><?php echo "Rp. " . number_format($orderresult->orderSumary); ?></b></li>
                            </ul>
                        </ul>


                        <p><b>Cara pembayaran</b></p>


                        <ul>
                            <li>Cara pembayaran</li>
                            <ul>
                                <li><?php
                                if (!empty($invoice)) {
                                    echo $invoice->paymentMethod;
                                } else {
                                    echo "null";
                                }
                                ?></li>
                            </ul>
                        </ul>
                        <ul>
                            <li>Tanggal Transfer</li>
                            <ul>
                                <li><?php
                                if (!empty($invoice)) {
                                    echo $invoice->dateConfirmPayment;
                                } else {
                                    echo "null";
                                }
                                ?></li>
                            </ul>
                        </ul>
                        <ul>
                            <li>Jumlah Transfer</li>
                            <ul>
                                <li><b><?php
                                if (!empty($invoice)) {
                                    echo "Rp. " . number_format($invoice->invoicePrice);
                                } else {
                                    echo "null";
                                }
                                ?></b></li>
                            </ul>
                        </ul>
                    </textarea>
                </div>
                <input type="button" onclick="sendEmail();" class="btn btn-success pull-right" value="Kirim Email">
                <button type="reset" class="btn btn-default">Reset</button>
            </form>
        </div>
    </div>
</div>      
</div>
</div>
<script>
    function showCC() {
        $('#cc').show('slow');
        $('#showcc').hide();
        $('#hidecc').show();
    }
    function hideCC() {
        $('#cc').hide('slow');
        $('#hidecc').hide();
        $('#showcc').show();
    }
    function sendEmail() {
        var valid = $("#formemail").valid();
        if (valid == true) {
            var form = $('#formemail').get(0);
            $('#loader').show();
            $.ajax({
                url: '<?php echo base_url('d/Crm/send_email') ?>',
                method: "POST",
                data: new FormData(form),
                contentType: false,
                processData: false,
                success: function (resp) {
                    $('#alert').html(resp);
                    $('#loader').hide();
                }, error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status);
                }
            });
        }
    }
</script>