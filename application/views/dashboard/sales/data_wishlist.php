
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">Data Wishlist</h3>
        <div class="row">
            <div class="panel panel-green">
                <div class="panel-heading">
                   Count Wishlist
               </div>
               <div class="panel-body">
                <table class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" id="dataTables-dataWishlist">
                    <thead>
                        <tr>
                            <th>Nama Produk</th>
                            <th>Jumlah Wish</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $value) { ?>
                            <tr>
                                <td><?php echo $value->productName; ?></td>
                                <td><?php echo $value->count; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>      
</div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="panel panel-green">
                <div class="panel-heading">
                    Data Lengkap Wishlist
                </div>
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-dataWishlist2">
                        <thead>
                            <tr>
                                <th>Nama Produk</th> 
                                <th>HP</th>
                                <th>Email</th>
                                <th>IP Address</th>
                                <th>Date</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dataall as $value) { ?>
                                <tr>
                                    <td><?php echo $value->productName; ?></td>
                                    <td><?php echo $value->phone; ?></td>
                                    <td><?php echo $value->email; ?></td>
                                    <td><?php echo $value->ipAddress; ?></td>
                                    <td><?php echo $value->dateSubmit; ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                                Aksi
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu pull-right" role="menu">
                                                <?php if(!empty($value->email)){?>
                                                    <li>
                                                        <button class="btn btn-block" onclick="sendEmail('<?php echo $value->idwishlist ?>');" data-toggle="tooltip" title="Kirim Email"><i class="fa fa-envelope"></i> Kirim Email</button>
                                                    </li>
                                                <?php } ?>
                                                <?php if(!empty($value->phone)){?>
                                                    <li>
                                                        <button class="btn btn-block" onclick="chatViaWA('<?php echo "62".substr($value->phone,1); ?>','<?php echo $value->phone; ?>');" data-toggle="tooltip" title="Hubungi Via WA"><i class="fa fa-whatsapp"></i> Hubungi Via WA</button>
                                                    </li>
                                                    <li>
                                                        <a href="tel:<?php echo $value->phone; ?>" class="btn-block" target="_blank" data-toggle="tooltip" title="Hubungi  Customer"><i class="fa fa-phone"></i> Hubungi Via Telepon</a>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </div>
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
<script type="text/javascript">
    function chatViaWA(phone, username){
    window.open('https://web.whatsapp.com/send?phone='+phone+'&text=Halo '+username+'', '_blank');
    }
    
    function sendEmail(id){
         $('#loader').show();
        $.ajax({
            url: '<?php echo base_url('d/Crm/compose_email_by_wishlist') ?>',
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