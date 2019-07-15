 <div class="row">
     <div class="col-lg-12">
         <h3 class="page-header">Upload Galery Foto</h3>

         <div class="panel panel-green">
             <div class="panel-heading">
                 Upload Galery Foto Produk <?php
                                            echo $id_galery;
                                            echo $session;
                                            ?>
             </div>
             <div class="panel-body">
                 <div class="row">
                     <div class="col-lg-6">
                         <div class="panel panel-default">
                             <div class="panel-body">
                                 <form role="form" method="POST" accept-charset="UTF-8" enctype="multipart/form-data" id="productdesc">
                                     <div class="form-group">
                                         <label>Nama Foto</label>
                                         <input class="form-control" name="productname" id="productname" type="text" required="">
                                     </div>

                                     <div class="form-group">
                                         <label for="productdescription">Deskripsi Foto</label>
                                         <textarea id="wysiwyg" class="textarea required form-control" rows="7" name="productdescription" id="productdescription" required></textarea>
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
                                             <input type="file" name="filefoto" id="filefoto" required="" accept="image/*" multiple onchange="doUploadfoto();">
                                         </div>

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
 </script>