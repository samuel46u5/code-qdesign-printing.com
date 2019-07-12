<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">Data Produk
            <button class="btn btn-primary pull-right" onclick="fUploadProduct();"><i class="fa fa-upload"></i> Upload Produk</button>      
        </h3>
        <div class="row">
            <div id="dataresult"></div>
            <div class="panel panel-green">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" id="dataTables-dataproduct">
                            <thead>
                                <tr>
                                    <th>Cover</th>
                                    <th>Nama Produk</th>
                                    <th>Harga</th>
                                    <th>Jumlah Stok</th>
                                    <th>Upload By</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data as $value) { ?>
                                    <tr class="">
                                        <td><img src="<?php
                                            echo site_url('asset/img/uploads/product/');
                                            echo $value->fotoName;
                                            ?>" style="max-width:120px;"></td>
                                        <td><?php echo $value->productName; ?></td>
                                        <td><?php echo "Rp " . "<span class='money'>" . $value->price . "</span>"; ?></td>
                                        <td><input class="form-control" type="number" id="stock<?php echo $value->idproduct; ?>" value="<?php echo $value->quantityStock; ?>"></td>
                                        <td><?php echo $value->username;?></td>
                                        <td><?php echo $value->productStatus; ?></td>
                                        <td>
                                            <button class="btn btn-sm btn-primary" data-toggle="tooltip" title="update stok" id="<?php echo $value->idproduct; ?>" onclick="updateStock('<?php echo $value->idproduct; ?>');"><i class="fa fa-refresh"></i></button>
                                            <button class="btn btn-sm btn-warning" data-toggle="tooltip" title="update produk" onclick="fUpdate('<?php echo $value->idproduct; ?>');"><i class="fa fa-pencil"></i></button>
                                            <button class="delproduct btn btn-sm btn-danger" data-toggle="tooltip" title="hapus produk" data-idupload="<?php echo $value->idupload; ?>" data-idproduct="<?php echo $value->idproduct; ?>"><i class="fa fa-trash"></i></button> |
                                            <button class="saleproduct btn btn-sm btn-success" data-toggle="tooltip" title="atur diskon" onclick="fAddSale('<?php echo $value->idproduct; ?>');"><i class="fa fa-dollar"></i></button>
                                           <button class="btn btn-sm btn-danger" data-toggle="tooltip" title="atur best seller" onclick="AddBestSeller('<?php echo $value->idproduct; ?>');"><i class="fa fa-heart"></i></button>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>      
    </div>
</div>
<script>
    function updateStock(id) {
        var stock = $('#stock' + id).val();
        $.ajax({
            url: "<?php echo site_url('d/Product/update_stock'); ?>",
            method: "POST",
            data: {"id": id, "stock": stock},
            success: function (data) {
                $('#alert').html(data);
                dataProduct();
            }
        });
    }
    function fUpdate(id) {
        $.ajax({
            url: "<?php echo site_url('d/Product/f_update_product'); ?>",
            method: "POST",
            data: {"id": id},
            success: function (data) {
                $('#dataresult').html(data);
                loadPhotoEdit();
                $('.money').mask('0.000.000.000', {reverse: true});
                $(".textarea").wysihtml5();
            }
        });
    }
    function fAddSale(id) {
        $.ajax({
            url: "<?php echo site_url('d/Marketing/f_add_sale_product'); ?>",
            method: "POST",
            data: {"id": id},
            success: function (data) {
                $('#dataresult').html(data);
                $(".textarea").wysihtml5();
                $('.money').mask('0.000.000.000', {reverse: true});
            }
        });
    }
    function AddBestSeller(id) {
        $.ajax({
            url: "<?php echo site_url('d/Marketing/add_product_bestseller'); ?>",
            method: "POST",
            data: {"id": id},
            success: function (data) {
                $('#dataresult').html(data);
                $(".textarea").wysihtml5();
                $('.money').mask('0.000.000.000', {reverse: true});
            }
        });
    }
    $(document).on('click', '.delproduct', function () {
        var idupload = $(this).data("idupload");
        var id = $(this).data("idproduct");
        swal({
            title: "Hapus Produk ini ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Hapus",
            cancelButtonText: "Batal",
            closeOnConfirm: false,
            closeOnCancel: false
        },
                function (isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url: '<?php echo base_url('d/Product/delete_product'); ?>',
                            method: "POST",
                            data: {"idproduct": id, "idupload": idupload},
                            success: function (data) {
                                $('#alert').html(data);
                                dataProduct();
                                $(".alert").fadeTo(3500, 0).slideUp(500, function () {
                                    $(this).remove();
                                });
                            }
                        });
                        swal("Terhapus!", "Produk Anda Terhapus", "success");
                    } else {
                        swal("", "Produk Anda Masih Tersimpan", "error");
                    }
                });
    });
</script>