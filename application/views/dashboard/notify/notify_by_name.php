<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">
        </h3>
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            Notification Panel
                        </div>
                        <div class="panel-body">
                            <table class="table table-striped table-bordered" style="width:100%" id="dataTables-dataNotif">
                                <thead>
                                    <tr>
                                        <th>ID Order</th>
                                        <th>Status</th>
                                        <th>Submit</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data as $value) { ?>
                                        <tr>
                                            <td><?php echo $value->idorder; ?></td>
                                            <td><?php echo $value->notifyName; ?></td>
                                            <td><?php echo $value->dateCreate; ?></td>
                                            <td><button class="btn btn-sm btn-success" onclick="detailOrder('<?php echo $value->idorder; ?>');">detail</button></td>
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
                $('#data').html(resp);
                $('#loader').hide();
                $('[data-toggle="tooltip"]').tooltip();
                updateNotify(id);
            }
        });
    }
    function updateNotify(id) {
        $.ajax({
            url: '<?php echo base_url('d/Notify/update_status_notify') ?>',
            method: "post",
            data: {id: id}
        });
    }
</script>