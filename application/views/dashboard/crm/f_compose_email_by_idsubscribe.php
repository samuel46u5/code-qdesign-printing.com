<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">Kirim E-mail ke <?php echo $data->email; ?>
        </h3>
        <div class="row">
            <div class="panel panel-green">
                <div class="panel-body">
                    <form role="form" method="POST" accept-charset="UTF-8" enctype="multipart/form-data" id="formemail">
                        <div class="form-group">
                            <label>Kepada</label>
                            <input class="form-control" name="email" id="email" type="email" required="" value="<?php echo $data->email; ?>">
                            <p class="help-block"  onclick="showCC();" id="showcc"><i class="fa fa-plus"></i> tampilkan CC/BCC</p>
                            <p class="help-block"  onclick="hideCC();" id="hidecc"><i class="fa fa-minus"></i> sembunyikan CC/BCC</p>
                        </div>
                        <div class="form-group" id="cc">
                            <label>CC.</label>
                            <input class="form-control" type="email" id="cc" name="cc">
                        </div>
                        <div class="form-group">
                            <label>Judul</label>
                            <input type="text" class="form-control" placeholder="Enter text" required="">
                        </div>
                        <div class="form-group">
                            <label for="">Pesan</label>
                            <textarea id="wysiwyg" class="textarea required form-control" rows="7" name="pesan" id="pesan" required></textarea>
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