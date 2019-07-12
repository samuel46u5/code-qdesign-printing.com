<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">Data Pesan
        </h3>
        <div class="row">
            <div class="panel panel-green">
                <div class="panel-heading">
                    Data Pesan Masuk 
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" id="dataTables-dataContact">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>HP</th>
                                    <th>Pesan</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data as $value) { ?>
                                    <tr>
                                        <td><?php echo $value->name; ?></td>
                                        <td><?php echo $value->email; ?></td>
                                        <td><?php echo $value->phone; ?></td>
                                        <td><?php echo $value->message; ?></td>
                                        <td><?php echo $value->date_create; ?></td>
                                        <td>
                                             <button class="btn btn-sm btn-danger" onclick="sendEmail('<?php echo $value->idcontact; ?>');" data-toggle="tooltip" title="Kirim Email"><i class="fa fa-envelope"></i></button>
                                             <button class="btn btn-sm btn-success" onclick="chatViaWA('<?php echo "62".substr($value->phone,1); ?>','<?php echo $value->name;?>');" data-toggle="tooltip" title="Hubungi Via WA"><i class="fa fa-whatsapp"></i></button>
                                             <button class="btn btn-sm btn-danger" onclick="deletePesan('<?php echo $value->idcontact;?>;')" data-toggle="tooltip" title="Hapus"><i class="fa fa-trash"></i></button>
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
    function chatViaWA(phone, username){
    window.open('https://web.whatsapp.com/send?phone='+phone+'&text=Halo Kak '+username+'', '_blank');
    }
    function sendEmail(id){
        $('#loader').show();
        $.ajax({
            url: '<?php echo base_url('d/Crm/compose_email_by_idcontact') ?>',
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
    
    function deletePesan(id){
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
                            url: '<?php echo base_url('d/Contact/delete_contact_by_id'); ?>',
                            method: "POST",
                            data: {id:id},
                            success: function (data) {
                                $('#alert').html(data);
                                dataContact();
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
