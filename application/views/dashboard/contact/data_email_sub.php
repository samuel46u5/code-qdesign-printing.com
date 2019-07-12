<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">Data Email
        </h3>
        <div class="row">
            <div class="panel panel-green">
                <div class="panel-heading">
                    Data Email Subcribe 
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" id="dataTables-dataEmailsub">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Email</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1;foreach ($data as $value) { ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $value->email; ?></td>
                                        <td><?php echo $value->date_create; ?></td>
                                        <td>
                                            <button class="btn btn-sm btn-danger" onclick="sendEmail('<?php echo $value->id; ?>');" data-toggle="tooltip" title="Kirim Email"><i class="fa fa-envelope"></i></button>
                                             <button class="btn btn-sm btn-danger" onclick="deleteItem('<?php echo $value->id;?>;')" data-toggle="tooltip" title="Hapus"><i class="fa fa-trash"></i></button>
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
<script type="text/javascript">
    function sendEmail(id){
        $('#loader').show();
        $.ajax({
            url: '<?php echo base_url('d/Crm/compose_email_by_idsubcribe') ?>',
            method: "POST",
            data: {"id": id},
            success: function (data) {
                $('#data').html(data);
                $('#loader').hide();
                $(".textarea").wysihtml5();
                hideCC();
            }
        });
    }
    
    function deleteItem(id){
        swal({
            title: "Hapus Item ini ?",
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
                            url: '<?php echo base_url('d/Contact/delete_subcribe_by_id'); ?>',
                            method: "POST",
                            data: {id:id},
                            success: function (data) {
                                $('#alert').html(data);
                                dataSubscribe();
                                $(".alert").fadeTo(3500, 0).slideUp(500, function () {
                                    $(this).remove();
                                });
                            }
                        });
                        swal("Terhapus!", "Item Terhapus", "success");
                    } else {
                        swal("", "", "error");
                    }
                });
    }
</script>
