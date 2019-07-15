<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">Data Galery Video
        </h3>
        <div class="row">
            <div class="panel panel-green">
                <div class="panel-heading">
                    Kelola Data Galery Video
                </div>


            </div>
        </div>
    </div>
</div>


<div id="datadetail"></div>
<!-- <script>
    function detailCustomer(id) {
        $('#loader').show();
        $.ajax({
            url: '<?php echo base_url('d/Sales/detail_order') ?>',
            method: "POST",
            data: {
                "id": id
            },
            success: function(data) {
                $('#datadetail').html(data);
                $('#loader').hide();

            }
        });
    }

    function chatViaWA(phone, username) {
        window.open('https://web.whatsapp.com/send?phone=' + phone + '&text=Halo Kak ' + username + '', '_blank');
    }

    function sendEmail(id) {
        $('#loader').show();
        $.ajax({
            url: '<?php echo base_url('d/Crm/compose_email_by_idorder') ?>',
            method: "POST",
            data: {
                "id": id
            },
            success: function(data) {
                $('#data').html(data);
                $('#loader').hide();
                $(".textarea").wysihtml5();
                hideCC();
            }
        });
    }
</script> -->