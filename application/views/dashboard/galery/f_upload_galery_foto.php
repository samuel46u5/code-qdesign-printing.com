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


                                                <!-- <div class="form-group">
                                                    <label for="link" class="col-sm-2 control-label">Link Foto <span class="text-info" data-toggle="tooltip" title="Pilih Link untuk mengarahkan banner ke produk yang relevan"><i class="fa fa-question-circle fa-fw"></i></span></label>
                                                    <div class="col-sm-10">
                                                        <select class="form-control required" title="input this field" name="link" id="link">
                                                            <option selected="" disabled="" value="">Pilih Link produk</option>
                                                            <option value="<?php echo base_url(); ?>">Logo Toko</option>
                                                            <option value="null">Banner Title Page</option>
                                                            <?php echo $category; ?>
                                                        </select>
                                                    </div>
                                                </div> -->
                                                <div class="form-group">
                                                    <label for="bannertext" class="col-sm-2 control-label">Galery Text <span class="text-info" data-toggle="tooltip" title="Pilih Link untuk mengarahkan banner ke produk yang relevan"><i class="fa fa-question-circle fa-fw"></i></span></label>
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
<script type="text/javascript">
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