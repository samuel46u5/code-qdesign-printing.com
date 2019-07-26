<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">Galery Foto
        </h3>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        Unggah Foto Galery
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12" id="formfoto">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="col-lg-12">
                                            <form role="form" class="form-horizontal" method="POST" enctype="multipart/form-data" id="forminputgalery" action="">
                                                <div class="form-group">
                                                    <label for="link" class="col-sm-2 control-label">Album <span class="text-info" data-toggle="tooltip" title="Tentukan nama album untuk galery"><i class="fa fa-question-circle fa-fw"></i></span></label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" name="album" id="album" required="" onchange="CmbAlbumChange()">
                                                            <option disabled="" selected="">Pilih album galery</option>
                                                            <?php foreach ($data as $value) { ?>
                                                                <option id="<?php echo $value->id ?>" value="<?php echo $value->id ?>" data-id_album="<?php echo $value->id ?>" data-nama_album="<?php echo $value->nama_album; ?>"> <?php echo $value->nama_album; ?> </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <!-- <input type="button" onclick="doTambahAlbum();" class="btn-submit btn btn-success pull-right" value="Album Galery"> -->
                                                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" title="tambah album" data-target="#albumModal"><i class="fa fa-plus-square"></i></button>
                                                        <button type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" title="update album" id="refresh-album" onclick=""><i class="fa fa-refresh"></i></button>
                                                        <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" title="update album" data-target="#editAlbumModal" id="edit-album"><i class="fa fa-pencil"></i></button>
                                                        <button type="button" class="btn btn-sm btn-danger" title="hapus album" id="hapus-album" data-target="#HapusAlbumModal" onclick="doHapusAlbum()"><i class="fa fa-trash"></i></button>


                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="bannertext" class="col-sm-2 control-label">Galery Text <span class="text-info" data-toggle="tooltip" albumle="Pilih album untuk mengarahkan banner ke produk yang relevan"><i class="fa fa-question-circle fa-fw"></i></span></label>
                                                    <div class="col-sm-10">
                                                        <textarea class="form-control" name="bannertext" id="bannertext" row="7" maxlength="50" placeholder="maksimal 50 karakter"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label" for="filefoto">Upload Foto</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control required" title="input this field" type="file" name="filefoto" id="filefoto" required="" accept="image/*" multiple>
                                                    </div>
                                                </div>
                                                <input type="reset" class="btn btn-default pull-left" value="Reset">
                                                <input type="button" onclick="doUploadfotoGalery();" class="btn-submit btn btn-success pull-right" value="unggah">
                                            </form>
                                        </div>
                                        <div class="col-lg-12">
                                            <div id="progresbar">
                                                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                                    <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="albumModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Album Galery</h4>
            </div>
            <div class="modal-body">
                <form role="form" class="" method="POST" id="forminputalbum" action="">
                    <div class="form-group">
                        <label for="nama-album" class="control-label">Nama Album</label>
                        <input class="form-control" name="nama_album" id="nama_album" type="text" required="">
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <input type="button" onclick="doTambahAlbum();" class="btn-submit btn btn-success pull-right" value="Simpan">
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="editAlbumModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Edit Album Galery</h4>
            </div>
            <div class="modal-body" id="qq">
                <form role="form" class="" method="POST" id="formUpdateAlbum" action="">
                    <div class="form-group">
                        <input type="hidden" class=" form-control" id="id_album" name="id_album">
                        <label for="nama-albumlama" class="control-label">Nama Album lama</label>
                        <input class="form-control" name="nama_album_lama" id="nama_album_lama" disabled="" type="text" required="">
                    </div>
                    <div class="form-group">
                        <label for="nama-albumbaru" class="control-label">Nama Album baru</label>
                        <input class="form-control" name="nama_album_baru" id="nama_album_baru" type="text" required="">
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <input type="button" onclick="doUpdateAlbum();" class="btn-submit btn btn-success pull-right" value="Update">
            </div>
        </div>

    </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {
        //disabled button ketika halaman baru dibuka
        $("#edit-album").attr("disabled", "disabled");
        $("#refresh-album").attr("disabled", "disabled");
        $("#hapus-album").attr("disabled", "disabled");
    });





    function doUpdateAlbum() {
        // var id = $("#qq #id_album").val();
        // var nama_album = $("#qq #nama_album_baru").val();

        var form = $('#formUpdateAlbum').get(0);
        $('#loader').show();
        $.ajax({
            url: "<?php echo base_url('d/Galery/update_album'); ?>",
            method: "POST",
            data: new FormData(form),
            contentType: false,
            processData: false,
            success: function(data) {
                $('#loader').hide();
                $('#editAlbumModal').modal('hide');
                alert('sukses update');
            }
        });
    }

    function doHapusAlbum() {
        var id = $("#album :selected").val();
        var nama_album = $("#album :selected").text();
        swal({
                title: "Hapus Album" + nama_album + "?",
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
                        url: "<?php echo base_url('d/Galery/hapus_album'); ?>",
                        method: "POST",
                        data: {
                            "id": id
                        },
                        success: function(data) {
                            $('#alert').html(data);
                            // dataBanner();
                        }
                    });
                    swal("Terhapus!", "Album" + nama_album + "Terhapus", "success");
                } else {
                    swal("Cancel", "Batal hapus", "error");
                }
            });
    }





    function CmbAlbumChange() {
        var x = document.getElementById("album");

        $("#edit-album").removeAttr("disabled", "disabled");
        $("#refresh-album").removeAttr("disabled", "disabled");
        $("#hapus-album").removeAttr("disabled", "disabled");

        // var id = $("#album").data('id_album');
        // var nama_album = $("#album").data('nama_album');

        // alert($("#album :selected").text());
        // alert($("#album :selected").val());

        $("#qb #id_album_hapus").val($("#album :selected").val());
        $("#qb #nama_album_hapus").val($("#album :selected").text());

        $("#qq #id_album").val($("#album :selected").val());
        $("#qq #nama_album_lama").val($("#album :selected").text());
    }



    function doTambahAlbum() {
        var valid = $("#forminputalbum").valid();
        if (valid == true) {
            var form = $('#forminputalbum').get(0);
            $('#loader').show();
            $.ajax({
                url: '<?php echo base_url('d/Galery/do_upload_album') ?>',
                method: "POST",
                data: new FormData(form),
                contentType: false,
                processData: false,
                success: function(resp) {
                    $('#alert').html(resp); //menampilkan alert
                    $('#loader').hide(); //menyembunyikan loader
                    $('#albumModal').modal('hide'); //menutup modal
                    //update isi album
                }
            });
        }
    }

    function doUploadfotoGalery() {
        var valid = $("#forminputgalery").valid();
        if (valid == true) {
            var form = $('#forminputgalery').get(0);
            var submit = $('input[type="button"]');
            submit.attr('disabled', true);
            $('#proses').show();
            $('#progresbar').show('slow');
            $.ajax({
                url: '<?php echo base_url('d/Galery/do_upload_galery') ?>',
                method: "POST",
                data: new FormData(form),
                contentType: false,
                processData: false,
                success: function(html) {
                    $('.progress-bar').width('0%');
                    $('#alert').html(html);
                    $('#proses').hide();
                },
                complete: function() {
                    submit.attr('disabled', false);
                    $('#alert').html();
                    $('#progresbar').hide();
                    //document.getElementById("forminputgalery").reset();
                },
                xhr: function() {
                    var xhr = $.ajaxSettings.xhr();
                    xhr.upload.onprogress = function(e) {
                        var onprogress = Math.floor(e.loaded / e.total * 100) + '%';
                        $('.progress-bar').width(onprogress);
                    };
                    return xhr;
                }

            });
        }
    }
</script>