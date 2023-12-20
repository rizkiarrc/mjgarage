<?php
$nav_produk = new \App\Models\Produk_model();
$nav_mobile = new \App\Models\Produk_model();
$site = new \App\Models\Konfigurasi_model();
$nav_produk = $nav_produk->nav_produk();
$nav_mobile = $nav_mobile->nav_produk();
$site = $site->get_all();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title><?= $title ?></title>
    <meta name="author" content="<?= $site->author ?>">
    <meta name="keywords" content="<?= $site->keyword ?>">
    <meta name="description" content="<?= $site->deskripsi ?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="<?= base_url('assets/img/' . $site->icon); ?>" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/templates/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/templates/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/templates/fonts/themify/themify-icons.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/templates/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/templates/fonts/elegant-font/html-css/style.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/templates/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/templates/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/templates/vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/templates/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/templates/vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/templates/vendor/slick/slick.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/templates/vendor/lightbox2/css/lightbox.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/templates/css/stylesheet.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/templates/css/style.css">
    <!--===============================================================================================-->
</head>

<body class="animsition">

    <!-- Header -->
    <header class="header1">
        <!-- Header desktop -->
        <div class="container-menu-header">
            <div class="topbar">
                <div class="topbar-social">
                    <a href="<?= $site->facebook ?>" target="_blank" class="topbar-social-item fa fa-facebook"></a>
                    <a href="<?= $site->instagram ?>" target="_blank" class="topbar-social-item fa fa-instagram"></a>
                </div>

                <span class="topbar-child1">
                    <?= $site->email ?>
                </span>

                <div class="topbar-child2">
                    <span class="topbar-email">
                        <?= $site->telepon ?>
                    </span>
                </div>
            </div>

            <div class="wrap_header">
                <!-- Logo -->
                <a href="<?= base_url('/'); ?>" class="logo mx-5">
                    <img src="<?= base_url('assets/img/' . $site->logo); ?>" alt="IMG-LOGO">
                </a>

                <!-- Menu -->
                <div class="wrap_menu">
                    <nav class="menu">
                        <ul class="main_menu">
                            <li class="sale-noti">
                                <a href="/">Beranda</a>
                            </li>
                            <li>
                                <a href="/produk">Produk &amp; Belanja</a>
                                <ul class="sub_menu">
                                    <?php foreach ($nav_produk as $nav_produk) { ?>
                                        <li class="nav-item"><a href="<?= base_url('produk/kategori/' . $nav_produk->url) ?>">
                                                <?= $nav_produk->nama_kategori ?></a></li>
                                    <?php } ?>
                                </ul>
                            </li>

                            <li>
                                <a href="<?= base_url('tentang'); ?>">Tentang</a>
                            </li>

                            <li>
                                <a href="<?= base_url('kontak'); ?>">Kontak</a>
                            </li>
                        </ul>
                    </nav>
                </div>

                <!-- Header Icon -->
                <div class="header-icons">

                    <?php if (session()->get('id_user')) { ?>
                        <a href="<?= base_url('dashboard/belanja') ?>" class="header-wrapicon1 dis-block">
                            <img src="<?= base_url(); ?>assets/templates/images/icons/icon-header-01.png" class="header-icon1" alt="ICON"> <?= session()->get('nama') ?>
                        </a>
                        <span class="linedivide1"></span>
                        <a href="<?= base_url('member/logout') ?>" class="header-wrapicon1 dis-block">
                            <i class="fa fa-sign-out"></i> </a>

                    <?php } else { ?>
                        <a href="<?= base_url('/member') ?>" class="header-wrapicon1 dis-block">
                            <img src="<?= base_url(); ?>assets/templates/images/icons/icon-header-01.png" class="header-icon1" alt="ICON">
                        </a>

                    <?php } ?>

                    <span class="linedivide1"></span>
                    <div class="header-wrapicon2">
                        <?php
                        //cek belanjaan ada atau tidak
                        $cart = \Config\Services::cart();
                        $keranjang = $cart->contents();
                        ?>
                        <img src="<?= base_url(); ?>assets/templates/images/icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
                        <span class="header-icons-noti"><?= count($keranjang) ?></span>

                        <!-- Header cart noti -->
                        <div class="header-cart header-dropdown">
                            <ul class="header-cart-wrapitem">

                                <?php
                                //kalau gak ada belanjaan
                                if (empty($keranjang)) {
                                ?>

                                    <li class="header-cart-item">
                                        <p class="alert alert-success">Keranjang Belanja Kosong</p>
                                    </li>
                                    <?php
                                    //kalau ada belanjaan
                                } else {
                                    //total
                                    $total_belanja = 'Rp. ' . number_format($this->cart->total(), '0', ',', '.');

                                    foreach ($keranjang as $keranjang) {
                                        $id_produk = $keranjang['id'];
                                        //ambil data
                                        $produknya = $this->produk_model->getbyid($id_produk, 'produk');
                                    ?>
                                        <li class="header-cart-item">
                                            <div class="header-cart-item-img">
                                                <img src="<?= base_url('assets/admin/foto/') . $produknya->gambar; ?>" alt="<?= $keranjang['name'] ?>">
                                            </div>

                                            <div class="header-cart-item-txt">
                                                <a href="<?= base_url('produk/detail/' . $produknya->nama_produk) ?>" class="header-cart-item-name">
                                                    <?= $keranjang['name'] ?>
                                                </a>
                                                <span class="header-cart-item-info">
                                                    <?= $keranjang['qty'] ?> x <?= 'Rp. ' . number_format($keranjang['price'], '0', ',', '.') ?> = <?= 'Rp. ' . number_format($keranjang['subtotal'], '0', ',', '.') ?>
                                                </span>
                                            </div>
                                        </li>
                                <?php
                                    }
                                } ?>
                            </ul>

                            <div class="header-cart-total">
                                Total: <?php if (!empty($keranjang)) {
                                            echo $total_belanja;
                                        } ?>
                            </div>

                            <div class="header-cart-buttons">
                                <div class="header-cart-wrapbtn">
                                    <!-- Button -->
                                    <a href="<?= base_url('keranjang/') ?>" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                                        View Cart
                                    </a>
                                </div>

                                <div class="header-cart-wrapbtn">
                                    <!-- Button -->
                                    <a href="<?= base_url('keranjang/checkout') ?>" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                                        Check Out
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Header Mobile -->
        <div class="wrap_header_mobile">
            <!-- Logo moblie -->
            <a href="<?= base_url('index'); ?>" class="logo mx-5">
                <img src="<?= base_url('assets/img/' . $site->logo); ?>" alt="IMG-LOGO">
            </a>
            <!-- Button show menu -->
            <div class="btn-show-menu">
                <!-- Header Icon mobile -->
                <div class="header-icons-mobile">
                    <a href="#" class="header-wrapicon1 dis-block">
                        <img src="<?= base_url('assets/img/' . $site->icon); ?>" class="header-icon1" alt="ICON">
                    </a>
                    <span class="linedivide2"></span>

                    <div class="header-wrapicon2">
                        <img src="<?= base_url(); ?>assets/templates/images/icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
                        <span class="header-icons-noti">0</span>

                        <!-- Header cart noti -->
                        <div class="header-cart header-dropdown">
                            <ul class="header-cart-wrapitem">
                                <li class="header-cart-item">
                                    <div class="header-cart-item-img">
                                        <img src="<?= base_url(); ?>assets/templates/images/item-cart-01.jpg" alt="IMG">
                                    </div>

                                    <div class="header-cart-item-txt">
                                        <a href="#" class="header-cart-item-name">
                                            White Shirt With Pleat Detail Back
                                        </a>

                                        <span class="header-cart-item-info">
                                            1 x $19.00
                                        </span>
                                    </div>
                                </li>

                                <li class="header-cart-item">
                                    <div class="header-cart-item-img">
                                        <img src="<?= base_url(); ?>assets/templates/images/item-cart-02.jpg" alt="IMG">
                                    </div>

                                    <div class="header-cart-item-txt">
                                        <a href="#" class="header-cart-item-name">
                                            Converse All Star Hi Black Canvas
                                        </a>

                                        <span class="header-cart-item-info">
                                            1 x $39.00
                                        </span>
                                    </div>
                                </li>

                                <li class="header-cart-item">
                                    <div class="header-cart-item-img">
                                        <img src="<?= base_url(); ?>assets/templates/images/item-cart-03.jpg" alt="IMG">
                                    </div>

                                    <div class="header-cart-item-txt">
                                        <a href="#" class="header-cart-item-name">
                                            Nixon Porter Leather Watch In Tan
                                        </a>

                                        <span class="header-cart-item-info">
                                            1 x $17.00
                                        </span>
                                    </div>
                                </li>
                            </ul>

                            <div class="header-cart-total">
                                Total: $75.00
                            </div>

                            <div class="header-cart-buttons">
                                <div class="header-cart-wrapbtn">
                                    <!-- Button -->
                                    <a href="cart.html" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                                        View Cart
                                    </a>
                                </div>

                                <div class="header-cart-wrapbtn">
                                    <!-- Button -->
                                    <a href="#" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                                        Check Out
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </div>
            </div>
        </div>

        <!-- Menu Mobile -->
        <div class="wrap-side-menu">
            <nav class="side-menu">
                <ul class="main-menu">
                    <li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
                        <span class="topbar-child1">
                            <?= $site->telepon ?>
                        </span>
                    </li>

                    <li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
                        <div class="topbar-child2-mobile">
                            <span class="topbar-email">
                                <?= $site->email ?>
                            </span>
                        </div>
                    </li>

                    <li class="item-topbar-mobile p-l-10">
                        <div class="topbar-social-mobile">
                            <a href="<?= $site->facebook ?>" class="topbar-social-item fa fa-facebook"></a>
                            <a href="<?= $site->instagram ?>" class="topbar-social-item fa fa-instagram"></a>
                        </div>
                    </li>

                    <li class="item-menu-mobile">
                        <a href="<?= base_url('index'); ?>">Beranda</a>
                    </li>

                    <li class="item-menu-mobile">
                        <a href="<?= base_url('produk'); ?>">Produk &amp; Belanja</a>
                        <ul class="sub-menu">
                            <?php foreach ($nav_mobile as $nav_mobile) { ?>
                                <li class="nav-item"><a href="<?= base_url('produk/' . $nav_mobile->url) ?>">
                                        <?= $nav_mobile->nama_kategori ?></a></li>
                            <?php } ?>
                        </ul>
                        <i class="arrow-main-menu fa fa-angle-right" aria-hidden="true"></i>
                    </li>

                    <li class="item-menu-mobile">
                        <a href="<?= base_url('about'); ?>">Tentang</a>
                    </li>

                    <li class="item-menu-mobile">
                        <a href="<?= base_url('contact'); ?>">Kontak</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- rendering view -->
    <?= $this->renderSection('content'); ?>

    <?php
    $nav_produk = new \App\Models\Produk_model();
    $nav_mobile = new \App\Models\Produk_model();
    $site = new \App\Models\Konfigurasi_model();
    $nav_produk = $nav_produk->nav_produk();
    $nav_mobile = $nav_mobile->nav_produk();
    $site = $site->get_all();
    ?>
    <!-- Footer -->
    <footer class="bg6 p-t-45 p-b-43 p-l-45 p-r-45">
        <div class="flex-w p-b-90">
            <div class="w-size6 p-t-30 p-l-15 p-r-15 respon3">
                <h4 class="s-text12 p-b-30">
                    Kontak Kami
                </h4>

                <div>
                    <p class="s-text7 w-size27">
                        <?= $site->alamat ?>
                        <br><i class="fa fa-envelope"></i> <?= $site->email ?>
                        <br><i class="fa fa-phone"></i> <?= $site->telepon ?>
                    </p>

                    <div class="flex-m p-t-30">
                        <a href="<?= $site->facebook ?>" target="_blank" class="fs-18 color1 p-r-20 fa fa-facebook"></a>
                        <a href="<?= $site->instagram ?>" target="_blank" class="fs-18 color1 p-r-20 fa fa-instagram"></a>
                    </div>
                </div>
            </div>

            <div class="w-size7 p-t-30 p-l-15 p-r-15 respon4">

            </div>

            <div class="w-size7 p-t-30 p-l-15 p-r-15 respon4">
                <h4 class="s-text12 p-b-30">
                    Kategori
                </h4>

                <ul>
                    <?php foreach ($nav_produk as $nav_produk) { ?>
                        <li class="p-b-9">
                            <a href="<?= base_url('produk/kategori/' . $nav_produk->url); ?>" class="s-text7">
                                <?= $nav_produk->nama_kategori ?>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>



            <div class="w-size7 p-t-30 p-l-15 p-r-15 respon4">
                <h4 class="s-text12 p-b-30">
                    Links
                </h4>

                <ul>

                    <li class="p-b-9">
                        <a href="<?= base_url('tentang'); ?>" class="s-text7">
                            Tentang
                        </a>
                    </li>

                    <li class="p-b-9">
                        <a href="<?= base_url('kontak'); ?>" class="s-text7">
                            Kontak
                        </a>
                    </li>
                </ul>
            </div>

            <div class="w-size8 p-t-30 p-l-15 p-r-15 respon3">
                <h4 class="s-text12 p-b-30">
                    Newsletter
                </h4>

                <form>
                    <div class="effect1 w-size9">
                        <input class="s-text7 bg6 w-full p-b-5" type="text" name="email" placeholder="E-mail">
                        <span class="effect1-line"></span>
                    </div>

                    <div class="w-size2 p-t-20">
                        <!-- Button -->
                        <button class="flex-c-m size2 bg4 bo-rad-23 hov1 m-text3 trans-0-4">
                            Subscribe
                        </button>
                    </div>

                </form>
            </div>
        </div>

        <div class="t-center p-l-15 p-r-15">
            <div class="t-center s-text8 p-t-20">
                &copy;<script>
                    document.write(new Date().getFullYear());
                </script> MJGarage <i class="fa fa-heart" aria-hidden="true"></i> by
                <a href="#" target="_blank">Rizki</a>
            </div>
        </div>
    </footer>

    <!-- Back to top -->
    <div class="btn-back-to-top bg0-hov" id="myBtn">
        <span class="symbol-btn-back-to-top">
            <i class="fa fa-angle-double-up" aria-hidden="true"></i>
        </span>
    </div>

    <!-- Container Selection1 -->
    <div id="dropDownSelect1"></div>



    <!--===============================================================================================-->
    <script type="text/javascript" src="<?= base_url(); ?>assets/templates/vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script type="text/javascript" src="<?= base_url(); ?>assets/templates/vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script type="text/javascript" src="<?= base_url(); ?>assets/templates/vendor/bootstrap/js/popper.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>assets/templates/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script type="text/javascript" src="<?= base_url(); ?>assets/templates/vendor/select2/select2.min.js"></script>
    <script type="text/javascript">
        $(".selection-1").select2({
            minimumResultsForSearch: 20,
            dropdownParent: $('#dropDownSelect1')
        });
    </script>
    <!--===============================================================================================-->
    <script type="text/javascript" src="<?= base_url(); ?>assets/templates/vendor/slick/slick.min.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>assets/templates/js/slick-custom.js"></script>
    <!--===============================================================================================-->
    <script type="text/javascript" src="<?= base_url(); ?>assets/templates/vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
    <script type="text/javascript" src="<?= base_url(); ?>assets/templates/vendor/lightbox2/js/lightbox.min.js"></script>
    <!--===============================================================================================-->
    <script type="text/javascript" src="<?= base_url(); ?>assets/templates/vendor/sweetalert/sweetalert.min.js"></script>
    <script type="text/javascript">
        $('.block2-btn-addcart').each(function() {
            var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
            $(this).on('click', function() {
                swal(nameProduct, "is added to cart !", "success");
            });
        });

        $('.block2-btn-addwishlist').each(function() {
            var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
            $(this).on('click', function() {
                swal(nameProduct, "is added to wishlist !", "success");
            });
        });
    </script>

    <!--===============================================================================================-->
    <script src="<?= base_url(); ?>assets/templates/js/main.js"></script>

</body>

</html>