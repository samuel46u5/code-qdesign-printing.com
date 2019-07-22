<?php echo $header_home; ?>
<?php if (!empty($datapopup)) { ?>
    <div class="bts-popup" role="alert">
        <div class="bts-popup-container">
            <?php if ($datapopup->popupType == "Image Only") { ?>
                <img class="image-replace" src="<?php echo base_url('asset/img/uploads/popup/' . $datapopup->popupImage . ''); ?>" alt="" width="100%" height="100%" />
            <?php } elseif ($datapopup->popupType == "Text Only") { ?>
                <p><?php echo $datapopup->popupText; ?></p>
            <?php } elseif ($datapopup->popupType == "Header Image And Bottom Text") { ?>
                <img class="image-replace" src="<?php echo base_url('asset/img/uploads/popup/' . $datapopup->popupImage . ''); ?>" alt="" width="100%" height="100%" />
                <p><?php echo $datapopup->popupText; ?></p>
            <?php } ?>
            <?php if ($datapopup->statusButton == "show") { ?>
                <div class="bts-popup-button">
                    <a href="<?php echo base_url('pages/product/search?category=0&price=asc&group='); ?>">Shop Now</a>
                </div>
            <?php } ?>
            <a href="#0" class="bts-popup-close img-replace">Close</a>
        </div>
    </div>
<?php } ?>
<section class="slide1">
    <div class="wrap-slick1">
        <div class="slick1">
            <?php
            $i = 1;
            foreach ($bannerhome as $value) {
                ?>
                <div class="item-slick1 item<?php echo $i++; ?>-slick1" style="background-image: url(<?php echo site_url('asset/img/uploads/banner/' . $value->image . '') ?>);">
                    <div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-30">
                        <h4 class="caption1-slide1 t-center bo14 p-b-6 animated visible-false m-text-glow m-b-22" data-appear="fadeInUp">
                            <?php echo $value->bannerText; ?>
                        </h4>
                        <div class="wrap-btn-slide1 w-size2 animated visible-false" data-appear="zoomIn">
                            <a href="<?php echo base_url('pages/product/search?category=0&price=asc&group=') ?>" class="flex-c-m size2 bo-rad-23 s-text2 bgwhite hov1 trans-0-4 bo17">
                                Shop Now
                            </a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>

<!-- SERVICE-1
    ================================================== -->
<section class="section" id="service">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-7 pl-4 text-center">
                <div class="service-heading">
                    <h1>Kenapa harus cetak di Qdesign</h1>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6">
                <div class="service-block media">
                    <div class="service-icon">
                        <i class="ti-reload"></i>
                    </div>
                    <div class="service-inner-content media-body">
                        <h4>Mesin terlengkap</h4>
                        <p>Kami mempunyai banyak mesin canggih dan dengan teknologi terkini, yang akan menjawab kebutuhan cetak anda </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 mb-3 col-md-6">
                <div class="service-block media">
                    <div class="service-icon">
                        <i class="ti-cloud"></i>
                    </div>
                    <div class="service-inner-content media-body">
                        <h4>Qualitas Terbaik</h4>
                        <p>Didukung dengan mesin yang baik dan team yang berpengalaman kami berkomitmen untuk selalu menjaga mutu dan kualitas produk</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 mb-3 col-md-6">
                <div class="service-block media ">
                    <div class="service-icon">
                        <i class="ti-world"></i>
                    </div>
                    <div class="service-inner-content media-body">
                        <h4>Harga Terjangkau</h4>
                        <p>Kami tidak memberikan produk dengan harga termurah, tapi kami selalu memberikan produk dengan harga terjangkau dengan kualitas terbaik</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 mb-3 col-md-6">
                <div class="service-block media ">
                    <div class="service-icon">
                        <i class="ti-server"></i>
                    </div>
                    <div class="service-inner-content media-body">
                        <h4>Team yang berpengalaman</h4>
                        <p>Kami sudah lama berkecimpung didunia printing, tentunya juga menghasilkan team-team yang berpengalaman dalam dunia printing</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="service-block media">
                    <div class="service-icon">
                        <i class="ti-world"></i>
                    </div>
                    <div class="service-inner-content media-body">
                        <h4>Sistem Komputerisasi</h4>
                        <p>Semua proses administrasi dan proses-proses pendukung lainnya sudah dalam bentuk komputeriasi. Tentunya akan meyakinkan para customer untuk bertransaksi ditempat kami.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="service-block media">
                    <div class="service-icon">
                        <i class="ti-cloud"></i>
                    </div>
                    <div class="service-inner-content media-body">
                        <h4>Produk Terlangkap</h4>
                        <p>Produk-produk di Qdesign adalah terlengkap di kota Jember</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 text-center">
                <p class="pl-3">Ingin tahu lebih banyak tentang kami? <a href="#">Kontak Kami</a></p>
            </div>
        </div>
    </div>
</section>

<section id="work" class="section-bottom">
    <div class="container">
        <div class="row">

            <?php foreach ($bannerftop as $value) { ?>
                <div class="work-block">
                    <!-- <img src="<?php echo site_url('asset/img/uploads/banner/370x390.jpg') ?>" alt="work-img" class="img-fluid"> -->
                    <img src="<?php echo site_url('asset/img/uploads/banner/' . $value->image . '') ?>" alt="IMG-BLOG" class="img-fluid">
                    <div class="overlay-content-block">
                        <h4><?php echo $value->bannerText; ?></h4>
                        <!-- <p>Web Development</p> -->
                        <a href="<?php echo base_url('pages/product/search?category=' . $value->bannerLink . '&price=asc&group='); ?>" class="flex-c-m size2 m-text2 bg3 hov1 trans-0-4 bo17">
                    </div>
                </div>
            <?php } ?>

            <!-- <div class="col-lg-4 col-md-6 p-0">
                <div class="work-block">
                    <img src="<?php echo site_url('asset/img/uploads/banner/370x390.jpg') ?>" alt="work-img" class="img-fluid">
                    <div class="overlay-content-block">
                        <h4>Probiz portfolio template</h4>
                        <p>Web Development</p>
                        <a href="single-project.html"><i class="fa fa-link"></i></a>
                    </div>
                </div>
            </div>


            <div class="col-lg-4 col-md-6 p-0">
                <div class="work-block">
                    <img src="<?php echo site_url('asset/img/uploads/banner/370x390.jpg') ?>" alt="work-img" class="img-fluid">
                    <div class="overlay-content-block">
                        <h4>Probiz portfolio template</h4>
                        <p>Web Development</p>
                        <a href="single-project.html"><i class="fa fa-link"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 p-0">
                <div class="work-block">
                    <img src="<?php echo site_url('asset/img/uploads/banner/370x390.jpg') ?>" alt="work-img" class="img-fluid">
                    <div class="overlay-content-block">
                        <h4>Probiz portfolio template</h4>
                        <p>Web Development</p>
                        <a href="single-project.html"><i class="fa fa-link"></i></a>
                    </div>
                </div>
            </div>
        </div> -->
        </div>
</section>

<!-- Web services
    ================================================== -->
<section class="section" id="services-2">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 text-center">
                <div class="section-heading">
                    <!-- Heading -->
                    <h2 class="section-title text-white">
                        Mesin
                    </h2>

                    <!-- Subheading -->
                    <p class="text-white">
                        Untuk mendukung produksi produk-produk yang profesional
                        Qdesign mengunakan mesin-mesin dengan teknologi terkini dan modern
                    </p>
                </div>
            </div>
        </div> <!-- / .row -->

        <div class="row">
            <div class="col-lg-4 col-sm-6 col-md-6 mb-30">
                <div class="web-service-block">
                    <i class="ti-light-bulb"></i>
                    <h3>Mesin A3+</h3>
                    <p>Mesin untuk cetak kertas</p>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-md-6 mb-30">
                <div class="web-service-block">
                    <i class="ti-desktop"></i>
                    <h3>Web Development</h3>
                    <p>Afraid we praise lively he suffer family estate is. Ample order up in of in ready. Timed blind had .</p>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-md-6 mb-30">
                <div class="web-service-block">
                    <i class="ti-announcement"></i>
                    <h3>Digital Marketing</h3>
                    <p>Afraid we praise lively he suffer family estate is. Ample order up in of in ready. Timed blind had .</p>
                </div>
            </div>

            <div class="col-lg-4 col-sm-6 col-md-6 ">
                <div class="web-service-block">
                    <i class="ti-layers-alt"></i>
                    <h3>Graphic Design</h3>
                    <p>Afraid we praise lively he suffer family estate is. Ample order up in of in ready. Timed blind had .</p>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-md-6 ">
                <div class="web-service-block">
                    <i class="ti-mobile"></i>
                    <h3>App Development</h3>
                    <p>Afraid we praise lively he suffer family estate is. Ample order up in of in ready. Timed blind had .</p>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-md-6 ">
                <div class="web-service-block">
                    <i class="ti-settings"></i>
                    <h3>Wordpress Installation</h3>
                    <p>Afraid we praise lively he suffer family estate is. Ample order up in of in ready. Timed blind had .</p>
                </div>
            </div>
        </div>
    </div>
</section>


<div class="banner bgwhite p-t-20 p-b-40">
    <div class="container">
        <div class="row">
            <?php foreach ($bannerftop as $value) { ?>
                <div class="col-sm-10 col-md-4 p-b-30 m-l-r-auto">
                    <div class="block3">
                        <div class="block3-img dis-block hov-img-zoom bo18">
                            <img src="<?php echo site_url('asset/img/uploads/banner/' . $value->image . '') ?>" alt="IMG-BLOG">
                        </div>
                        <div class="block1-wrapbtn w-size2">
                            <a href="<?php echo base_url('pages/product/search?category=' . $value->bannerLink . '&price=asc&group='); ?>" class="flex-c-m size2 m-text2 bg3 hov1 trans-0-4 bo17">
                                <?php echo $value->bannerText; ?>
                            </a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<?php if (!empty($productsale)) { ?>
    <section class="newproduct bggray p-t-30 p-b-35">
        <div class="container">
            <div class="sec-title p-b-20">
                <h3 class="m-text-flash">
                    FLASH DEAL
                </h3>
                <h3 class="m-text-countdown" id="countdown">Berakhir dalam</h3>
                <input id="lastsale" value="<?php echo date("M d, Y", strtotime($lastsale->endDate)); ?> 24:00:00" type="hidden">
            </div>
            <div class="wrap-slick4">
                <div class="slick4">
                    <?php foreach ($productsale as $value) { ?>
                        <div class="item-slick4 p-l-15 p-r-15">
                            <div class="block2">
                                <?php if ($value->pricesale != "") { ?>
                                    <div class="block2-img wrap-pic-w of-hidden hov-img-zoom pos-relative block2-labelsale">
                                        <span class="sale-precent-blok">
                                            <?php echo floor(($value->price - $value->pricesale) / $value->price * 100) . " % OFF"; ?>
                                        </span>
                                    <?php } else { ?>
                                        <div class="block2-img wrap-pic-w of-hidden hov-img-zoom pos-relative block2-labelnew">
                                        <?php } ?>
                                        <img src="<?php echo site_url('asset/img/uploads/product/' . $value->fotoName . '') ?>" class="bo18" alt="IMG-PRODUCT">

                                        <div class="block2-overlay trans-0-4">
                                            <div class="block2-btn-addcart w-size1 trans-0-4">
                                                <button onclick="window.location.href = '<?php echo base_url('pages/product-detail/' . $value->postSlug . '') ?>'" class="flex-c-m size1 bo-rad-23 bgwhite hov1 trans-0-4 bo17 s-text2 trans-0-4">
                                                    Beli
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="block2-txt p-t-20">
                                        <a href="<?php echo base_url('pages/product-detail/' . $value->postSlug . '') ?>" class="block2-name dis-block s-text3 p-b-5">
                                            <?php echo $value->productName; ?>
                                        </a>
                                        <?php if ($value->pricesale != "") { ?>
                                            <div class="text-center">
                                                <span class="block2-oldprice m-text7 text-center">
                                                    <?php echo "Rp. " . number_format($value->price); ?>
                                                </span>
                                                <span class="block2-newprice m-text8 text-center">
                                                    <?php echo "Rp. " . number_format($value->pricesale); ?>
                                                </span>
                                            </div>
                                        <?php } else { ?>
                                            <div class="text-center">
                                                <span class="block2-price m-text6 text-center">
                                                    <?php echo " Rp. " . number_format($value->price); ?>
                                                </span>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="sec-title p-t-30">
                    <h3 class="m-text5-arrow t-center">
                        <i class="fa fa-angle-double-down animated ani"></i>
                    </h3>
                    <h3 class="m-text5-arrow t-center">
                        <a href="<?php echo base_url('pages/product/search?category=0&price=ASC&group=sale') ?>" class="p-t-5 p-b-5 p-l-5 p-r-5 bo-rad-10 bg-brown">Lihat Semua </a>
                    </h3>
                </div>
            </div>
    </section>
<?php  } ?>

<section class="newproduct bgwhite p-t-30 p-b-35">
    <div class="container">
        <div class="sec-title-centered p-b-60">
            <h3 class="m-text5-glow t-center text-headline">
                New Arrivals
            </h3>
        </div>
        <div class="wrap-slick2">
            <div class="slick2">
                <?php foreach ($newarrival as $value) { ?>
                    <div class="item-slick2 p-l-15 p-r-15">
                        <div class="block2">
                            <?php if ($value->pricesale != "") { ?>
                                <div class="block2-img wrap-pic-w of-hidden hov-img-zoom pos-relative block2-labelsale">
                                    <span class="sale-precent-blok">
                                        <?php echo floor(($value->price - $value->pricesale) / $value->price * 100) . " % OFF"; ?>
                                    </span>
                                <?php } else { ?>
                                    <div class="block2-img wrap-pic-w of-hidden hov-img-zoom pos-relative block2-labelnew">
                                    <?php } ?>
                                    <img src="<?php echo site_url('asset/img/uploads/product/' . $value->fotoName . '') ?>" class="bo18" alt="IMG-PRODUCT">

                                    <div class="block2-overlay trans-0-4">
                                        <div class="block2-btn-addcart w-size1 trans-0-4">
                                            <button onclick="window.location.href = '<?php echo base_url('pages/product-detail/' . $value->postSlug . '') ?>'" class="flex-c-m size1 bo-rad-23 bgwhite hov1 trans-0-4 bo17 s-text2 trans-0-4">
                                                Beli
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="block2-txt p-t-20">
                                    <a href="<?php echo base_url('pages/product-detail/' . $value->postSlug . '') ?>" class="block2-name dis-block s-text3 p-b-5">
                                        <?php echo $value->productName; ?>
                                    </a>
                                    <?php if ($value->pricesale != "") { ?>
                                        <div class="text-center">
                                            <span class="block2-oldprice m-text7 text-center">
                                                <?php echo "Rp. " . number_format($value->price); ?>
                                            </span>
                                            <span class="block2-newprice m-text8 text-center">
                                                <?php echo "Rp. " . number_format($value->pricesale); ?>
                                            </span>
                                        </div>
                                    <?php } else { ?>
                                        <div class="text-center">
                                            <span class="block2-price m-text6 text-center">
                                                <?php echo " Rp. " . number_format($value->price); ?>
                                            </span>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="sec-title p-t-30">
            <h3 class="m-text5-arrow t-center">
                <i class="fa fa-angle-double-down animated ani"></i>
            </h3>
            <h3 class="m-text5-arrow t-center">
                <a href="<?php echo base_url('pages/product/search?category=0&price=ASC&group=new') ?>" class="p-t-5 p-b-5 p-l-5 p-r-5 bo-rad-10 bg-brown">Lihat Semua </a>
            </h3>
        </div>
    </div>
</section>

<section class="bgwhite p-t-30 p-b-35">
    <div class="container">
        <div class="sec-title-centered p-b-22">
            <h3 class="m-text5-glow t-center">
                Our Products
            </h3>
        </div>
        <div class="tab01">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#best-seller" role="tab">Best Seller</a>
                </li>
            </ul>
            <div class="tab-content p-t-35">
                <div class="tab-pane fade show active" id="best-seller" role="tabpanel">
                    <div class="row">
                        <?php if (empty($productbest)) { ?>
                            <div class="block2 bo18 text-center">
                                <p class="text-center">Maaf kategori ini masih kosong.</p>
                            </div>
                        <?php } else { ?>
                            <?php foreach ($productbest as $value) { ?>
                                <div class="col-sm-6 col-md-4 col-lg-3 p-b-30">
                                    <div class="block2">
                                        <?php if ($value->pricesale != "") { ?>
                                            <div class="block2-img wrap-pic-w of-hidden hov-img-zoom pos-relative block2-labelsale">
                                                <span class="sale-precent-blok">
                                                    <?php echo floor(($value->price - $value->pricesale) / $value->price * 100) . " % OFF"; ?>
                                                </span>
                                            <?php } else { ?>
                                                <div class="block2-img wrap-pic-w of-hidden hov-img-zoom pos-relative block2-labelnew">
                                                <?php } ?>
                                                <img src="<?php echo site_url('asset/img/uploads/product/' . $value->fotoName . '') ?>" class="bo18" alt="IMG-PRODUCT">

                                                <div class="block2-overlay trans-0-4">
                                                    <div class="block2-btn-addcart w-size1 trans-0-4">
                                                        <button onclick="window.location.href = '<?php echo base_url('pages/product-detail/' . $value->postSlug . '') ?>'" class="flex-c-m size1 bo-rad-23 bgwhite hov1 trans-0-4 bo17 s-text2 trans-0-4">
                                                            Beli
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="block2-txt p-t-20">
                                                <a href="<?php echo base_url('pages/product-detail/' . $value->postSlug . '') ?>" class="block2-name dis-block s-text3 p-b-5">
                                                    <?php echo $value->productName; ?>
                                                </a>
                                                <?php if ($value->pricesale != "") { ?>
                                                    <div class="text-center">
                                                        <span class="block2-oldprice m-text7 text-center">
                                                            <?php echo "Rp. " . number_format($value->price); ?>
                                                        </span>
                                                        <span class="block2-newprice m-text8 text-center">
                                                            <?php echo " Rp. " . number_format($value->pricesale); ?>
                                                        </span>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="text-center">
                                                        <span class="block2-price m-text6 text-center">
                                                            <?php echo "Rp. " . number_format($value->price); ?>
                                                        </span>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        </div>
                        <div class="sec-title">
                            <h3 class="m-text5-arrow t-center">
                                <i class="fa fa-angle-double-down animated ani"></i>
                            </h3>
                            <h3 class="m-text5-arrow t-center">
                                <a href="<?php echo base_url('pages/product/search?category=0&price=ASC&group=best') ?>" class="p-t-5 p-b-5 p-l-5 p-r-5 bo-rad-10 bg-brown">Lihat Semua </a>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
<hr>
<section class="shipping bgwhite p-t-30 p-b-35">
    <div class="flex-w p-l-15 p-r-15">
        <?php if (!empty($footertagline)) {
            foreach ($footertagline as $value) { ?>
                <div class="flex-col-c w-size5 p-l-15 p-r-15 p-t-16 p-b-15 respon1">
                    <h4 class="m-text12 t-center">
                        <?php echo $value->taglineTitle; ?>
                    </h4>
                    <span class="s-text11 t-center">
                        <?php echo $value->taglineDescription; ?>
                    </span>
                </div>
            <?php }
    } ?>
    </div>
</section>
<section class="shipping bggray p-t-15 p-b-15">
    <div class="container">
        <div class="flex-w p-l-15 p-r-15">
            <div class="col-md-6">
                <h4 class="m-text12 t-left">
                    Pembayaran

                </h4>
                <span class="col-md-3">
                    <img src="<?php echo base_url('asset/img/icons/bank-bca.png') ?>">
                </span>
                <!-- <span class="col-md-3">
                <img src="<?php echo base_url('asset/img/icons/bank-bni.png') ?>">
            </span>
            <span class="col-md-3">
                <img src="<?php echo base_url('asset/img/icons/bank-bri.png') ?>">
            </span>
            <span class="col-md-3">
                <img src="<?php echo base_url('asset/img/icons/bank-mandiri.png') ?>">
            </span> -->
            </div>
            <div class="col-md-6">
                <h4 class="m-text12 t-center">
                    Jasa Pengiriman
                </h4>
                <span class="col-md-3">
                    <img src="<?php echo base_url('asset/img/icons/pos.png') ?>">
                </span>
                <span class="col-md-3">
                    <img src="<?php echo base_url('asset/img/icons/si-cepat.png') ?>">
                </span>
                <span class="col-md-3">
                    <img src="<?php echo base_url('asset/img/icons/jne.png') ?>">
                </span>
            </div>
        </div>

    </div>
</section>
<section class="shipping bggray p-t-5 p-b-20">
    <center>

        <h4 class="m-text12 t-center">
            Support By
        </h4>
        <span class="col-md-3">
            <img src="<?php echo base_url('asset/img/icons/pos.png') ?>">
            <img src="<?php echo base_url('asset/img/icons/pos.png') ?>">
            <img src="<?php echo base_url('asset/img/icons/pos.png') ?>">
            <img src="<?php echo base_url('asset/img/icons/pos.png') ?>">
            <img src="<?php echo base_url('asset/img/icons/pos.png') ?>">
        </span>



    </center>
</section>

<script>
    $(document).ready(function() {
        if (Notification.permission !== "granted")
            Notification.requestPermission();
    });

    function notifikasi() {
        if (!Notification) {
            alert('Browsermu tidak mendukung Web Notification.');
            return;
        }
        if (Notification.permission !== "granted")
            Notification.requestPermission();
        else {
            var notifikasi = new Notification('Judul Notifikasi', {
                icon: 'http://jagocoding.com/theme/New/img/logo.png',
                body: "Belajar di Jago Coding, Sangat Menyenangkan !",
            });
            notifikasi.onclick = function() {
                window.open("http://goo.gl/dIf4s1");
            };
            setTimeout(function() {
                notifikasi.close();
            }, 5000);
        }
    };
</script>
<?php echo $footer; ?>
<?php if (!empty($productsale)) { ?>
    <script type="text/javascript" src="<?php echo base_url('asset/') ?>vendors/countdowntime/countdowntime.js"></script>
<?php } ?>
<?php if ($this->session->flashdata('MSG')) { ?>
    <?= $this->session->flashdata('MSG') ?>
<?php } ?>
<?php if (!empty($datapopup)) { ?>
    <script>
        jQuery(document).ready(function($) {
            window.onload = function() {
                $(".bts-popup").delay(1000).addClass('is-visible');
            }
            $('.bts-popup-trigger').on('click', function(event) {
                event.preventDefault();
                $('.bts-popup').addClass('is-visible');
            });
            $('.bts-popup').on('click', function(event) {
                if ($(event.target).is('.bts-popup-close') || $(event.target).is('.bts-popup')) {
                    event.preventDefault();
                    $(this).removeClass('is-visible');
                }
            });
            $(document).keyup(function(event) {
                if (event.which == '27') {
                    $('.bts-popup').removeClass('is-visible');
                }
            });
        });
    </script>
<?php } ?>
</body>

</html>