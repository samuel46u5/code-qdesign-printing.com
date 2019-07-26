<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo $profile->companyName; ?>">
    <meta name="author" content="<?php echo $profile->companyName; ?>">
    <title><?php echo $profile->companyName; ?></title>
    <link href="<?php echo base_url('asset/') ?>vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url('asset/') ?>vendors/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="<?php echo base_url('asset/') ?>dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="<?php echo base_url('asset/') ?>vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('asset/') ?>vendors/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url('asset/') ?>vendors/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
    <link href="<?php echo base_url('asset/') ?>vendors/datatables-responsive/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url('asset/') ?>vendors/sweetalert/sweetalert.css" rel="stylesheet">
    <link href="<?php echo base_url('asset/') ?>css/animate.min.css" rel="stylesheet">
    <link href="<?php echo base_url('asset/') ?>css/jquery-ui.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('asset/') ?>vendors/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <script src="<?php echo base_url('asset/') ?>vendors/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url('asset/') ?>js/timer.js"></script>
    <script src="<?php echo base_url('asset/') ?>js/jquery.validate.min.js"></script>
</head>

<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="JavaScript:void(0);"><?php echo $profile->companyName; ?></a>
            </div>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <div class="loader" id="loader"><i class="fa fa-refresh fa-spin"></i></div>
                </li>
                <li class="dropdown"><span id="date_time"></span></li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-fw"></i> <span id="countallnotify"></span> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="JavaScript:void(0);" onclick="dataNotifyByName('Closing Unpaid');">
                                <div>
                                    <i class="fa fa-shopping-cart fa-fw"></i> Order Masuk Belum Bayar
                                    <span class="pull-right text-muted small" id="countclosingunpaid">0</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="JavaScript:void(0);" onclick="dataNotifyByName('Closing Paid');">
                                <div>
                                    <i class="fa fa-shopping-cart fa-fw"></i> Order Masuk Sudah Bayar
                                    <span class="pull-right text-muted small" id="countclosingpaid">0</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="JavaScript:void(0);" onclick="allNotitfy();">
                                <strong>See All Alerts</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li><a href="JavaScript:void(0);"><i class="fa fa-user fa-fw"></i><?php echo $this->session->userdata('username'); ?></a>
                        </li>
                        <li><a href="JavaScript:void(0);" onclick="updateUserLogin('<?php echo $this->session->userdata('iduser') ?>');"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?php echo base_url('d/Login/logout') ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="JavaScript:void(0);" onclick="reportHome();"><i class="fa fa-dashboard fa-fw"></i> Home</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-user fa-fw"></i> Galery<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="JavaScript:void(0);" onclick="fUploadgalery_Foto();"><i class="fa fa-angle-double-right fa-fw"></i>Tambah Galery Foto</a>
                                    <a href="JavaScript:void(0);" onclick="dataGaleryFoto();"><i class="fa fa-angle-double-right fa-fw"></i> Kelola Galery Foto</a>
                                    <a href="JavaScript:void(0);" onclick="dataGaleryVideo();"><i class="fa fa-angle-double-right fa-fw"></i> Kelola Galery Video</a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-tags fa-fw"></i> Katalog<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#"><i class="fa fa-angle-double-right fa-fw"></i> Kategori <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="JavaScript:void(0);" onclick="fCategory();"><i class="fa fa-angle-double-right fa-fw"></i> Tambah kategori</a>
                                        </li>
                                        <li>
                                            <a href="JavaScript:void(0);" onclick="dataCategory();"><i class="fa fa-angle-double-right fa-fw"></i> Data Kategory</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-angle-double-right fa-fw"></i> Produk <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="JavaScript:void(0);" onclick="fUploadProduct();"><i class="fa fa-angle-double-right fa-fw"></i> Upload Produk</a>
                                        </li>
                                        <li>
                                            <a href="JavaScript:void(0);" onclick="dataProduct();"><i class="fa fa-angle-double-right fa-fw"></i> Data Produk</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-user fa-fw"></i> Customer<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="JavaScript:void(0);" onclick="dataCustomer();"><i class="fa fa-angle-double-right fa-fw"></i> Data Customer</a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-shopping-cart fa-fw"></i> Sales<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="JavaScript:void(0);" onclick="dataOrder('closing paid');"><i class="fa fa-angle-double-right fa-fw"></i> Order Masuk (CST)</a>
                                </li>
                                <li>
                                    <a href="JavaScript:void(0);" onclick="dataWishlist()"><i class="fa fa-angle-double-right fa-fw"></i> Data wishlist</a>
                                </li>
                                <li>
                                    <a href="JavaScript:void(0);" onclick="dataOrder();"><i class="fa fa-angle-double-right fa-fw"></i> Data Semua Order</a>
                                </li>
                                <li>
                                    <a href="JavaScript:void(0);" onclick="dataInvoiceUnpaid();"><i class="fa fa-angle-double-right fa-fw"></i> Data Invoice Unpaid</a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-share fa-fw"></i> Marketing<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="JavaScript:void(0);" onclick="dataProductSale();"><i class="fa fa-angle-double-right fa-fw"></i> Produk Sale</a>
                                </li>
                                <li>
                                    <a href="JavaScript:void(0);" onclick=""><i class="fa fa-angle-double-right fa-fw"></i> Give Away</a>
                                </li>
                                <li>
                                    <a href="JavaScript:void(0);" onclick="dataVoucher();"><i class="fa fa-angle-double-right fa-fw"></i> Voucher</a>
                                </li>
                                <li>
                                    <a href="JavaScript:void(0);" onclick="dataProductBestSeller();"><i class="fa fa-angle-double-right fa-fw"></i> Data Produk Best Seller</a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-industry fa-fw"></i> CRM<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="JavaScript:void(0);" onclick="fComposeEmail();"><i class="fa fa-angle-double-right fa-fw"></i> Kirim E-mail</a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-user fa-fw"></i> User<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="JavaScript:void(0);" onclick="dataUser();"><i class="fa fa-angle-double-right fa-fw"></i> Data User</a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-users fa-fw"></i> Partner <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="JavaScript:void(0);" onclick="dataPartner();"><i class="fa fa-angle-double-right fa-fw"></i> Data Rule Partner</a>
                                </li>
                                <li>
                                    <a href="JavaScript:void(0);" onclick="dataInvoicePartner();"><i class="fa fa-angle-double-right fa-fw"></i> Data Invoice Registrasi</a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-desktop fa-fw"></i> Design<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="JavaScript:void(0);" onclick="fBannerHome();"><i class="fa fa-angle-double-right fa-fw"></i> Unggah Banner</a>
                                </li>
                                <li>
                                    <a href="JavaScript:void(0);" onclick="dataBanner();"><i class="fa fa-angle-double-right fa-fw"></i> Data Banner</a>
                                </li>
                                <li>
                                    <a href="JavaScript:void(0);" onclick="dataPopup();"><i class="fa fa-angle-double-right fa-fw"></i> Data Pop Up</a>
                                </li>
                                <li>
                                    <a href="JavaScript:void(0);" onclick="uploadPopup();"><i class="fa fa-angle-double-right fa-fw"></i> Upload Pop Up</a>
                                </li>
                                <li>
                                    <a href="JavaScript:void(0);" onclick="dataFooterTagline();"><i class="fa fa-angle-double-right fa-fw"></i> Data Footer Tagline</a>
                                </li>
                                <li>
                                    <a href="JavaScript:void(0);" onclick="uploadFooterTagline();"><i class="fa fa-angle-double-right fa-fw"></i> Upload Footer Tagline</a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-envelope fa-fw"></i> Kontak & Pesan<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="JavaScript:void(0);" onclick="dataContact();"><i class="fa fa-angle-double-right fa-fw"></i> Data Pesan</a>
                                </li>
                                <li>
                                    <a href="JavaScript:void(0);" onclick="dataSubscribe();"><i class="fa fa-angle-double-right fa-fw"></i> Data Email Subcribe</a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-wechat fa-fw"></i> Custommer Service<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="JavaScript:void(0);" onclick="dataCs();"><i class="fa fa-angle-double-right fa-fw"></i> Data CS</a>
                                </li>
                                <li>
                                    <a href="JavaScript:void(0);" onclick="fStoreCs();"><i class="fa fa-angle-double-right fa-fw"></i> Tambah CS</a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-terminal fa-fw"></i> Widget<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="JavaScript:void(0);" onclick="dataWidget('Chat Button');"><i class="fa fa-angle-double-right fa-fw"></i> Chat Button</a>
                                </li>
                                <li>
                                    <a href="JavaScript:void(0);" onclick="dataWidget('Share Button');"><i class="fa fa-angle-double-right fa-fw"></i> Share Button</a>
                                </li>
                                <li>
                                    <a href="JavaScript:void(0);" onclick="dataWidget('Facebook Comment');"><i class="fa fa-angle-double-right fa-fw"></i> Facebook Comment</a>
                                </li>
                                <li>
                                    <a href="JavaScript:void(0);" onclick="dataWidget('Order Via WhatsApp');"><i class="fa fa-angle-double-right fa-fw"></i> Order Via WhatsApp</a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-magic fa-fw"></i> Tracking Setting <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="JavaScript:void(0);" onclick="dataAdsFbPixel();"><i class="fa fa-angle-double-right fa-fw"></i> FB Pixel</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-cogs fa-fw"></i> System<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="JavaScript:void(0);" onclick="settingCompanyProfile();"><i class="fa fa-angle-double-right fa-fw"></i> Settings Toko</a>

                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-angle-double-right fa-fw"></i> Maintenance <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="JavaScript:void(0);" onclick="listExportdata();"><i class="fa fa-angle-double-right fa-fw"></i> Export Data</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="JavaScript:void(0);" onclick="documentation();"><i class="fa fa-book fa-fw"></i> Dokumentasi</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- ini untuk menampilkan alert -->
                <div id="alert"></div> 
                <div id="data"></div>
                <?php echo $this->session->flashdata('message'); ?>
            </div>
            <audio id="mynotif" src="<?php echo base_url('asset/sound/'); ?>slow-spring-board.ogg" preload="auto"></audio>
        </div>
    </div>
    <script src="<?php echo base_url('asset/') ?>js/jquery.mask.min.js"></script>
    <script src="<?php echo base_url('asset/') ?>vendors/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url('asset/') ?>vendors/datatables/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url('asset/') ?>vendors/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url('asset/') ?>vendors/datatables-responsive/responsive.bootstrap.min.js"></script>
    <script src="<?php echo base_url('asset/') ?>vendors/datatables-responsive/dataTables.responsive.min.js"></script>
    <script src="<?php echo base_url('asset/') ?>vendors/metisMenu/metisMenu.min.js"></script>
    <script src="<?php echo base_url('asset/') ?>vendors/bootstrap-notify/bootstrap-notify.js"></script>
    <script src="<?php echo base_url('asset/') ?>dist/js/sb-admin-2.js"></script>
    <script src="<?php echo base_url('asset/') ?>js/jquery-ui.js"></script>
    <script src="<?php echo base_url('asset/') ?>vendors/sweetalert/sweetalert.min.js"></script>
    <script src="<?php echo base_url('asset/') ?>vendors/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <script>
        window.onload = date_time('date_time');
        $(function() {
            $(".textarea").wysihtml5();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.money').mask('0.000.000.000', {
                reverse: true
            });
            $(".textarea").wysihtml5();
            $('[data-toggle="tooltip"]').tooltip();
            reportHome();
            countOrderClosingUnpaid();
            countOrderClosingPaid();
            countAllNotify();
            //                setInterval(checkOrder, 3000);
        });
    </script>
    <script type="text/javascript">
        //notify//
        function dataNotifyByName(name) {
            $('#loader').show();
            $.ajax({
                url: '<?php echo base_url('d/Notify/data_notify_by_name'); ?>',
                method: "POST",
                data: {
                    name: name
                },
                success: function(resp) {
                    $('#data').html(resp);
                    $('#dataTables-dataNotif').DataTable();
                    $('#loader').hide();
                }
            })
        }

        function countOrderClosingUnpaid() {
            $.ajax({
                url: '<?php echo base_url('d/Notify/cek_order_unpaid'); ?>',
                method: "POST",
                success: function(resp) {
                    $('#countclosingunpaid').html(resp);
                }
            });
        }

        function countOrderClosingPaid() {
            $.ajax({
                url: '<?php echo base_url('d/Notify/cek_order_paid'); ?>',
                method: "POST",
                success: function(resp) {
                    $('#countclosingpaid').html(resp);
                }
            });
        }

        function countAllNotify() {
            $.ajax({
                url: '<?php echo base_url('d/Notify/count_all_notify'); ?>',
                method: "POST",
                success: function(resp) {
                    $('#countallnotify').html(resp);
                }
            });
        }

        function allNotitfy() {
            $.ajax({
                url: '<?php echo base_url('d/Notify/data_all_notify'); ?>',
                method: "POST",
                success: function(resp) {
                    $('#data').html(resp);
                }
            });
        }

        function checkOrder() {
            $.ajax({
                url: '<?php echo base_url('d/Notify/count_all_notify'); ?>',
                method: "POST",
                success: function(resp) {
                    if (resp > 0) {
                        playSoundNotify();
                        countAllNotify();
                    } else {

                    }
                }
            });
        }

        function playSoundNotify() {
            myMusic = new sound("<?php echo base_url('asset/sound/'); ?>slow-spring-board.ogg");
            myMusic.play();
        }

        function sound(src) {
            this.sound = document.createElement("audio");
            this.sound.src = src;
            this.sound.setAttribute("preload", "auto");
            this.sound.setAttribute("controls", "none");
            this.sound.style.display = "none";
            document.body.appendChild(this.sound);
            this.play = function() {
                this.sound.play();
            };
            this.stop = function() {
                this.sound.pause();
            };
        }
        //notify//
    </script>
    <?php $this->load->view('dashboard/home_js'); ?>
</body>

</html>