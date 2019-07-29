<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo $title; ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#825a2c">
    <meta name="msapplication-navbutton-color" content="#825a2c">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" charset="#825a2c">
    <meta name="keywords" content="<?php echo $profile->tagcompanyDescription; ?>" />
    <meta name="description" content="<?php echo $profile->tagcompanyDescription; ?>" />

    <link rel="icon" type="image/png" href="<?php echo base_url('asset/img/uploads/banner/') ?><?php
                                                                                                if (!empty($icontitle->image)) {
                                                                                                    echo $icontitle->image;
                                                                                                }
                                                                                                ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/') ?>vendors/bootstrap2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/') ?>fonts/font-awesome-4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/') ?>fonts/themify/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/') ?>fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/') ?>fonts/elegant-font/html-css/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/') ?>vendors/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/') ?>vendors/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/') ?>vendors/animsition/css/animsition.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/') ?>vendors/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/') ?>vendors/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/') ?>vendors/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/') ?>vendors/lightbox2/css/lightbox.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/') ?>vendors/noui/nouislider.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/') ?>css/util.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/') ?>css/main.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/') ?>vendors/sweetalert/sweetalert.css">


    <!-- Plugins CSS -->
    <!-- <link rel="stylesheet" href="<?php echo base_url('asset/') ?>Vendor2/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="<?php echo base_url('asset/') ?>Vendor2/fonts/themify/themify-icons.css">

    <!-- <link rel="stylesheet" href="<?php echo base_url('asset/') ?>Vendor2/css/slick.css">
    <link rel="stylesheet" href="<?php echo base_url('asset/') ?>Vendor2/css/slick-theme.css">
    <link rel="stylesheet" href="<?php echo base_url('asset/') ?>Vendor2/css/all.css"> -->

    <!-- Theme CSS -->
    <link rel="stylesheet" href="<?php echo base_url('asset/') ?>Vendor2/css/style2.css">
    <!-- <link rel="stylesheet" href="<?php echo base_url('asset/') ?>Vendor2/css/responsive.css"> -->





    <?php
    if (!empty($fbpixel)) {
        if ($fbpixel->adsStatus == "Active") {
            ?>
            <script>
                ! function(f, b, e, v, n, t, s) {
                    if (f.fbq)
                        return;
                    n = f.fbq = function() {
                        n.callMethod ?
                            n.callMethod.apply(n, arguments) : n.queue.push(arguments)
                    };
                    if (!f._fbq)
                        f._fbq = n;
                    n.push = n;
                    n.loaded = !0;
                    n.version = '2.0';
                    n.queue = [];
                    t = b.createElement(e);
                    t.async = !0;
                    t.src = v;
                    s = b.getElementsByTagName(e)[0];
                    s.parentNode.insertBefore(t, s)
                }(window, document, 'script',
                    'https://connect.facebook.net/en_US/fbevents.js');
                fbq('init', '<?php echo $fbpixel->adsScript; ?>');
                fbq('track', 'PageView');
            </script>
            <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=<?php echo $fbpixel->adsScript; ?>&ev=PageView&noscript=1" /></noscript>
        <?php
    }
}
?>

    <!--Start of Tawk.to Script-->
    <?php if (!empty($tawkto)) { ?>
        <script type="text/javascript">
            var Tawk_API = Tawk_API || {},
                Tawk_LoadStart = new Date();
            (function() {
                var s1 = document.createElement("script"),
                    s0 = document.getElementsByTagName("script")[0];
                s1.async = true;
                s1.src = 'https://embed.tawk.to/<?= $tawkto->widgetScriptId; ?>/default';
                // 5d159e9836eab9721119a32d
                s1.charset = 'UTF-8';
                s1.setAttribute('crossorigin', '*');
                s0.parentNode.insertBefore(s1, s0);
            })();
        </script>
    <?php } ?>
    <!--End of Tawk.to Script-->


</head>

<body class="animsition">

    <div class="wrap_header fixed-header2 trans-0-4">
        <a href="<?php echo base_url('') ?>" class="logo">
            <img src="<?php echo site_url('asset/img/uploads/banner/' . $logo->image . ''); ?>" alt="<?php echo $profile->companyName; ?>">
        </a>
        <div class="wrap_menu">
            <nav class="menu">
                <ul class="main_menu">
                    <li class="<?php echo $activemenu['product']; ?>">
                        <a href="<?php echo base_url('pages/product/search?category=0&price=asc&group=') ?>"><i class="fa fa-navicon"></i> Kategori <i class="fa fa-caret-down"></i></a>
                        <?php echo $menucategory; ?>
                    </li>
                    <li class="">
                        <i class="fa fa-picture-o"></i> <a href="<?php echo base_url('pages/galery') ?>"> Galery</a>
                        <ul class='sub_menu'>
                            <li>
                                <i class="fa fa-camera"></i> <a href="<?php echo base_url('pages/galery') ?>">Foto </a>
                            </li>
                            <li>
                                <i class="fa fa-video-camera"></i><a href="<?php echo base_url('pages/galery') ?>">Video </a>
                            </li>
                        </ul>

                    </li>
                    <li class="">
                        <i class="fa fa-question-circle-o"></i><a href="<?php echo base_url('pages/galery') ?>"> Bantuan</a>
                    </li>
                    <li class="">
                        <i class="fa fa-info-circle"></i><a href="<?php echo base_url('pages/galery') ?>"> Info</a>
                        <ul class='sub_menu'>
                            <li>
                                <i class="fa fa-id-card-o"></i> <a href="<?php echo base_url('pages/about') ?>"> Tentang Kami </a>
                            </li>
                            <li>
                                <i class="fa fa-envelope-o"></i><a href="<?php echo base_url('pages/contact') ?>">Kontak Kami </a>
                            </li>

                        </ul>
                    </li>
                    <li class="<?php echo $activemenu['payment']; ?>">
                        <i class="fa fa-money"> </i><a href="<?php echo base_url('pages/confirm-payment') ?>"> Konfirmasi Pembayaran</a>
                    </li>
                    <li>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="header-icons">
            <div id="prefetch">
                <form class="searchglobal">
                    <input type="text" class="search-global typeahead" name="search_box" id="search_box" placeholder="Cari Produk..">
                    <button type="submit" value="cari" title="cari"><i class="fa fa-search"></i></button>
                </form>
            </div>
            <span class="linedivide1"></span>
            <?php
            if (!empty($this->session->userdata('username'))) {
                echo '<a href="' . base_url('pages/profile') . '" class="header-wrapicon1 dis-block">';
                echo "<small class='color0'><img src=" . base_url('asset/img/icons/icon-header-01.png') . " alt='ICON'> " . substr($this->session->userdata('username'), 0, 7) . "</small>";
                echo "</a>";
            } else {
                ?>
                <a href="<?php echo base_url('pages/login') ?>" class="header-wrapicon1 dis-block">
                    <img src="<?php echo site_url('asset/img/') ?>icons/icon-header-01.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
                </a>
            <?php } ?>
            <span class="linedivide1"></span>
            <div class="header-wrapicon2">
                <img src="<?php echo site_url('asset/img/') ?>icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
                <span class="header-icons-noti" id="qty-cart-a"></span>
                <div class="header-cart header-dropdown">
                    <div id="list-cart-a"></div>
                    <div class="header-cart-buttons">
                        <div class="header-cart-wrapbtn">
                            <a href="<?php echo base_url('pages/cart?idorder='); ?><?php
                                                                                    if (isset($_SESSION['idorder'])) {
                                                                                        echo $_SESSION['idorder'];
                                                                                    }
                                                                                    ?>" class="flex-c-m size1 bg-brown bo-rad-20 hov1 s-text1 trans-0-4">
                                Keranjang Belanja
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <header class="header2">
        <div class="container-menu-header-v2">
            <div class="topbar2">
                <div class="topbar-social">
                    <?php
                    if (!empty($profile->fbLink) && $profile->fbLink != "null") {
                        echo '<a href="' . $profile->fbLink . '" target="_blank"><i class="topbar-social-item fs-18 color1 fa fa-facebook"></i></a>';
                    }
                    if (!empty($profile->igLink) && $profile->igLink != "null") {
                        echo '<a href="' . $profile->igLink . '" target="_blank"><i class="topbar-social-item fs-18 color1 fa fa-instagram"></i></a>';
                    }
                    if (!empty($profile->twittLink) && $profile->twittLink != "null") {
                        echo '<a href="' . $profile->twittLink . '" target="_blank"><i class="topbar-social-item fs-18 color1 fa fa-twitter"></i></a>';
                    }
                    if (!empty($profile->ytLink) && $profile->ytLink != "null") {
                        echo '<a href="' . $profile->ytLink . '" target="_blank"><i class="topbar-social-item fs-18 color1 fa fa-youtube-play"></i></a>';
                    }
                    ?>
                </div>
                <a href="<?php echo base_url('') ?>" class="logo2">
                    <img src="<?php echo site_url('asset/img/uploads/banner/' . $logo->image . ''); ?>" alt="<?php echo $profile->companyName; ?>">
                </a>
                <div class="topbar-child2">
                    <div class="topbar-language rs1-select2">
                        <div id="google_translate_element"></div>
                    </div>
                    <?php
                    if (!empty($this->session->userdata('username'))) {
                        echo '<a href="' . base_url('pages/profile') . '" class="header-wrapicon1 dis-block">';
                        echo "<small class='colorwhite'><img src=" . base_url('asset/img/icons/icon-header-01.png') . " alt='ICON'> " . substr($this->session->userdata('username'), 0, 7) . "</small>";
                        echo "</a>";
                    } else {
                        ?>
                        <a href="<?php echo base_url('pages/login') ?>" class="header-wrapicon1 dis-block">
                            <img src="<?php echo site_url('asset/img/') ?>icons/icon-header-01.png" class="header-icon1" alt="ICON">
                        </a>
                    <?php } ?>
                    <span class="linedivide1"></span>
                    <div class="header-wrapicon2 m-r-13">
                        <img src="<?php echo site_url('asset/img/') ?>icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
                        <span class="header-icons-noti" id="qty-cart-b"></span>
                        <div class="header-cart header-dropdown">
                            <div id="list-cart-b"></div>
                            <div class="header-cart-buttons">
                                <div class="header-cart-wrapbtn">
                                    <a href="<?php echo base_url('pages/cart?idorder='); ?><?php
                                                                                            if (isset($_SESSION['idorder'])) {
                                                                                                echo $_SESSION['idorder'];
                                                                                            }
                                                                                            ?>" class="flex-c-m size1 bg-brown bo-rad-20 hov1 s-text1 trans-0-4">
                                        Keranjang Belanja
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="wrap_header box-border-bottom">
                <div class="wrap_menu">
                    <nav class="menu">
                        <ul class="main_menu">
                            <li class="<?php echo $activemenu['product']; ?>">
                                <a href="<?php echo base_url('pages/product/search?category=0&price=asc&group=') ?>"><i class="fa fa-navicon"></i> Kategori <i class="fa fa-caret-down"></i></a>
                                <?php echo $menucategory; ?>
                            </li>
                            <li class="">
                                <i class="fa fa-picture-o"></i> <a href="<?php echo base_url('pages/galery') ?>"> Galery</a>
                                <ul class='sub_menu'>
                                    <li>
                                        <i class="fa fa-camera"></i> <a href="<?php echo base_url('pages/galery') ?>">Foto </a>
                                    </li>
                                    <li>
                                        <i class="fa fa-video-camera"></i><a href="<?php echo base_url('pages/galery') ?>">Video </a>
                                    </li>
                                </ul>

                            </li>
                            <li class="">
                                <i class="fa fa-question-circle-o"></i><a href="<?php echo base_url('pages/galery') ?>"> Bantuan</a>
                            </li>
                            <li class="">
                                <i class="fa fa-info-circle"></i><a href="<?php echo base_url('pages/galery') ?>"> Info</a>
                                <ul class='sub_menu'>
                                    <li>
                                        <i class="fa fa-id-card-o"></i> <a href="<?php echo base_url('pages/about') ?>"> Tentang Kami </a>
                                    </li>
                                    <li>
                                        <i class="fa fa-envelope-o"></i><a href="<?php echo base_url('pages/contact') ?>">Kontak Kami </a>
                                    </li>

                                </ul>
                            </li>
                            <li class="<?php echo $activemenu['payment']; ?>">
                                <i class="fa fa-money"> </i><a href="<?php echo base_url('pages/confirm-payment') ?>"> Konfirmasi Pembayaran</a>
                            </li>
                            <li>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="header-icons" id="prefetch">
                    <form method="GET" class="searchglobal" action="<?php echo base_url('pages/product-search/p'); ?>">
                        <input type="text" class="search-global typeahead" name="search" id="search" placeholder="Cari Produk..">
                        <button type="submit" value="cari" title="cari"><i class="fa fa-search"></i></button>
                    </form>
                </div>
            </div>
        </div>
        <div class="wrap_header_mobile fixed-top box-border-bottom">
            <a href="<?php echo base_url('') ?>" class="logo-mobile">
                <img src="<?php echo site_url('asset/img/uploads/banner/' . $logo->image . ''); ?>" alt="<?php echo $profile->companyName; ?>">
            </a>
            <div class="btn-show-menu">

                <?php
                if (!empty($this->session->userdata('username'))) {
                    echo '<a href="' . base_url('pages/profile') . '" class="header-wrapicon1 dis-block">';
                    echo "<small class='color0'><img src=" . base_url('asset/img/icons/icon-header-01.png') . " alt='ICON'> " . substr($this->session->userdata('username'), 0, 7) . "</small>";
                    echo "</a>";
                } else {
                    ?>
                    <a href="<?php echo base_url('pages/login') ?>" class="header-wrapicon1 dis-block">
                        <img src="<?php echo site_url('asset/img/') ?>icons/icon-header-01.png" class="header-icon1" alt="ICON">
                    </a>
                <?php } ?>
            </div>
            <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </div>
            <div class="header-icons-mobile" id="prefetch">
                <form class="searchglobal">
                    <input type="text" class="search-global typeahead" name="search_box" id="search_box" placeholder="Cari Produk..">
                    <button type="submit" value="cari" title="cari"><i class="fa fa-search"></i></button>
                </form>
                <span class="linedivide1"></span>
                <div class="header-wrapicon2" style="padding-left: -15px !important;">
                    <img src="<?php echo site_url('asset/img/') ?>icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
                    <span class="header-icons-noti" id="qty-cart-c"></span>
                    <div class="header-cart header-dropdown">
                        <div id="list-cart-c" class="scroll"></div>
                        <div class="header-cart-buttons">
                            <div class="header-cart-wrapbtn">
                                <a href="<?php echo base_url('pages/cart?idorder='); ?><?php
                                                                                        if (isset($_SESSION['idorder'])) {
                                                                                            echo $_SESSION['idorder'];
                                                                                        }
                                                                                        ?>" class="flex-c-m size1 bg-brown bo-rad-20 hov1 s-text1 trans-0-4">
                                    Keranjang Belanja
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="wrap-side-menu fixed-top" style="z-index: 9999; margin-top: 130px;">
            <nav class="side-menu">
                <ul class="main-menu">
                    <li class="item-menu-mobile">
                        <a href="<?php echo base_url(''); ?>">Home</a>
                    </li>
                    <li class="item-menu-mobile">
                        <a href="<?php echo base_url('pages/product/search?category=0&price=asc&group=') ?>">Product</a>
                    </li>
                    <li class="item-menu-mobile">
                        <a href="<?php echo base_url('pages/product/search?category=0&price=asc&group=sale'); ?>">Diskon</a>
                    </li>
                    <li class="item-menu-mobile">
                        <a href="<?php echo base_url('pages/track-order') ?>">Lacak Order</a>
                    </li>
                    <li class="item-menu-mobile">
                        <a href="<?php echo base_url('pages/confirm-payment') ?>">Konfirmasi Pembayaran</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>