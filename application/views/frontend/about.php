<?php echo $header; ?>
<section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background-image: url(<?php echo site_url('asset/img/uploads/banner/' . $bannertitlepage->image . '') ?>);">
    <h2 class="l-text2 t-center m-text-glow">
        Tentang Kami
    </h2>
</section>
<div class="bread-crumb bgwhite flex-w p-l-52 p-r-15 p-t-50">
    <a href="<?php echo base_url('') ?>" class="s-text16">
        Home
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>
    <span class="s-text17">
        Tentang Kami
    </span>
</div>
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
<section class="bgwhite p-t-66 p-b-38">
    <div class="container">
        <div class="row">
            <div class="col-md-4 p-b-30">
                <div class="hov-img-zoom">
                    <img src="<?php echo site_url('asset/img/uploads/banner/' . $logo->image . ''); ?>" alt="IMG-ABOUT">
                </div>
            </div>
            <div class="col-md-8 p-b-30">
                <h3 class="m-text26 p-t-15 p-b-16">
                    <?php echo $profile->companyName; ?>
                </h3>

                <p class="p-b-28">
                    <?php echo $profile->companyDescription; ?>
                </p>
                <p class="s-text8 w-size27">
                    <?php echo $profile->address1; ?><br>
                    <?php echo $profile->email; ?><br>
                    <?php echo $profile->phone1; ?>
                </p>
            </div>
        </div>
        <div id="pete">
            <div class="divider-text">Lokasi</div>
            <center>
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d987.3397247744305!2d113.68749601532296!3d-8.166549342102172!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd6941441bf83b5%3A0xf10bbdef58dff179!2sQDesign+Digital+Printing!5e0!3m2!1sid!2sid!4v1558168114797!5m2!1sid!2sid" width="1000" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
            </center>
        </div>
    </div>
</section>
<?php echo $footer; ?>
</body>

</html>