<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">Data Customer
        </h3>
        <div class="row">
            <div class="panel panel-green">
                <div class="panel-heading">
                    Data Customer 
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" id="dataTables-dataCustomer">
                        <thead>
                            <tr>
                                <th>ID Order</th>
                                <th>Nama</th>
                                <th>Kota</th>
                                <th>HP</th>
                                <th>E-mail</th>
                                <th>Order By</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data as $value) { ?>
                                <tr>
                                    <td><?php echo $value->idorder; ?></td>
                                    <td><?php echo $value->firstName . " " . $value->lastName; ?></td>
                                    <td><?php echo $value->namaKabupaten; ?></td>
                                    <td><?php echo $value->custHp; ?></td>
                                    <td><?php echo $value->custEmail; ?></td>
                                    <td><?php echo $value->iduser; ?></td>
                                    <td><?php echo $value->status; ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-success" onclick="detailCustomer('<?php echo $value->idorder; ?>');" data-toggle="tooltip" title="detail customer"><i class="fa fa-eye"></i></button>

                                        <?php if(!empty($value->custEmail)){?>

                                            <button class="btn btn-sm btn-danger" onclick="sendEmail('<?php echo $value->idorder; ?>');" data-toggle="tooltip" title="Kirim Email"><i class="fa fa-envelope"></i> </button>

                                        <?php } ?>
                                        <?php if(!empty($value->custHp)){?>

                                            <button class="btn btn-sm btn-success" onclick="chatViaWA('<?php echo "62".substr($value->custHp,1); ?>','<?php echo $value->firstName;?>');" data-toggle="tooltip" title="Hubungi Via WA"><i class="fa fa-whatsapp"></i> </button>
                                            <a href="tel:<?php echo $value->custHp; ?>" class="btn-sm btn-success" target="_blank" data-toggle="tooltip" title="Hubungi  Customer"><i class="fa fa-phone"></i> </a>

                                        <?php } ?>
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
<div id="datadetail"></div>
<script>
    function detailCustomer(id) {
        $('#loader').show();
        $.ajax({
            url: '<?php echo base_url('d/Sales/detail_order') ?>',
            method: "POST",
            data: {"id": id},
            success: function (data) {
                $('#datadetail').html(data);
                $('#loader').hide();

            }
        });
    }
    function chatViaWA(phone, username){
        window.open('https://web.whatsapp.com/send?phone='+phone+'&text=Halo Kak '+username+'', '_blank');
    }
    function sendEmail(id){
        $('#loader').show();
        $.ajax({
            url: '<?php echo base_url('d/Crm/compose_email_by_idorder') ?>',
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
</script>