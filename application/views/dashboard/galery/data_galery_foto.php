<div id="datadetail">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Data Galery Foto
                <span class="pull-right">
                    <button class="btn btn-sm btn-success" onclick="dataGaleryFoto();"><i class="fa fa-refresh"></i></button>
                    <button class="btn btn-sm btn-primary" onclick="fUploadgalery_Foto();"><i class="fa fa-plus"></i></button>

                </span>
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
                                        <th>Status</th>
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
                                            <!-- <td><?php echo $value->deskripsi; ?></td> -->

                                            <!-- status belum di aktifkan, belum ditambah didatabase -->
                                            <td>
                                                <select name="status<?php echo $value->idphoto;  ?>" id="status<?php echo $value->idphoto;  ?>" class="form-control">
                                                    <option value="<?php echo $value->status; ?>"><?php echo $value->status; ?></option>
                                                    <option value="Active">Active</option>
                                                    <option value="Inactive">Inactive</option>
                                                </select>
                                            </td>
                                            <td>
                                                <textarea class="form-control" name="gallerytext<?php echo $value->idphoto; ?>" id="gallerytext<?php echo $value->idphoto; ?>" row="7" maxlength="50"><?php echo $value->deskripsi; ?></textarea>
                                            </td>
                                            <!-- <td><?php echo $value->nama_album; ?></td> -->
                                            <td>
                                                <select class="form-control" name="comboalbum<?php echo $value->idphoto; ?>" id="comboalbum<?php echo $value->idphoto; ?>">
                                                    <option selected="selected" value="<?php echo $value->id_album ?>"> <?php echo $value->nama_album ?></option>
                                                    <?php foreach ($album as $a) { ?>
                                                        <option id='option<?php echo $value->idphoto; ?>' value="<?php echo $a->id ?>" data-id_album="<?php echo $a->id ?>" data-nama_album="<?php echo $a->nama_album; ?>"> <?php echo $a->nama_album; ?> </option>
                                                    <?php } ?>
                                                </select>
                                            </td>

                                            <td>
                                                <button class="btn btn-sm btn-primary" title="update <?php echo $value->deskripsi; ?> " onclick="updateStatusGalery('<?php echo $value->idphoto; ?>');"><i class="fa fa-refresh"></i></button>
                                                <button class="btn btn-sm btn-danger" title="hapus <?php echo $value->deskripsi; ?>" onclick="deleteGalery('<?php echo $value->idphoto; ?>','<?php echo $value->deskripsi; ?>');"><i class="fa fa-trash"></i></button>
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
</div>
<script>
    function updateStatusGalery(idphoto) {


        var status = $('#status' + idphoto).val();
        var id_album = $('#comboalbum' + idphoto).val();
        // var link = $('#link' + id).val();
        // var sort = $('#sort' + id).val();
        var deskripsi = $('#gallerytext' + idphoto).val();

        // alert(album);

        $.ajax({
            url: "<?php echo base_url('d/Galery/update_status_galery'); ?>",
            method: "POST",
            data: {
                "idphoto": idphoto,
                "status": status,
                "deskripsi": deskripsi,
                "id_album": id_album
            },
            success: function(data) {
                $('#alert').html(data);
                dataGaleryFoto();
            }
        });
    }

    function deleteGalery(idphoto, deskripsi) {
        swal({
                title: "Hapus Galery " + deskripsi + " ini ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Hapus",
                cancelButtonText: "Batal",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: "<?php echo base_url('d/Galery/delete_galery'); ?>",
                        method: "POST",
                        data: {
                            "idphoto": idphoto
                        },
                        success: function(data) {
                            $('#alert').html(data);
                            dataGaleryFoto();
                        }
                    });
                    swal("Terhapus!", "Galery " + deskripsi + " Terhapus", "success");
                } else {
                    swal("", "", "error");
                }
            });

    }
</script>