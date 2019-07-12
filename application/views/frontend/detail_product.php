<?php echo $header_detail; ?>
<?php if (!empty($fbcomment)) { ?>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v3.2&appId=<?php echo $fbcomment->widgetScriptId; ?>&autoLogAppEvents=1"></script>
<?php } ?>
<div class="bread-crumb-detail bgwhite flex-w p-l-52 p-r-15 p-t-10  m-t-50 p-b-10 p-l-15-sm">
    <a href="<?php echo base_url('') ?>" class="s-text16">
        Home
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>
    <a href="<?php echo base_url('pages/product/search?category=0&price=asc&group=') ?>" class="s-text16">
        Semua Produk
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>
    <?php echo $breadcrumb;?>
    <span class="s-text17">
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i> <?php echo $productdetail->productName; ?>
    </span>
</div>
<div class="container bgwhite p-t-10 p-b-5">
    <div class="flex-w flex-sb">
        <div class="w-size13 p-t-10 respon5">
            <div class="wrap-slick3 flex-sb flex-w widget sticky">
                <div class="wrap-slick3-dots"></div>
                <div class="slick3">
                    <?php foreach ($productfoto as $value) { ?>
                        <div class="item-slick3" data-thumb="<?php echo site_url('asset/img/uploads/product/' . $value->fotoName . '') ?>">
                            <div class="wrap-pic-w">
                                <a rel="fancybox-thumb" class="fancybox-thumb" href="<?php echo site_url('asset/img/uploads/product/' . $value->fotoName . '') ?>" >
                                    <img src="<?php echo site_url('asset/img/uploads/product/' . $value->fotoName . '') ?>" alt="<?php echo $productdetail->productName; ?>">
                                </a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="w-size14 p-t-20 respon5">
            <h4 class="product-detail-name">
                <?php echo $productdetail->productName; ?>
            </h4><hr>
            <?php if ($productdetail->pricesale != "") { ?>
                <h3 class="m-text-flash">
                    FLASH DEAL
                </h3>
                <h3 class="m-text-countdown" id="countdown">Berakhir dalam</h3><hr>
                <input id="lastsale" value="<?php echo date("M d, Y", strtotime($productdetail->endDate));?> 24:00:00" type="hidden">
            <?php } ?>
            <?php if ($productdetail->quantityStock >= 5) { ?>
                <span class="label success">Ready Stock</span>
            <?php } elseif ($productdetail->quantityStock < 5) { ?>
                <span class="label warning"><?php echo $productdetail->productStatus . " | <b>" . $productdetail->quantityStock."</b>"; ?></span>
            <?php } ?>
            <button class="text-center text-danger" onclick="addToWistlist();" > <i class="fa fa-heart"></i> Add to Wishlist</button>
            <?php if($productdetail->multilevelStatus != "yes"){?>
                <div class="m-text17 p-t-5">
                    <?php if ($productdetail->pricesale != "") { ?>
                        <span class="block2-oldprice m-text7 p-r-5">
                            <?php echo "Rp. " . number_format($productdetail->price); ?>
                        </span>
                        <span class="block2-newprice s-textprice p-r-5 p-t-10">
                            <?php echo "Rp. " . number_format($productdetail->pricesale)." / Pcs"; ?>
                        </span>
                        <span class="sale-precent">
                            <?php echo floor(($productdetail->price-$productdetail->pricesale)/$productdetail->price*100) ." % OFF";?>
                            </span>  <?php } else { ?>
                                <span class="block2-newprice s-textprice p-r-5 p-t-10">
                                    <?php echo "Rp. " . number_format($productdetail->price)." / Pcs"; ?>
                                </span>
                            <?php } ?>
                        </div>
                    <?php }else{ ?>
                        <div class="m-text19 p-t-15">
                            <span class="p-b-5">Harga per <?php echo $datamultilevel[0]->unit;?></span>
                            <table class="table table-bordered">
                                <?php foreach ($datamultilevel as $value) {?>
                                    <tr>
                                        <td><?php if($value->rangeEnd == 0){echo "≥ ".$value->rangeStart." ".$value->unit;}else{echo $value->rangeStart." - ".$value->rangeEnd." ".$value->unit;}?></td>
                                        <td><?php echo "Rp. ".number_format($value->multilevelPrice);?></td>
                                    </tr>
                                <?php  } ?>
                            </table>        
                        </div>
                    <?php }?>
                    <div class="p-t-5 p-b-10">
                        <div class="flex-m flex-w p-b-10">
                            <div class="m-text19 p-r-5">
                                Jumlah
                            </div>
                            <div class="flex-w bo5 of-hidden m-r-22 m-t-10 m-b-10">

                                <input class="size8 m-text18 t-center" type="number" name="qty" id="qty" value="1" min="1" max="<?php echo $productdetail->quantityStock; ?>" onchange="totalPrice();">

                            </div>
                            
                            <div class="p-t-5 p-b-10">
                            <div class="flex-m flex-w">
                                <div class="m-text19">
                                    Total Harga : Rp. <span class="m-r-35" id="totalprice"></span>
                                </div>
                            </div>
                        </div>
                            
                            <div class="flex-w of-hidden m-r-22 m-b-10">
                                <div class="m-text19">
                                    Catatan
                                </div>
                                <textarea type="text" name="note" id="note" class="note" id="note" placeholder="Contoh warna, ukuran, dll"></textarea> 
                            </div>
                            <div class="btn-addcart-product-detail col-md-6 size25 trans-0-4 m-t-10 m-b-1">
                                <button data-weight="<?php echo $productdetail->productWeight; ?>" data-idproduct="<?php echo $productdetail->idp; ?>" data-image="<?php echo $productdetail->fotoName; ?>"
                                    data-productname="<?php echo $productdetail->productName; ?>" data-price="<?php
                                    if ($productdetail->pricesale != "") {
                                        echo $productdetail->pricesale;
                                        } else {
                                            echo $productdetail->price;
                                        }
                                        ?>"
                                        id="add_cart" class="add_cart flex-c-m sizefull bg1 bo-rad-4 hov1 s-text14 trans-0-4" <?php if(!empty($fbpixel)){?>onClick="fbq('track', 'AddToCart');"<?php } ?>>
                                        Add to Cart
                                    </button>
                                </div>
                                <?php if(!empty($orderwa)){?>
                                    <div class="wrap p-t-10 col-md-6">
                                        <button class="order_via_wa flex-c-m sizefull"><i class="fa fa-whatsapp"></i>  Order Via Whatsapp</button>
                                    </div>
                                <?php }?>
                            </div>
                        </div>

                        <div class="p-b-20">
                            <span class="s-text8 m-r-35">SKU:  <?php echo $productdetail->idp; ?></span>
                            <span class="s-text8 m-r-35">Kategori: <?php echo $productdetail->categoryName; ?></span>
                        </div>
                        <div class="wrap-dropdown-content bo7 p-t-15 p-b-14 active-dropdown-content">
                            <h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
                                Informasi Tambahan
                                <i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
                                <i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
                            </h5>
                            <div class="dropdown-content dis-none p-t-15 p-b-10">
                                <p class="s-text8">
                                    <span class="s-text8 m-r-35">Material :</span>
                                    <span class="s-text8"><?php echo $productdetail->material; ?></span><br>
                                    <span class="s-text8 m-r-62">Size :</span>
                                    <span class="s-text8"><?php echo $productdetail->size; ?></span><br>
                                    <span class="s-text8 m-r-40">Weight :</span>
                                    <span class="s-text8"><?php echo ($productdetail->productWeight/1000)." Kg"; ?></span><br>
                                </p>
                            </div>
                        </div>
                        <div class="wrap-dropdown-content bo6 p-t-15 p-b-14 active-dropdown-content">
                            <h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
                                Deskripsi
                                <i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
                                <i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
                            </h5>
                            <div class="dropdown-content dis-none p-t-15 p-b-23">
                                <span class="s-text8">
                                    <?php echo $productdetail->productDescription; ?>
                                </span>
                            </div>
                        </div>
                        <div class="p-b-10">
                            <?php if (!empty($sharebutton)) { ?>
                                <span class="s-text8">Bagikan</span>
                            <?php } ?>
                            <div class="sharethis-inline-share-buttons" id="sharethis-inline-share-buttons"></div>
                            <div class="sharethis-inline-reaction-buttons"></div>
                        </div>
                        <?php if($productdetail->fileDesignStatus == "yes"){?>
                        <hr>
                        <div class="p-t-5 p-b-10">
                            <div class="flex-m flex-w">
                                <div class="m-text19">
                                    Upload File Design
                                </div>
                                <div class="p-b-20">
                                    <span class="s-text8 m-r-35">1. Cek kembali ukuran desain Anda apakah sudah sesuai dengan ukuran jadi produk yang Anda pesan</span><br>
                                    <span class="s-text8 m-r-35">2.Pastikan Anda mengirimkan File Final kepada Qdesign. Hati-hati dengan pengambilan data revisi.</span><br>
                                    <span class="s-text8 m-r-35">3. Kirimkan desain High Resolution 300 dpi, CMYK, dan Package link image + font yang digunakan dalam desain Anda.</span><br>
                                    <span class="s-text8 m-r-35">4. Anda dapat mengunggah langsung dengan form upload atau Anda dapat memberikan link download dari Google Drive atau Dropbox.</span><br><br>
                                    <div class="m-text19">
                                        Jika Anda ragu, jangan khawatir. CS kami akan selalu melakukan proses pemeriksaan desain dan melakukan konfirmasi kepada Anda.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="wrap-dropdown-content bo6 p-t-15 p-b-14 active-dropdown-content">
                            <h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
                                <i class="fa fa-cloud-upload"></i> Upload File
                                <i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
                                <i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
                            </h5>
                            <div class="dropdown-content dis-none p-t-15 p-b-23">
                                <form role="form" enctype="multipart/form-data" method="post" id="formfiledesign">
                                    <input type="file" name="file" id="file" class="form-control" onchange="return ValidateSingleInput(this);" placeholder="Contoh warna, ukuran, dll">
                                </form>
                            </div>
                        </div>

                        <div class="wrap-dropdown-content bo6 p-t-15 p-b-14 active-dropdown-content">
                            <h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer s-text8 color0-hov trans-0-4">
                                <img src="<?php echo base_url('asset/img/icons/logo-gdrive.webp')?>" style="max-width:80px;"> 
                                | <img src="<?php echo base_url('asset/img/icons/logo-dropbox.webp')?>" style="max-width:80px;">
                                Link download Google Drive atau DropBox
                                <i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
                                <i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
                            </h5>
                            <div class="dropdown-content dis-none p-t-15 p-b-23">
                                <form class="login_form row">
                                    <div class="col-md-12 form-group">
                                    <input class="form-control" type="text" name="link-design" id="link-design" placeholder="Link download Google Drive atau DropBox" onchange="return validUrl();"object>
                                    </div>                                                            
                                </form>
                            </div>
                        </div>
                        <?php } ?>


                        
                        
                    </div>
                </div>
            </div>
    <div id="bottomsticky"></div>

    
        <?php if (!empty($relateproduct)) { ?>
        <section class="relateproduct bgwhite p-t-30 p-b-30">
                <div class="container">
                    <div class="sec-title p-b-30">
                        <h3 class="m-text5-glow t-center">
                            Produk yang Mungkin Anda Suka
                        </h3>
                    </div>
                    <div class="wrap-slick2">
                        <div class="slick2">
                            <?php foreach ($relateproduct as $value) { ?>
                                <div class="item-slick2 p-l-15 p-r-15">
                                    <div class="block2">
                                        <?php if ($value->pricesale != "") { ?>
                                            <div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelsale">
                                                <span class="sale-precent-blok">
                                                    <?php echo floor(($value->price-$value->pricesale)/$value->price*100) ." % OFF";?>
                                                </span>
                                            <?php } else { ?>
                                                <div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew">
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
    </div>
</section>
<?php } ?>
<?php if (!empty($fbcomment)) { ?>
    <div class="container">
        <hr>
        <div class="col-md-6">
            <div class="fb-comments" data-width="50%" data-numposts="5"></div>
        </div>
    </div>
<?php } ?>
<?php echo $footer; ?>
<script src="<?php echo base_url('');?>asset/vendors/fancybox/jquery.fancybox.pack.js" type="text/javascript"></script>
<?php if($productdetail->pricesale != ""){?>
    <script type="text/javascript" src="<?php echo base_url('asset/') ?>vendors/countdowntime/countdowntime.js"></script>
<?php  } ?>
<?php if(!empty($orderwa)){?>
    <div class="footer-fixed navbar-fixed-bottom wow fadeInUp">
        <div class="col-lg-12 col-xs-6 col-sm-6 no-margin">
            <button class="order_via_wa"><i class="fa fa-whatsapp"></i> Order Via Whatsapp</button>
        </div>
    </div>
<?php } ?>
<script type="text/javascript">
    $(document).ready(function () {
          if(window.matchMedia('(min-width: 700px)').matches) {
            <?php if (!empty($fbcomment)) { ?>
            // $('.sticky').sticky( {topSpacing: 70,bottomSpacing:750} );
            $('.sticky').sticky( {topSpacing: 70,bottomSpacing:1080} );
            <?php }else{?>
            $('.sticky').sticky( {topSpacing: 70,bottomSpacing:850} );<?php }?>
        }
        totalPrice();
        jQuery(window).scroll(function () {
            if ($(this).scrollTop() > 200) {
                $('.footer-fixed').fadeIn();
            } else {
                $('.footer-fixed').fadeOut();
            }
        });
        $('.add_cart').click(function () {
            <?php if($productdetail->fileDesignStatus =="yes"){?>
            var filede = document.getElementById('file').files[0];
            var filee = $('#file').val();
            var file = '';
            var linkdesign = $('#link-design').val();
            if(filede){
                var file = filede.name;
                uploadFileDesign();
            }
            <?php } ?>
            var rowid = $(this).data("rowid");
            var idproduct = $(this).data("idproduct");
            var productname = $(this).data("productname");
            var price = $(this).data("price");
            var image = $(this).data("image");
            var weight = $(this).data("weight");
            var qty = $('#qty').val();
            var note = $('#note').val();
            var curqty = <?php echo $productdetail->quantityStock; ?>;
            if (qty > curqty) {
                swal("Gagal", "Stok " + curqty + ". Silahkan masukan jumlah yang lebih kecil", "error");
                document.getElementById("qty").value = curqty;
            } 
                <?php if($productdetail->fileDesignStatus =="yes"){?>  else if((linkdesign == '') && (filee == '')){
                var c = confirm("Anda belum menggunggah atau memberikan file design, tetap lanjutkan?!");
                if(c == true){
                    $.ajax({
                    url: '<?php echo base_url('Cart/add_to_cart') ?>',
                    method: "POST",
                    data: {linkdesign:linkdesign, file:file, idproduct: idproduct, productname: productname, price: price, qty: qty, image: image, weight: weight, note:note},
                    success: function (resp) {
                        $('#qty-cart-a').html(resp);
                        $('#qty-cart-b').html(resp);
                        $('#qty-cart-c').html(resp);
                        getQty();
                        getList();
                        document.getElementById('note').value = '';
                        document.getElementById("link-design").value = '';
                    }
                });
                }else if(c == false){
                document.getElementById("link-design").focus();
                }
            }
            <?php } ?>else{
            <?php if($productdetail->fileDesignStatus != "yes"){?> var linkdesign = ''; var file = '';<?php }?>
             $.ajax({
                    url: '<?php echo base_url('Cart/add_to_cart') ?>',
                    method: "POST",
                    data: {linkdesign:linkdesign, file:file, idproduct: idproduct, productname: productname, price: price, qty: qty, image: image, weight: weight, note:note},
                    success: function (resp) {
                        $('#qty-cart-a').html(resp);
                        $('#qty-cart-b').html(resp);
                        $('#qty-cart-c').html(resp);
                        getQty();
                        getList();
                        document.getElementById('note').value = '';
                         <?php if($productdetail->fileDesignStatus =="yes"){?>
                        document.getElementById("link-design").value = '';
                         <?php } ?>
                    }
                });
            }
        });
        getQty();
        $('.order_via_wa').click(function () {
            var csphone = <?php echo $cs->csPhone;?>;
            var id = <?php echo $cs->id;?>;
            var count = <?php echo $cs->count;?>;
            <?php if($useragent == "iPhone" || $useragent == "Android" || $useragent == "webOS" || $useragent == "BlackBerry" || $useragent == "iPod"){?>
                window.open('https://api.whatsapp.com/send?phone=<?php echo $cs->csPhone;?>&text=Hallo kak <?php echo $cs->csName;?>, Saya mau Order <?php echo $productdetail->productName?>, bagaimana caranya?', '_blank');
            <?php }else{ ?>
                window.open('https://web.whatsapp.com/send?phone=<?php echo $cs->csPhone;?>&text=Hallo kak <?php echo $cs->csName;?>, Saya mau Order <?php echo $productdetail->productName?>, bagaimana caranya?', '_blank');
            <?php } ?>
            $.ajax({
                url: '<?php echo base_url('d/Cs/add_action_order_cs') ?>',
                method: "POST",
                data: {csphone:csphone,id:id,count:count}
            });
        });
        $(".fancybox-thumb").fancybox({
            prevEffect  : 'none',
            nextEffect  : 'none',
            helpers : {
                title   : {
                    type: 'outside'
                },
                thumbs  : {
                    width   : 50,
                    height  : 50
                }
            }
        });
    });
    function getQty() {
        var id = '<?php echo $productdetail->idp; ?>';
        var qty = <?php echo $productdetail->quantityStock; ?>;
        $.ajax({
            url: '<?php echo base_url('Product/cek_qty') ?>',
            method: "post",
            data: {id: id},
            success: function (resp) {
                if (resp === "0") {
                    document.getElementById("qtyplus").disabled = true;
                    document.getElementById("add_cart").disabled = true;
                } else if (resp === qty) {
                    document.getElementById("qtyplus").disabled = true;
                    document.getElementById("add_cart").disabled = true;
                }
            }
        });
    }
    
    function addToWistlist() {
        var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{1,3})+$/;
        var phoneformat = /([\[\(])?(?:(\+62)|62|0)\1? ?-? ?8(?!0|4|6)\d(?!0)\d\1? ?-? ?\d{3,4} ?-? ?\d{3,5}(?: ?-? ?\d{3})?\b/;
        var idproduct = '<?php echo $productdetail->idp; ?>';
        swal({
            title: "Tambahkan Ke Wishlist!",
            text: "No HP atau Email:",
            type: "input",
            showCancelButton: true,
            confirmButtonColor: "#5cb85c",
            confirmButtonText: "Add to Wishlist",
            cancelButtonText: "Batal",
            closeOnConfirm: false,
            animation: "slide-from-top",
            inputPlaceholder: "E-mail atau No HP",
        },
        function (inputValue) {
            if (inputValue === "") {
                swal.showInputError("Masukan Nomor Hp atau email!");
                return false;
            }else{
                if(mailformat.test(inputValue) == false)
                {
                    if(phoneformat.test(inputValue) == false){
                       swal.showInputError("Masukan Format HP atau email yang benar!");
                       return false;
                   }else if(mailformat.test(inputValue) == true){
                    return false;
                }
            }
        }
        $.ajax({
            url: '<?php echo base_url('Cart/add_to_wishlist'); ?>',
            method: "POST",
            data: {"idproduct": idproduct, "emailhp": inputValue},
            success: function (data) {
                $('#alert').html(data);
            }
        }),
        swal("Terimakasih,", "<?php echo $productdetail->productName; ?> ditambahkan ke Wishlist", "success");
    });
    }

    var _validFileExtensions = [".jpg", ".jpeg", ".png", ".pdf", ".rar", ".zip", ".cdr", ".eps", ".ai"];
    function ValidateSingleInput(oInput) {
        if (oInput.type == "file") {
            var sFileName = oInput.value;
            if (sFileName.length > 0) {
                var blnValid = false;
                for (var j = 0; j < _validFileExtensions.length; j++) {
                    var sCurExtension = _validFileExtensions[j];
                    if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                        blnValid = true;
                        break;
                    }
                }

                if (!blnValid) {
                    alert("Maaf, " + sFileName + " tidak valid, silahkan upload dengan tipe file: " + _validFileExtensions.join(", "));
                    oInput.value = "";
                    return false;
                }
            }
        }
        return true;
    }
    
    var expression = /[-a-zA-Z0-9@:%_\+.~#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~#?&//=]*)?/gi;
    var regex = new RegExp(expression);
    function validUrl(){
        var url = $('#link-design').val();
        if(!(url.match(regex))){
            alert("Maaf, "+ url +" tidak valid, Silahkan isikan url link download file yang valid.");
            return false;
        }
    }

    function uploadFileDesign(){
        var form = $('#formfiledesign').get(0);
        $.ajax({
            url: '<?php echo base_url('Cart/do_upload_file_design') ?>',
            method: "POST",
            data: new FormData(form),
            contentType: false,
            processData: false
        });
    }
    
    function totalPrice(){
        var id = '<?php echo $productdetail->idp; ?>';
        var qty = $('#qty').val();
        $.ajax({
            url: '<?php echo base_url('Cart/total_price') ?>',
            method: "post",
            data: {id: id, qty:qty},
            success: function (resp) {
                $('#totalprice').html(resp);
            }
        });
    }
    
    <?php if(!empty($fbpixel)){?>
        var button = document.getElementById('add_cart');
        button.addEventListener(
            'click',
            function () {
                fbq('track', 'AddToCart', {
                    content_name: '<?php echo $productdetail->productName; ?>',
                    content_category: '<?php echo $productdetail->categoryName; ?>',
                    content_ids: ['<?php echo $productdetail->idproduct; ?>'],
                    content_type: 'product'
                });
            },
            false
            );
    <?php } ?>
</script>
</body>
</html>