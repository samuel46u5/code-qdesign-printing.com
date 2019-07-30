<?php echo $header; ?>
<div class="bread-crumb-detail bgwhite flex-w p-l-52 p-r-15 p-t-50">
    <a href="<?php echo base_url('') ?>" class="s-text16">
        Home
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>
    <a href="<?php echo base_url('pages/cart?idorder=') ?><?php
                                                            if (empty($ordershiping)) { } else {
                                                                echo $ordershiping->idorder;
                                                            }
                                                            ?>" class="s-text16">
        Keranjang Belanja
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>
    <span class="s-text17">
        Data Pembeli
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </span>
    <a href="JavaScript:void(0);" class="s-text16">
        Metode Pengiriman
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>
    <a href="JavaScript:void(0);" class="s-text16">
        Metode Pembayaran
    </a>
</div>
<section class="cart bgwhite p-t-30 p-b-100">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="login_title form-customer">
                    <h6><u>Data Penerima Barang</u></h6>
                </div>
                <form class="login_form row form-customer" action="<?php echo base_url('Order/store_data_customer?idorder=') ?><?php
                                                                                                                                if (empty($orderresult)) { } else {
                                                                                                                                    echo $orderresult->idorder;
                                                                                                                                }
                                                                                                                                ?>" method="post">
                    <div class="col-lg-6 form-group">
                        <label for="firstname"><small>Nama Depan</small></label>
                        <input class="form-control" type="text" name="firstname" id="firstname" placeholder="Nama Depan" required="" value="<?php
                                                                                                                                            if (empty($ordershiping)) { } else {
                                                                                                                                                echo $ordershiping->firstName;
                                                                                                                                            }
                                                                                                                                            ?>">
                    </div>
                    <div class="col-lg-6 form-group">
                        <label for="lastname"><small>Nama Belakang</small></label>
                        <input class="form-control" type="text" name="lastname" id="lastname" placeholder="Nama Belakang" required="" value="<?php
                                                                                                                                                if (empty($ordershiping)) { } else {
                                                                                                                                                    echo $ordershiping->lastName;
                                                                                                                                                }
                                                                                                                                                ?>">
                    </div>
                    <div class="col-lg-12 form-group">
                        <label for="fulladdress"><small>Alamat Lengkap</small></label>
                        <textarea class="form-control" type="text" name="fulladdress" id="fulladdress" placeholder="Alamat Lengkap isikan dengan nama jalan, nama gedung atau yang lebih spesifik" required="" row="7"><?php
                                                                                                                                                                                                                        if (empty($ordershiping)) { } else {
                                                                                                                                                                                                                            echo $ordershiping->fullAddress;
                                                                                                                                                                                                                        }
                                                                                                                                                                                                                        ?></textarea>
                    </div>

                    <div class="col-lg-4 form-group">
                        <label for="desa"><small>Desa</small></label>
                        <input class="form-control" type="text" name="desa" id="desa" placeholder="Desa" value="<?php
                                                                                                                if (empty($ordershiping)) { } else {
                                                                                                                    echo $ordershiping->desa;
                                                                                                                }
                                                                                                                ?>">
                    </div>
                    <div class="col-lg-2 form-group">
                        <label for="rt"><small>Rt</small></label>
                        <input onkeyup="if (/\D/g.test(this.value))
                                    this.value = this.value.replace(/\D/g, '')" class="form-control" type="text" name="rt" id="rt" placeholder="RT" value="<?php
                                                                                                                                                            if (empty($ordershiping)) { } else {
                                                                                                                                                                echo $ordershiping->rt;
                                                                                                                                                            }
                                                                                                                                                            ?>">
                    </div>
                    <div class="col-lg-2 form-group">
                        <label for="rw"><small>Rw</small></label>
                        <input onkeyup="if (/\D/g.test(this.value))
                                    this.value = this.value.replace(/\D/g, '')" class="form-control" type="text" name="rw" id="rw" placeholder="RW" value="<?php
                                                                                                                                                            if (empty($ordershiping)) { } else {
                                                                                                                                                                echo $ordershiping->rw;
                                                                                                                                                            }
                                                                                                                                                            ?>">
                    </div>
                    <div class="col-lg-4 form-group">
                        <label for="provinsi"><small>Kecamatan</small></label>
                        <input class="form-control" type="text" name="kecamatan" id="kecamatan" placeholder="Kecamatan" value="<?php
                                                                                                                                if (empty($ordershiping)) { } else {
                                                                                                                                    echo $ordershiping->kecamatan;
                                                                                                                                }
                                                                                                                                ?>">
                    </div>

                    <div class="col-lg-5 form-group">
                        <label for="provinsi"><small>Provinsi</small></label>
                        <select name="provinsi" id="provinsi" class="form-control">
                            <?php
                            if (empty($ordershiping)) {
                                echo '<option value="" disabled="" selected="">Provinsi</option>';
                            } else {
                                echo '<option selected="" value="' . $ordershiping->codeProvinsi . '">' . $ordershiping->namaProvinsi . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-lg-5 form-group">
                        <label for="kabupaten"><small>Kota / Kabupaten</small></label>
                        <select class="form-control" name="kabupaten" id="kabupaten" required="">
                            <?php
                            if (empty($ordershiping)) {
                                echo '<option value="" disabled="" selected="">Kabupaten</option>';
                            } else {
                                echo '<option selected="" value="' . $ordershiping->codeKabupaten . '">' . $ordershiping->namaKabupaten . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-lg-2 form-group">
                        <label for="postalcode"><small>Kode Pos</small></label>
                        <input onkeyup="if (/\D/g.test(this.value))
                                    this.value = this.value.replace(/\D/g, '')" class="form-control" type="text" name="postalcode" id="postalcode" placeholder="Kode Pos" value="<?php
                                                                                                                                                                                    if (empty($ordershiping)) { } else {
                                                                                                                                                                                        echo $ordershiping->kodePos;
                                                                                                                                                                                    }
                                                                                                                                                                                    ?>" minlength="5" maxlength="8">
                    </div>
                    <div class="col-lg-6 form-group">
                        <label for="customerphone"><small>Nomor Telepon / HP</small></label>
                        <input onkeyup="if (/\D/g.test(this.value))
                                    this.value = this.value.replace(/\D/g, '')" class="form-control" type="text" name="customerphone" id="customerphone" placeholder="Nomor Telepon / HP" required="" value="<?php
                                                                                                                                                                                                                if (empty($ordershiping)) { } else {
                                                                                                                                                                                                                    echo $ordershiping->custHp;
                                                                                                                                                                                                                }
                                                                                                                                                                                                                ?>" maxlength="14">
                    </div>
                    <div class="col-lg-6 form-group">
                        <label for="customeremail"><small>Alamat Email</small></label>
                        <input class="form-control" type="email" name="customeremail" id="customeremail" placeholder="Alamat Email" required="" value="<?php
                                                                                                                                                        if (empty($ordershiping)) { } else {
                                                                                                                                                            echo $ordershiping->custEmail;
                                                                                                                                                        }
                                                                                                                                                        ?>">
                    </div>
                    <div class="col-lg-6 form-group">
                        <a href="<?php echo base_url('pages/cart?idorder=') ?><?php
                                                                                if (empty($orderresult)) { } else {
                                                                                    echo $orderresult->idorder;
                                                                                }
                                                                                ?>"><i class="fa fa-angle-double-left p-r-10"></i> Kembali ke Keranjang Belanja</a>
                    </div>
                    <div class="col-lg-6 form-group">
                        <button type="submit" value="submit" class="btn subs_btn form-control">Lanjut ke Pengiriman <i class="fa fa-angle-double-right"></i></button>
                    </div>
                </form>
            </div>
            <div class="bo9 col-md-5 p-l-40 p-r-40 p-t-30 p-b-38 m-t-30 bg5">
                <h5 class="p-b-24 bo20">
                    Keranjang Belanja
                </h5>
                <div class="flex-w flex-sb-m p-b-12 bo20">
                    <table>
                        <?php foreach ($detailorder as $items) { ?>
                            <tr>
                                <th class="p-r-10"><small>(<?php echo $items->productQty; ?>)</small></th>
                                <td class="p-r-10"><small> <?php echo $items->productName; ?></small></td>
                                <td><small>Rp. <?php echo number_format($items->subtotalPrice); ?></small></td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
                <div class="flex-w flex-sb-m p-b-12 bo20">
                    <table>
                        <tr>
                            <th class="p-r-20"><small>Jumlah Pesanan</small></th>
                            <td><small><?php echo array_sum(array_column($detailorder, 'productQty')); ?> pcs</small></td>
                        </tr>
                        <tr>
                            <th class="p-r-20"><small>Jumlah Berat (KG)</small></th>
                            <td><small><?php echo ceil(($ordershiping->totalWeight) / 1000); ?> Kg</small></td>
                        </tr>
                    </table>
                </div>
                <div class="flex-w flex-sb-m p-b-12">
                    <span class="s-text18 w-size19 w-full-sm">
                        Subtotal:
                    </span>
                    <span class="w-full-sm">
                        <?php echo "Rp. " . number_format($this->cart->total()); ?>
                    </span>
                </div>
                <div class="flex-w flex-sb-m p-b-12 bo20">
                    <span class="s-text18 w-size19 w-full-sm">
                        Ongkos Kirim :
                    </span>
                    <span class="w-full-sm">
                        Rp. <?php echo number_format($ordershiping->shipingCarge) . "  (" . $ordershiping->shipingName . ")"; ?> <small><i>selesaikan proses</i></small>
                    </span>
                </div>
                <div class="flex-w flex-sb-m p-b-12 bo20">
                    <span class="s-text18 w-size19 w-full-sm">
                        Voucher :
                    </span>
                    <span class="w-full-sm">
                        Rp. <?php echo number_format($orderresult->voucherPrice); ?> <small><i>selesaikan proses</i></small>
                    </span>
                </div>
                <div class="flex-w flex-sb-m p-b-12 bo20">
                    <span class="s-text18 w-size19 w-full-sm">
                        Discount Partner :
                    </span>
                    <span class="w-full-sm">
                        Rp. <?php
                            echo number_format($orderresult->partnerDiscount);
                            if (empty($orderresult->partnerDiscount)) {
                                echo '<small><i>silahkan login</i></small>';
                            }
                            ?>
                    </span>
                </div>
                <div class="flex-w flex-sb-m p-b-12 bo20">
                    <span class="s-text18 w-size19 w-full-sm">
                        Total
                    </span>

                    <span class="w-full-sm">
                        <?php echo "Rp. " . number_format($orderresult->orderSumary); ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
</section>
<?php echo $footer; ?>
<script type="text/javascript">
    $(document).ready(function() {
        function getProvinsi() {
            var $op = $("#provinsi")
            $('#provinsi').after('<i class="fa fa-spinner fa-pulse fa-2x fa-fw loading color0"></i>');
            $.getJSON("<?php echo base_url('') ?>d/Shipinggateway/get_provinsi", function(data) {
                $.each(data, function(i, field) {
                    $op.append('<option value="' + field.province_id + '">' + field.province + '</option>');
                });
                $('.loading').remove();
            });

        }
        getProvinsi();

        $("#provinsi").on("change", function(e) {
            e.preventDefault();
            var option = $('option:selected', this).val();
            $('#kabupaten option:gt(0)').remove();

            if (option === '') {
                alert('null');
                $("#kabupaten").prop("disabled", true);

            } else {
                $("#kabupaten").prop("disabled", false);
                getKota(option);
            }
        });

        function getKota(idpro) {
            var $op = $("#kabupaten");

            $('#kabupaten').after('<i class="fa fa-spinner fa-pulse fa-2x fa-fw loading color0"></i>');
            $.getJSON("<?php echo base_url('') ?>d/Shipinggateway/get_kota/" + idpro, function(data) {
                $.each(data, function(i, field) {
                    $op.append('<option value="' + field.city_id + '">' + field.type + ' ' + field.city_name + '</option>');
                });
                $('.loading').remove();
            });
        }
    });
</script>
</body>

</html>