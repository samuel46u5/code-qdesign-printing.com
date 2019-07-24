<div id="datadetail">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Data Galery Foto
                <button class="btn btn-primary pull-right" onclick="fUploadgalery_Foto();"><i class="fa fa-upload"></i> Upload Foto</button>
            </h3>
            <div class="row">
                <div id="dataresult"></div>
                <div class="panel panel-green">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" id="dataTables-datagaleryfoto">
                                <thead>
                                    <tr>
                                        <th>Cover</th>

                                        <th>Deskripsi</th>
                                        <th>Album</th>
                                        <th>Aksi</th>
                                        <!-- <th>Status</th>
                                        <th>Upload By</th>
                                        <th>Link Produk</th>
                                        <th>Aksi</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data as $value) { ?>
                                        <tr class="">
                                            <td><img src="<?php echo site_url('asset/img/uploads/galery/') . $value->image; ?>" style="max-width: 180px;"></td>
                                            <td><?php echo $value->deskripsi; ?></td>

                                            <td><?php echo $value->nama_album; ?></td>

                                            <td>
                                                action
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
        // function updateStock(id) {
        //     var stock = $('#stock' + id).val();
        //     $.ajax({
        //         url: "<?php echo site_url('d/Product/update_stock'); ?>",
        //         method: "POST",
        //         data: {
        //             "id": id,
        //             "stock": stock
        //         },
        //         success: function(data) {
        //             $('#alert').html(data);
        //             dataProduct();
        //         }
        //     });
        // }

        // function fUpdate(id) {
        //     $.ajax({
        //         url: "<?php echo site_url('d/Product/f_update_product'); ?>",
        //         method: "POST",
        //         data: {
        //             "id": id
        //         },
        //         success: function(data) {
        //             $('#dataresult').html(data);
        //             loadPhotoEdit();
        //             $('.money').mask('0.000.000.000', {
        //                 reverse: true
        //             });
        //             $(".textarea").wysihtml5();
        //         }
        //     });
        // }

        // function fAddSale(id) {
        //     $.ajax({
        //         url: "<?php echo site_url('d/Marketing/f_add_sale_product'); ?>",
        //         method: "POST",
        //         data: {
        //             "id": id
        //         },
        //         success: function(data) {
        //             $('#dataresult').html(data);
        //             $(".textarea").wysihtml5();
        //             $('.money').mask('0.000.000.000', {
        //                 reverse: true
        //             });
        //         }
        //     });
        // }

        // function AddBestSeller(id) {
        //     $.ajax({
        //         url: "<?php echo site_url('d/Marketing/add_product_bestseller'); ?>",
        //         method: "POST",
        //         data: {
        //             "id": id
        //         },
        //         success: function(data) {
        //             $('#dataresult').html(data);
        //             $(".textarea").wysihtml5();
        //             $('.money').mask('0.000.000.000', {
        //                 reverse: true
        //             });
        //         }
        //     });
        // }
        // $(document).on('click', '.delproduct', function() {
        //     var idupload = $(this).data("idupload");
        //     var id = $(this).data("idproduct");
        //     swal({
        //             title: "Hapus Produk ini ?",
        //             type: "warning",
        //             showCancelButton: true,
        //             confirmButtonColor: "#DD6B55",
        //             confirmButtonText: "Hapus",
        //             cancelButtonText: "Batal",
        //             closeOnConfirm: false,
        //             closeOnCancel: false
        //         },
        //         function(isConfirm) {
        //             if (isConfirm) {
        //                 $.ajax({
        //                     url: '<?php echo base_url('d/Product/delete_product'); ?>',
        //                     method: "POST",
        //                     data: {
        //                         "idproduct": id,
        //                         "idupload": idupload
        //                     },
        //                     success: function(data) {
        //                         $('#alert').html(data);
        //                         dataProduct();
        //                         $(".alert").fadeTo(3500, 0).slideUp(500, function() {
        //                             $(this).remove();
        //                         });
        //                     }
        //                 });
        //                 swal("Terhapus!", "Produk Anda Terhapus", "success");
        //             } else {
        //                 swal("", "Produk Anda Masih Tersimpan", "error");
        //             }
        //         });
        // });
    </script>

</div>