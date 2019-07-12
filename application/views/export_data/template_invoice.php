<!DOCTYPE html>
<html lang="en">
    <head>
        <style type="text/css">
            html { font-size: 12px; line-height: 1.5; color: #000; background: #ddd; }
body { background: white; border: 1px solid #aaa; padding: 2rem; } .col,
.logoholder, .me, .info, .bank, [class*="col-"] { vertical-align: top;
display: inline-block; font-size: 1rem; padding: 0 1rem; min-height: 1px; }
.col-4 { width: 25%; }
.col-3 { width: 33.33%; } .col-2 { width: 50%; } .col-2-4 { width: 75%; }
.col-1 { width: 100%; } .text-center { text-align: center; } .text-right {
text-align: right; } a { color: #F14C4C; text-decoration: none; } p { margin:
0; } header { padding: 0 0 4rem 0; border-bottom: 2pt solid #825a2c; } header
p { font-size: .9rem; } header a { color: #000; } footer { color: #5D6975;
width: 100%; height: 30px; /*postion: absolute;*/ bottom: 0; border-top: 1px
solid #C1CED9; padding: 8px 0; text-align: center; } .headline { border-top:
1px solid  #5D6975; border-bottom: 1px solid  #5D6975; color: #ffffff;
font-size: 1.5em; font-weight: normal; text-align: center; margin: 0 0 10px 0;
background-color: #343a40; } .logo { margin: 0 auto; width: auto; height:
auto; border: none; fill: #F14C4C; } .logoholder{ width: 15%; } .logoholder
img{ width: 100%; } .me { width: 30% } .info { width: 30%; float: right;
margin-bottom: 10px; } .bank { width: 30%; } .desc{ margin-top: 20px; }
.section { margin: 3rem 0 0; } .smallme { display: inline-block;
text-transform: uppercase; margin: 0 0 2rem 0; font-size: .9rem; } .client {
margin: 0 0 3rem 0; } h1 { margin: 0; padding: 0; font-size: 2rem; color:
#F14C4C; } .invoicelist-body { margin: 1rem; } .invoicelist-body table {
width: 100%; } .invoicelist-body thead { text-align: left; border-bottom: 2pt
solid #666; } .invoicelist-body td, .invoicelist-body th { position: relative;
padding: 1rem; } .invoicelist-body .newRow { margin: .5rem 0; float: left; }
.invoicelist-body .removeRow { display: none; position: absolute; top: .1rem;
bottom: .1rem; left: -1.3rem; font-size: .7rem; border-radius: 3px 0 0 3px;
padding: .5rem; } .invoicelist-footer { margin: 1rem; } .invoicelist-footer
table { float: right; width: 25%; } .invoicelist-footer table td { padding:
1rem 2rem 0 1rem; text-align: right; } .invoicelist-footer table #total_price
{ font-size: 2rem; color: #F14C4C; } .note { margin: 1rem; } .hidenote .note {
display: none; } .note h2 { margin: 0; font-size: 1rem; font-weight: bold; }
@media print { html { margin: 0; padding: 0; background: #fff; } body { width:
100%; border: none; background: #fff; margin: 0; padding: 0; } .control,
.control-bar { display: none !important; }
 [contenteditable]:hover, [contenteditable]:focus { outline: none; } }
        </style>
    </head>
    <body>
        <header class="row">
            <div class="logoholder text-center header-desc">
                <img class="logo" src="asset/img/uploads/banner/<?php echo $logo->image ?>">
            </div>
            <div class="me">
                <p>
                    <strong><?php echo $profile->companyName; ?></strong><br>
                    <?php echo $profile->address1; ?>
                </p>
            </div>
            <div class="info">
                <p>
                    Web:  <?php echo base_url(); ?><br>
                    Mail: <?php echo $profile->email; ?><br>
                    Tel: <?php echo $profile->phone1 . " - " . $profile->phone2; ?> <br>
                    IG : <?php echo $profile->igLink; ?> <br>
                    FB : <?php echo $profile->fbLink; ?>
                </p>
            </div>
        </header>
        <div class="headline">
            <?php
            if (empty($ordershiping) && empty($orderresult) && empty($detailorder)) {
                echo "Maaf Data Kosong, Cek kembali nomor id order";
            } else {
                ?>
                <p style="color:#ffffff">INVOICE <?php echo $orderresult->idorder; ?></p>
            </div>
            <div class="desc">
                <div class="me">
                    <p>
                        <strong>Ditagihkan Kepada</strong><br><br>
                        <?php echo $ordershiping->firstName . " " . $ordershiping->lastName; ?><br>
    <?php echo $ordershiping->desa . ", " . $ordershiping->rt . " " . $ordershiping->rw . " , " . $ordershiping->kecamatan . " , " . $ordershiping->namaKabupaten . " , " . $ordershiping->namaProvinsi . ". (kode pos: " . $ordershiping->kodePos . " )."; ?><br>
    <?php echo $ordershiping->custHp; ?>
                    </p>
                </div>
            </div>

            <div class="invoicelist-body">
                <table>
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
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Uniq Payment</td>
                            <td><?php
    $countstr = strlen($orderresult->orderSumary);
    echo "Rp. " . substr($orderresult->orderSumary, $countstr - 3);
    ?> 
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Total</td>
                            <td><b><?php echo "Rp. " . number_format($orderresult->orderSumary); ?></b></td>
                        </tr>
                    </tbody>
                </table>
            </div>
<?php } ?>
        <footer>
            <div class="footer">
                Invoice was created on a computer and is valid without the signature and seal.
            </div>
        </footer> 
    </body>
</html>