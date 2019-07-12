<script type="text/javascript">
    //doc
    function documentation() {
        $('#loader').show();
        $.ajax({
            url: '<?php echo base_url('d/Home/documentation'); ?>',
            method: "POST",
            success: function (resp) {
                $('#data').html(resp);
                $('#loader').hide();
            }
        });
    }
    //cs
    function dataCs() {
        $('#loader').show();
        $.ajax({
            url: '<?php echo base_url('d/Cs/data_cs'); ?>',
            method: "POST",
            success: function (resp) {
                $('#data').html(resp);
                $('#loader').hide();
                $('#dataTables-datacs').DataTable();
            }
        });
    }
    function fStoreCs() {
        $('#loader').show();
        $.ajax({
            url: '<?php echo base_url('d/Cs/f_store_cs'); ?>',
            method: "POST",
            success: function (resp) {
                $('#data').html(resp);
                $('#loader').hide();
            }
        });
    }
    //end cs
    //widget
    function dataWidget(name) {
        $('#loader').show();
        $.ajax({
            url: '<?php echo base_url('d/Widget/data_widget_by_name'); ?>',
            method: "POST",
            data: {name: name},
            success: function (resp) {
                $('#data').html(resp);
                $('#loader').hide();
                $('#dataTables-datachatbutton').DataTable();
            }
        });
    }
    //end widget
    /// footertagline
    function dataFooterTagline() {
        $('#loader').show();
        $.ajax({
            url: '<?php echo base_url('d/Design/data_footer_tagline'); ?>',
            method: "POST",
            success: function (resp) {
                $('#data').html(resp);
                $('#loader').hide();
            }
        });
    }
    function uploadFooterTagline() {
        $('#loader').show();
        $.ajax({
            url: '<?php echo base_url('d/Design/f_store_footer_tagline'); ?>',
            method: "POST",
            success: function (resp) {
                $('#data').html(resp);
                $('#loader').hide();
            }
        });
    }
    /// endtagline
    function updateUserLogin(id) {
        $('#loader').show();
        $.ajax({
            url: '<?php echo base_url('d/User/user_by_id'); ?>',
            method: "POST",
            data: {id: id},
            success: function (resp) {
                $('#data').html(resp);
                $('#loader').hide();
            }
        });
    }
    function reportHome() {
        $('#loader').show();
        $.ajax({
            url: '<?php echo base_url('d/Home/report_home'); ?>',
            method: "POST",
            success: function (resp) {
                $('#data').html(resp);
                $('#loader').hide();
            }
        });
    }
    ///profil company 
    function settingCompanyProfile() {
        $('#loader').show();
        $.ajax({
            url: '<?php echo base_url('d/System/setting_company_profile'); ?>',
            method: "POST",
            success: function (resp) {
                $('#data').html(resp);
                $('#loader').hide();
                $('#dataTables-dataprofile').DataTable();
                $('[data-toggle="tooltip"]').tooltip();
            }
        });
    } ///end profil company


    /// f categori
    function fCategory() {
        $('#loader').show();
        $.ajax({
            url: '<?php echo base_url('d/Category/f_category') ?>',
            method: "POST",
            success: function (resp) {
                $('#data').html(resp);
                $(".textarea").wysihtml5();
                $('[data-toggle="tooltip"]').tooltip();
                $('#loader').hide();

            }
        });
    }
    function dataCategory() {
        $('#loader').show();
        $.ajax({
            url: '<?php echo base_url('d/Category/data_category') ?>',
            method: "POST",
            success: function (resp) {
                $('#data').html(resp);
                $('#loader').hide();
                $('[data-toggle="tooltip"]').tooltip();
            }
        });
    }/// end categori

    /// product
    function dataProduct() {
        $('#loader').show();
        $.ajax({
            url: '<?php echo base_url('d/Product/data_product'); ?>',
            method: "POST",
            success: function (resp) {
                $('#data').html(resp);
                $('#loader').hide();
                $('#dataTables-dataproduct').DataTable();
                $('[data-toggle="tooltip"]').tooltip();
                $('.money').mask('0.000.000.000', {reverse: true});
            }
        });
    }

    function fUploadProduct() {
        $('#loader').show();
        $.ajax({
            url: '<?php echo base_url('d/Product/f_upload'); ?>',
            method: "POST",
            success: function (resp) {
                $('#data').html(resp);
                $('#loader').hide();
                $('.money').mask('0.000.000.000', {reverse: true});
                $('#progresbar').hide();
                $(".textarea").wysihtml5();
                $('[data-toggle="tooltip"]').tooltip();
                $('#multilevelpricerow1').hide();
            }
        });
    }

    /// endproduct

    /// sales
    function dataWishlist() {
        $('#loader').show();
        $.ajax({
            url: '<?php echo base_url('d/Sales/data_count_wishlist'); ?>',
            method: "POST",
            success: function (resp) {
                $('#data').html(resp);
                $('#loader').hide();
                $('#dataTables-dataWishlist').DataTable();
                $('#dataTables-dataWishlist2').DataTable();
                $('[data-toggle="tooltip"]').tooltip();
            }
        });
    }

    function dataOrder(status) {
        $('#loader').show();
        $.ajax({
            url: '<?php echo base_url('d/Sales/data_order'); ?>',
            method: "post",
            data: {status: status},
            success: function (resp) {
                $('#data').html(resp);
                $('#loader').hide();
                $('#dataTables-dataOrder').DataTable();
                $('[data-toggle="tooltip"]').tooltip();
            }
        });
    }

    function dataInvoiceUnpaid() {
        $('#loader').show();
        $.ajax({
            url: '<?php echo base_url('d/Invoice/data_invoice_unpaid'); ?>',
            method: "post",
            success: function (resp) {
                $('#data').html(resp);
                $('#loader').hide();
                $('#dataTables-dataInvoiceunpaid').DataTable();
                $('[data-toggle="tooltip"]').tooltip();
            }
        });
    }
    /// end-sales

    /// user
    function dataUser() {
        $('#loader').show();
        $.ajax({
            url: '<?php echo base_url('d/User/data_user_all'); ?>',
            method: "POST",
            success: function (resp) {
                $('#data').html(resp);
                $('#loader').hide();
                $('#dataTables-dataUser').DataTable();
                $('[data-toggle="tooltip"]').tooltip();
            }
        });
    }
    /// end-user

    /// partner
    function dataPartner() {
        $('#loader').show();
        $.ajax({
            url: '<?php echo base_url('d/Partner/data_partner_all'); ?>',
            method: "POST",
            success: function (resp) {
                $('#data').html(resp);
                $('#loader').hide();
                $('#dataTables-dataPartner').DataTable();
                $('[data-toggle="tooltip"]').tooltip();
                $('.money').mask('0.000.000.000', {reverse: true});
            }
        });
    }
    function dataInvoicePartner() {
        $('#loader').show();
        $.ajax({
            url: '<?php echo base_url('d/Invoice/data_invoice_partner_all'); ?>',
            method: "POST",
            success: function (resp) {
                $('#data').html(resp);
                $('#loader').hide();
                $('#dataTables-dataInvoicePartner').DataTable();
                $('[data-toggle="tooltip"]').tooltip();
                $('.money').mask('0.000.000.000', {reverse: true});
            }
        });
    }
    /// ENDpartner
    ///marketing
    function dataProductSale() {
        $('#loader').show();
        $.ajax({
            url: '<?php echo base_url('d/Marketing/data_product_sale'); ?>',
            method: "POST",
            success: function (resp) {
                $('#data').html(resp);
                $('#loader').hide();
                $('#dataTables-dataproductsale').DataTable();
                $('[data-toggle="tooltip"]').tooltip();
            }
        });
    }
    function dataVoucher() {
        $('#loader').show();
        $.ajax({
            url: '<?php echo base_url('d/Marketing/data_voucher'); ?>',
            method: "POST",
            success: function (resp) {
                $('#data').html(resp);
                $('#loader').hide();
                $('.money').mask('0.000.000.000', {reverse: true});
                $('#dataTables-datavoucher').DataTable();
                $('[data-toggle="tooltip"]').tooltip();
            }
        });
    }
    function dataProductBestSeller() {
        $('#loader').show();
        $.ajax({
            url: '<?php echo base_url('d/Marketing/data_product_bestseller'); ?>',
            method: "POST",
            success: function (resp) {
                $('#data').html(resp);
                $('#loader').hide();
                $('.money').mask('0.000.000.000', {reverse: true});
                $('#dataTables-dataproductbestseller').DataTable();
                $('[data-toggle="tooltip"]').tooltip();
            }
        });
    }
    ///marketing
    //design
    function fBannerHome() {
        $('#loader').show();
        $.ajax({
            url: '<?php echo base_url('d/Design/f_banner_home'); ?>',
            method: "POST",
            success: function (resp) {
                $('#data').html(resp);
                $('#loader').hide();
                $('#progresbar').hide();
                $('[data-toggle="tooltip"]').tooltip();
                position();
                $(".sort").hide();
            }
        });
    }
    function dataBanner() {
        $('#loader').show();
        $.ajax({
            url: '<?php echo base_url('d/Design/data_banner_all'); ?>',
            method: "POST",
            success: function (resp) {
                $('#data').html(resp);
                $('#loader').hide();
                $('#dataTables-dataBanner').DataTable();
                $('[data-toggle="tooltip"]').tooltip();
            }
        });
    }
    function dataPopup() {
        $('#loader').show();
        $.ajax({
            url: '<?php echo base_url('d/Design/data_popup'); ?>',
            method: "POST",
            success: function (resp) {
                $('#data').html(resp);
                $('#loader').hide();
                $('#dataTables-dataPopup').DataTable();
                $('[data-toggle="tooltip"]').tooltip();
            }
        });
    }
    function uploadPopup() {
        $('#loader').show();
        $.ajax({
            url: '<?php echo base_url('d/Design/f_upload_popup'); ?>',
            method: "POST",
            success: function (resp) {
                $('#data').html(resp);
                $(".textarea").wysihtml5();
                $('#loader').hide();
                $('[data-toggle="tooltip"]').tooltip();
            }
        });
    }
    //design
    //ads
    function dataAdsFbPixel() {
        $('#loader').show();
        $.ajax({
            url: '<?php echo base_url('d/Ads/data_ads_fb_pixel'); ?>',
            method: "POST",
            success: function (resp) {
                $('#data').html(resp);
                $('#loader').hide();
                $('#dataTables-dataadsfbpixel').DataTable();
                $('[data-toggle="tooltip"]').tooltip();
            }
        });
    }
    //endads
    //customer
    function dataCustomer() {
        $('#loader').show();
        $.ajax({
            url: '<?php echo base_url('d/Customer/data_customer'); ?>',
            method: "POST",
            success: function (resp) {
                $('#data').html(resp);
                $('#loader').hide();
                $('#dataTables-dataCustomer').DataTable();
                $('[data-toggle="tooltip"]').tooltip();
            }
        });
    }
    //endcustomer
    //maintenance
    function listExportdata() {
        $('#loader').show();
        $.ajax({
            url: '<?php echo base_url('d/Maintenance/list_exportdata'); ?>',
            method: "POST",
            success: function (resp) {
                $('#data').html(resp);
                $('#loader').hide();
                $('[data-toggle="tooltip"]').tooltip();
            }
        });
    }
    //maintenance
    // kontak & pesan//
    function dataContact() {
        $('#loader').show();
        $.ajax({
            url: '<?php echo base_url('d/Contact/data_contact'); ?>',
            method: "POST",
            success: function (resp) {
                $('#data').html(resp);
                $('#dataTables-dataContact').DataTable();
                $('#loader').hide();
                $('[data-toggle="tooltip"]').tooltip();
            }
        });
    }
    function dataSubscribe() {
        $('#loader').show();
        $.ajax({
            url: '<?php echo base_url('d/Contact/data_email_sub'); ?>',
            method: "POST",
            success: function (resp) {
                $('#data').html(resp);
                $('#dataTables-dataEmailsub').DataTable();
                $('#loader').hide();
                $('[data-toggle="tooltip"]').tooltip();
            }
        });
    }
    // kontak & pesan//
    // CRM //
    function fComposeEmail() {
        $('#loader').show();
        $.ajax({
            url: '<?php echo base_url('d/Crm/f_compose_email'); ?>',
            method: "POST",
            success: function (resp) {
                $('#data').html(resp);             
                $(".textarea").wysihtml5();
                $('[data-toggle="tooltip"]').tooltip();
                hideCC();
                $('#loader').hide();
                autocomplete();
            }
        });
    }
    // ens CRM //
    
</script>
