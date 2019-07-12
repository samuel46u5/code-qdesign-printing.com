<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">Kirim E-mail ke <?php echo $data->firstName;?>
        </h3>
        <div class="row">
            <div class="panel panel-green">
                <div class="panel-body">
                    <form role="form">
                        <div class="form-group">
                            <label>Kepada</label>
                            <input class="form-control" type="email" required="" value="<?php echo $data->custEmail;?>">
                            <p class="help-block"  onclick="showCC();" id="showcc"><i class="fa fa-plus"></i> tampilkan CC/BCC</p>
                            <p class="help-block"  onclick="hideCC();" id="hidecc"><i class="fa fa-minus"></i> sembunyikan CC/BCC</p>
                        </div>
                        <div class="form-group" id="cc">
                            <label>CC.</label>
                            <input class="form-control" type="email" id="cc" name="cc">
                        </div>
                        <div class="form-group">
                            <label>Judul</label>
                            <input class="form-control" placeholder="Enter text" required="" value="<?php echo "Konfirmasi Order ".$data->idorder." dengan Status ".$data->status;?> ">
                        </div>
                        <div class="form-group">
                            <label for="">Pesan</label>
                            <textarea id="wysiwyg" class="textarea required form-control" rows="7" name="pesan" id="pesan" required>Halo kak <?php echo $data->firstName." ".$data->lastName. "<br> Status Order Kakak ".$data->status ;?></textarea>
                        </div>
                        <button type="submit" class="btn btn-success pull-right">Kirim Email</button>
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
</script>