<div class="row" id="topupdateproduct">
    <div class="alert alert border-grey" alert-dismissable>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>Penting!!!</strong><br>
        Anda tidak dapat mengubah foto cover(foto nomor 1) atau Anda dapat menghapus produk lalu mengunggah ulang.
    </div>
    <div class="panel panel-green">
        <div class="panel-heading">
            Edit Produk <?php echo $data->productName." - ".$data->idproduct; ?>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <form role="form" method="POST" accept-charset="UTF-8" enctype="multipart/form-data" id="productdescedit">
                                <input name="idproduct" id="idproduct" type="hidden" value="<?php echo $data->idproduct; ?>">
                                <input name="idupload" id="idupload" type="hidden" value="<?php echo $data->idupload; ?>">
                                <input id="idf" type="hidden" value="<?php echo count($datamultilevel)+count($datamultilevel);?>">
                                <div class="form-group">
                                    <label>Kategori</label>
                                    <select class="form-control" name="category" id="category">
                                        <option selected="" value="<?php echo $data->idcategory; ?>"><?php echo $data->categoryName; ?></option>
                                        <?php echo $category; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Nama Produk</label>
                                    <input class="form-control" name="productname" id="productname" type="text" required="" value="<?php echo $data->productName; ?>">
                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-addon">Rp.</span>
                                    <input class="form-control money" name="productprice" id="productprice" type="text" value="<?php echo $data->price; ?>" required="">
                                </div>
                                <?php if(!empty($datamultilevel)){?>
                                    <div class="form-group">
                                        <label for="multilevelstatus" class="checkbox-inline">
                                            <input type="checkbox" value="yes" name="multilevelstatus" id="multilevelstatus" onclick="multilevelStatus();" checked>Tambah Harga Bertingkat
                                        </label>
                                    </div>
                                    <div id="multilevelpricerow1">
                                        <div class="form-group row">
                                            <div class="col-xs-4">
                                                <label>unit</label>
                                                <input type="text" class="form-control" name="unit" id="unit" required="" value="<?php echo $datamultilevel[0]->unit;?>">
                                            </div>
                                            <div class="col-xs-3">
                                                <label>add Form</label>
                                                <a href="JavaScript:void(0);" onclick="addRangePrice();" class="btn-sm btn-success"><i class="fa fa-plus"></i></a>
                                            </div>
                                        </div>
                                        <?php $i = count($datamultilevel);$j = count($datamultilevel); foreach ($datamultilevel as $value) {?>
                                            <div class="form-group row" id="srow<?php echo $i++;?>">
                                                <div class="col-xs-3">
                                                    <label for="rangestart">Range Start</label>
                                                    <input class="form-control money" id="rangestart" name="rangestart[]" required value="<?php echo $value->rangeStart;?>">
                                                </div>
                                                <div class="col-xs-3">
                                                    <label for="rangeend">Range End</label>
                                                    <input class="form-control money" id="rangeend" name="rangeend[]" required value="<?php echo $value->rangeEnd;?>">
                                                </div>
                                                <div class="col-xs-4">
                                                    <label for="multilevelprice">Harga</label>
                                                    <input class="form-control money" id="multilevelprice" name="multilevelprice[]" required value="<?php echo $value->multilevelPrice;?>">
                                                </div>
                                                <div class="col-xs-1"><label></label>
                                                    <a href="JavaScript:void(0);" onclick="removeRangePrice('#srow<?php echo $j++;?>')" class="btn-sm btn-danger"><i class="fa fa-minus"></i></a>
                                                </div>
                                            </div>
                                        <?php }?>
                                    </div>
                                    <div id="multilevelpricerow"></div>
                                <?php }?>
                                <div class="form-group">
                                    <label for="filedesignstatus" class="checkbox-inline">
                                    <input type="checkbox" value="yes" name="filedesignstatus" id="filedesignstatus" <?php if($data->fileDesignStatus == "yes"){echo "checked";};?>>Enable File Upload Design
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>Deskripsi Ukuran</label>
                                    <input class="form-control" name="productsize" id="productsize" type="text" value="<?php echo $data->size; ?>" required="">
                                </div>
                                <div class="form-group input-group">
                                    <input class="form-control" name="productweight" id="productweight" type="text" value="<?php echo $data->productWeight; ?>" required="">
                                    <span class="input-group-addon">satuan (gram)</span>
                                </div>
                                <div class="form-group">
                                    <label>Material Produk</label>
                                    <textarea class="form-control" rows="2" name="productmaterial" id="productmaterial" required=""><?php echo $data->material; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Deskripsi Produk</label>
                                    <textarea class="textarea form-control" rows="7" name="productdescription" id="productdescription" required=""><?php echo $data->productDescription; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Jumlah Stok Produck</label>
                                    <input class="form-control" name="productqty" id="productqty" type="number" value="<?php echo $data->quantityStock; ?>" required="">
                                </div>
                                <div class="col-md-6">
                                    <button type="reset" class="btn btn-default btn-block">Reset</button>
                                </div>
                                <div class="col-md-6">
                                    <input type="button" onclick="doUploadDescEdit();" class="btn btn-success btn-block" value="Update">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6" id="formfoto">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <form role="form" method="POST" enctype="multipart/form-data" id="productphotoedit" action="">
                                <div class="form-group">
                                    <label>Upload Foto</label>
                                    <div class="upload-file">
                                        <h4><span class="btn-primary pull-right" id="count"></span></h4>
                                        <input class="form-control" name="idproduct" id="idproduct" type="hidden" value="<?php echo $data->idproduct; ?>">
                                        <input class="form-control" name="idupload" id="idupload" type="hidden" value="<?php echo $data->idupload; ?>">
                                        <input type="file" name="filefoto" id="filefoto" required="" accept="image/*" multiple onchange="doUploadPhotoEdit();">
                                    </div>
                                    <p class="help-block">Foto nomor urut 1 menjadi Cover</p>
                                </div>
                            </form>
                            <div id="progresbar">
                                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div id="finish"></div>
                            <div id="ajaxpage"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#category').change(function () {
        $('#subcategory').after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw loading"></i>');
        $('#subcategory').load('<?php echo base_url('d/Category/subcategory_by') ?>/' + $(this).val(), function (responseTxt, statusTxt, xhr)
        {
            if (statusTxt === "success")
                $('.loading').remove();
        });
        return false;
    });
    $('#subcategory').change(function () {
        $('#subsubcategory').after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw loading"></i>');
        $('#subsubcategory').load('<?php echo base_url('d/Category/subsubcategory_by') ?>/' + $(this).val(), function (responseTxt, statusTxt, xhr)
        {
            if (statusTxt === "success")
                $('.loading').remove();
        });
        return false;
    });
</script>
<script type="text/javascript">
    function del(id) {
        swal({
            title: "Hapus Foto ini ?",
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
                    type: 'POST',
                    url: '<?php echo base_url('d/Product/imgDel'); ?>/' + id,
                    success: function (error) {
                        $('#filefoto').val('');
                        $('.progress-bar').width('0%');
                        $('#uploadPrev').remove();
                        if (error != '') {
                            $('#alert').html(error);
                        }
                        loadPhotoEdit();
                    }
                });
                swal("Terhapus!", "Foto Anda Terhapus", "success");
            } else {
                swal("", "Foto Anda Masih Tersimpan", "error");
            }
        });
    }
    function loadPhotoEdit() {
        $('#progresbar').hide();
        var id = '<?php echo $data->idupload; ?>';
        $.ajax({
            url: '<?php echo base_url('d/Product/load_photo') ?>/' + id,
            type: 'GET',
            success: function (data) {
                $('#ajaxpage').html(data);
            }
        });
    }
    function doUploadPhotoEdit() {
        var form = $('#productphotoedit').get(0);
        var productname = $('#productname').val();
        var qty = $('#productqty').val();
        if (productname === "" || qty === "") {
            swal("Unggah gagal", "Foto Gagal di unggah, isikan deskripsi Produk Terlebih dahulu", "warning");
            document.getElementById("productname").focus();
            document.getElementById("productphoto").reset();
            $('#loader').hide();
            return false;
        } else {
            $('#proses').show();
            $('#progresbar').show('slow');
            $('#alert').html('');

            $.ajax({
                url: '<?php echo base_url('d/Product/do_upload_photo') ?>',
                method: "POST",
                data: new FormData(form),
                contentType: false,
                processData: false,
                success: function (html) {
                    $('#filefoto').val('');
                    $('.progress-bar').width('0%');
                    $('#alert').html(html);
                    loadPhotoEdit();
                    $('#proses').hide();
                },
                complete: function () {
                    $('#alert').html();
                },
                xhr: function () {
                    var xhr = $.ajaxSettings.xhr();
                    xhr.upload.onprogress = function (e) {
                        var onprogress = Math.floor(e.loaded / e.total * 100) + '%';
                        $('.progress-bar').width(onprogress);
                    };
                    return xhr;
                }

            });
        }
    }
    function doUploadDescEdit() {
        var form = $('#productdescedit').get(0);
        $('#loader').show();
        $.ajax({
            url: '<?php echo base_url('d/Product/do_upload_product') ?>',
            method: "POST",
            data: new FormData(form),
            contentType: false,
            processData: false,
            success: function (data) {
                $('#alert').html(data);
                $('#proses').hide();
            }
        });
    }
    function addRangePrice() {
       var idf = document.getElementById("idf").value;
       var stre;
       stre="<div class='form-group row' id='srow" + idf + "'><div class='col-xs-3'><label for='rangestart'>Range Start</label><input class='form-control money' id='rangestart' name='rangestart[]' required></div><div class='col-xs-3'><label for='rangeend'>Range End</label><input class='form-control money' id='rangeend' name='rangeend[]' required></div><div class='col-xs-4'><label for='multilevelprice'>Harga</label><input class='form-control money' id='multilevelprice' name='multilevelprice[]' required></div><div class='col-xs-1'><label></label><a href='JavaScript:void(0);' onclick='removeRangePrice(\"#srow" + idf + "\");' class='btn-sm btn-danger'><i class='fa fa-minus'></i></a></div></div>";
       $("#multilevelpricerow").append(stre);
       idf = (idf-1) + 2;
       document.getElementById("idf").value = idf;
       $('.money').mask('0.000.000.000', {reverse: true});
   }

   function removeRangePrice(idf) {
       $(idf).remove();
   }

   function multilevelStatus(){
    var status = document.getElementById("multilevelstatus").checked;
    var arr = document.getElementById("idf").value;
    if(status == true){
        $('#multilevelpricerow1').show('slow');
        addRangePrice();
    }else{
        $('#multilevelpricerow1').hide('slow');
        var i;
        for (i = 1; i < arr; i++) {
            $('#srow'+ i +'').remove();
        }
    }
}
</script>