 <div class="row">
     <div class="col-lg-12">
         <h3 class="page-header">Upload Produk</h3>
         <div class="alert alert border-grey" alert-dismissable>
             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
             <strong>Penting!!!</strong><br>
             Data kategori harus Anda input terlebih dahulu di menu > Katalog > Kategori > Tambah Kategori <br>
             Anda tidak dapat mengubah foto cover (nomor urut 1) atau Anda dapat menghapus produk lalu mengunggah ulang.
         </div>
         <div class="panel panel-green">
             <div class="panel-heading">
                 Upload Produk <?php
                                echo $idproduct;
                                echo $session;
                                ?>
             </div>
             <div class="panel-body">
                 <div class="row">
                     <div class="col-lg-6">
                         <div class="panel panel-default">
                             <div class="panel-body">
                                 <form role="form" method="POST" accept-charset="UTF-8" enctype="multipart/form-data" id="productdesc">
                                     <input name="idproduct" id="idproduct" type="hidden" value="<?php echo $idproduct; ?>">
                                     <input name="idupload" id="idupload" type="hidden" value="<?php echo $idproduct; ?><?php echo $session; ?>">
                                     <input id="idf" type="hidden" value="1">
                                     <div class="form-group">
                                         <label>Kategori</label>
                                         <select class="form-control" name="category" id="category" required="">
                                             <option disabled="" selected="">Pilih Kategori</option>
                                             <?php echo $category; ?>
                                         </select>
                                     </div>
                                     <div class="form-group">
                                         <label>Nama Produk</label>
                                         <input class="form-control" name="productname" id="productname" type="text" required="">
                                     </div>
                                     <div class="form-group input-group" id="productpriceform">
                                         <span class="input-group-addon">Rp.</span>
                                         <input class="form-control money" name="productprice" id="productprice" type="text" placeholder="Harga Produk Satuan" required="">
                                     </div>
                                     <div class="form-group">
                                         <label for="multilevelstatus" class="checkbox-inline">
                                             <input type="checkbox" value="yes" name="multilevelstatus" id="multilevelstatus" onclick="multilevelStatus();">Tambah Harga Bertingkat
                                         </label>
                                     </div>
                                     <div id="multilevelpricerow1">
                                         <div class="form-group row">
                                             <div class="col-xs-4">
                                                 <label>unit</label>
                                                 <input type="text" class="form-control" name="unit" id="unit" required="" placeholder="Pcs, Cm, M">
                                             </div>
                                             <div class="col-xs-3">
                                                 <label>add Form</label>
                                                 <a href="JavaScript:void(0);" onclick="addRangePrice();" class="btn-sm btn-success"><i class="fa fa-plus"></i></a>
                                             </div>
                                         </div>
                                         <div id="multilevelpricerow"></div>


                                         <div class="form-group row" id="srow<?php ?>">
                                             <div class="col-xs-3">
                                                 <label for="rangestart">Range Start</label>
                                                 <input class="form-control money" id="rangestart" name="rangestart[]" required value="<?php ?>">
                                             </div>
                                             <div class="col-xs-3">
                                                 <label for="rangeend">Range End ulimited</label>
                                                 <input type="hidden" class="form-control" id="rangeend" name="rangeend[]" value="0" hidden="">
                                             </div>
                                             <div class="col-xs-4">
                                                 <label for="multilevelprice">Harga</label>
                                                 <input class="form-control money" id="multilevelprice" name="multilevelprice[]" required value="<?php ?>">
                                             </div>
                                         </div>
                                     </div>
                                     <div class="form-group">
                                         <label for="filedesignstatus" class="checkbox-inline">
                                             <input type="checkbox" value="yes" name="filedesignstatus" id="filedesignstatus">Enable File Upload Design
                                         </label>
                                     </div>
                                     <div class="form-group">
                                         <label>Deskripsi Ukuran</label>
                                         <input class="form-control" name="productsize" id="productsize" type="text" required="">
                                     </div>
                                     <div class="form-group input-group">
                                         <input class="form-control" name="productweight" id="productweight" type="text" placeholder="Berat Produk" required="">
                                         <span class="input-group-addon">satuan (gram)</span>
                                     </div>
                                     <div class="form-group">
                                         <label>Material Produk</label>
                                         <textarea class="form-control" rows="3" name="productmaterial" id="productmaterial" required=""></textarea>
                                     </div>
                                     <div class="form-group">
                                         <label for="productdescription">Deskripsi Produk</label>
                                         <textarea id="wysiwyg" class="textarea required form-control" rows="7" name="productdescription" id="productdescription" required></textarea>
                                     </div>
                                     <div class="form-group">
                                         <label>Jumlah Stok Produck</label>
                                         <input class="form-control" name="productqty" id="productqty" type="number" required="">
                                     </div>
                                     <div class="col-md-6">
                                         <button type="reset" class="btn btn-default btn-block">Reset</button>
                                     </div>
                                     <div class="col-md-6">
                                         <input type="button" onclick="doUploadDesc();" class="btn btn-success btn-block" value="Simpan">
                                     </div>
                                 </form>
                             </div>
                         </div>
                     </div>

                     <div class="col-lg-6" id="formfoto">
                         <div class="panel panel-default">
                             <div class="panel-body">
                                 <form role="form" method="POST" enctype="multipart/form-data" id="productphoto" action="">
                                     <div class="form-group">
                                         <label>Upload Foto</label>
                                         <div class="upload-file">
                                             <h4><span class="btn-primary pull-right" id="count"></span></h4>
                                             <input class="form-control" name="idproduct" id="idproduct" type="hidden" value="<?php echo $idproduct; ?>">
                                             <input class="form-control" name="idupload" id="idupload" type="hidden" value="<?php echo $idproduct; ?><?php echo $session; ?>">
                                             <input type="file" name="filefoto" id="filefoto" required="" accept="image/*" multiple onchange="doUploadfoto();">
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
 </div>
 <script type="text/javascript">
     function doUploadDesc() {
         var valid = $("#productdesc").valid();
         if (valid == true) {
             var form = $('#productdesc').get(0);
             $('#loader').show();
             $.ajax({
                 url: '<?php echo base_url('d/Product/do_upload_product') ?>',
                 method: "POST",
                 data: new FormData(form),
                 contentType: false,
                 processData: false,
                 success: function(data) {
                     $('#alert').html(data);
                     $('#proses').hide();
                 }
             });
         }
     }

     function doUploadfoto() {
         var form = $('#productphoto').get(0);
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
                 success: function(html) {
                     $('#filefoto').val('');
                     $('.progress-bar').width('0%');
                     $('#uploadPrev').remove();
                     $('#alert').html(html);
                     document.getElementById("productphoto").reset();
                     $('#proses').hide();
                     loadPhoto();
                 },
                 complete: function() {
                     $('#alert').html();
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
             function(isConfirm) {
                 if (isConfirm) {
                     $.ajax({
                         type: 'POST',
                         url: '<?php echo base_url('d/Product/imgDel'); ?>/' + id,
                         success: function(error) {
                             $('#filefoto').val('');
                             $('.progress-bar').width('0%');
                             $('#uploadPrev').remove();
                             if (error != '') {
                                 $('#alert').html(error);
                             }
                             loadPhoto();
                         }
                     });
                     swal("Terhapus!", "Foto Anda Terhapus", "success");
                 } else {
                     swal("", "Foto Anda Masih Tersimpan", "error");
                 }
             });
     }

     function loadPhoto() {
         $('#progresbar').hide();
         var id = '<?php echo $idproduct; ?><?php echo $session; ?>';
         $.ajax({
             url: '<?php echo base_url('d/Product/load_photo') ?>/' + id,
             type: 'GET',
             success: function(data) {
                 $('#ajaxpage').html(data);
             }
         });
     }

     function addRangePrice() {
         var idf = document.getElementById("idf").value;
         var stre;
         stre = "<div class='form-group row' id='srow" + idf + "'><div class='col-xs-3'><label for='rangestart'>Range Start</label><input class='form-control money' id='rangestart' name='rangestart[]' required></div><div class='col-xs-3'><label for='rangeend'>Range End</label><input class='form-control money' id='rangeend' name='rangeend[]' required></div><div class='col-xs-4'><label for='multilevelprice'>Harga</label><input class='form-control money' id='multilevelprice' name='multilevelprice[]' required></div><div class='col-xs-1'><label></label><a href='JavaScript:void(0);' onclick='removeRangePrice(\"#srow" + idf + "\");' class='btn-sm btn-danger'><i class='fa fa-minus'></i></a></div></div>";
         $("#multilevelpricerow").append(stre);
         idf = (idf - 1) + 2;
         document.getElementById("idf").value = idf;
         $('.money').mask('0.000.000.000', {
             reverse: true
         });
     }

     function removeRangePrice(idf) {
         $(idf).remove();
     }

     function multilevelStatus() {
         var status = document.getElementById("multilevelstatus").checked;
         var arr = document.getElementById("idf").value;
         if (status == true) {
             $('#multilevelpricerow1').show('slow');
             $('#productpriceform').hide('slow');
             addRangePrice();
         } else {
             $('#multilevelpricerow1').hide('slow');
             $('#productpriceform').show('slow');
             var i;
             for (i = 1; i < arr; i++) {
                 $('#srow' + i + '').remove();
             }
         }
     }
 </script>