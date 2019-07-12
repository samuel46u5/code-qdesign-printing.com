<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">Data Order
            <span class="action pull-right">
                <button class="btn btn-sm btn-success " onclick="dataOrder('closing paid');"><i class="fa fa-shopping-cart"></i></button>
            </span>
        </h3>
        <div class="row" id="tableorder">
            <div class="col-lg-12">
                <div class="row">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            Data Order
                        </div>
                        <div class="panel-body">
                            <table class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" id="dataTables-dataOrder">
                                <thead>
                                    <tr>
                                        <th>NO</th> 
                                        <th>ID</th> 
                                        <th>ID User</th>
                                        <th>IP</th>
                                        <th>Tanggal Order</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($dataorder as $value) {
                                        ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $value->idorder; ?></td>
                                            <td><?php echo $value->iduser; ?></td>
                                            <td><?php echo $value->ipaddress; ?></td>
                                            <td><?php echo $value->orderDate; ?></td>
                                            <td><?php echo $value->status; ?></td>
                                            <td>
                                                <?php if ($value->status == "closing paid") { ?>
                                                    <button class="btn btn-sm btn-success" onclick="detailOrder('<?php echo $value->idorder; ?>');" data-toggle="tooltip" title="Proses Order"><i class="fa fa-cart-plus"></i> </button>
                                                <?php } ?>
                                                <?php if ($value->status == "process shiping") { ?>
                                                    <a href="<?php echo base_url('d/Exportdata/export_shiping_label_pdf?idorder='.$value->idorder.'');?>" target="_blank" data-toggle="tooltip" title="Cetak Label Box Pengiriman"><button class="btn btn-sm btn-danger"><i class="fa fa-file-pdf-o"></i></button></a>
                                                <?php } ?>
                                                <button class="btn btn-sm btn-danger" onclick="sendEmail('<?php echo $value->idorder; ?>');" data-toggle="tooltip" title="Kirim Email"><i class="fa fa-envelope"></i></button>
                                                <button class="btn btn-sm btn-success" onclick="detailOrder('<?php echo $value->idorder; ?>');" data-toggle="tooltip" title="detail order"><i class="fa fa-eye"></i></button>
                                                <button class="btn btn-sm btn-success" onclick="chatViaWA('<?php echo "62".substr($value->custHp,1); ?>','<?php echo $value->firstName;?>');" data-toggle="tooltip" title="Hubungi Via WA"><i class="fa fa-whatsapp"></i></button>
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
        <div id="detailorder"></div>
    </div>
</div>

<script type="text/javascript">
    function detailOrder(id) {
        var id = id;
        $('#loader').show();
        $.ajax({
            url: '<?php echo base_url('d/Sales/detail_order') ?>',
            method: "post",
            data: {id: id},
            success: function (resp) {
                $('#detailorder').html(resp);
                $('#tableorder').hide();
                $('#loader').hide();
                $('[data-toggle="tooltip"]').tooltip();
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