<?php
session_start();
include './src/connect.php';
include './src/control.php';
include './src/cart.php';
include './src/product.php';

if (empty($_GET['id']) || !Product::is_exist($_GET['id'])) {
  header('Location: product.php');
  exit();
}

$result_list_product = Product::select("id={$_GET['id']}");
$product = mysqli_fetch_assoc($result_list_product);
// Bat dau cart
$cart = new Cart();

if (isset($_POST['submit_cart'])) {
  switch ($_POST['action']) {
    case 'add':
      $cart->add($_POST['id'], isset($_POST['quantity']) ? $_POST['quantity'] : 1);
      break;
    case 'remove':
      $cart->remove($_POST['id']);
      break;
    default:
      break;
  }
  if (!empty($_SERVER['HTTP_REFERER'])) {
    header("Location: {$_SERVER['HTTP_REFERER']}", true, 303);
  }
  else {
    header("Location: /", true, 303);
  }
}
// Ket thuc cart

?>

<html class="no-js" lang="vi">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0,
      user-scalable=0" name="viewport">
  <meta name="revisit-after" content="1 day">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="HandheldFriendly" content="true">
  <title> Sản phẩm </title>
  <link rel="stylesheet" href="plugins/bootstrap/bootstrap.min.css">



  <link rel="stylesheet" href="plugins/animate/animate.min.css">

  <link rel="stylesheet" href="plugins/fontawesome/all.css">

  <link href="plugins/webfonts/font.css" rel="stylesheet">
  <link rel="stylesheet" href="plugins/owl.carousel/owl.carousel.min.css" type="text/css">
  <link rel="stylesheet" href="plugins/owl.carousel/owl.theme.default.min.css">
  <!-- UIkit CSS -->
  <link rel="stylesheet" href="plugins/uikit/uikit.min.css" />
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>

  <!--Navbar-->

  <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">

    <div class="container">
      <a class="navbar-brand" href="index.html">
        <img src="images/logo.png" class="logo-top" alt="">
      </a>
      <div class="desk-menu collapse navbar-collapse justify-content-md-center" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="index.php">TRANG CHỦ</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="product.php">BỘ SƯU TẬP</a>
          </li>
          <li class="nav-item active lisanpham">
            <a class="nav-link " href="detailproduct.php">SẢN PHẨM
              <i class="fa fa-chevron-down" aria-hidden="true"></i>
            </a>
            <!-- <ul class="sub_menu">
              <li class="">
                <a href="detailproduct.html" title="Sản phẩm - Style 1">
                  Sản phẩm - Style 1
                </a>
              </li>
              <li class="">
                <a href="detailproduct.html" title="Sản phẩm - Style 2">
                  Sản phẩm - Style 2
                </a>
              </li>
              <li class="">
                <a href="detailproduct.html" title="Sản phẩm - Style 3">
                  Sản phẩm - Style 3
                </a>
              </li>
            </ul> -->
            <ul class="sub_menu">
              <?php 
                $r = Product::query('SELECT * FROM products LIMIT 3');
                while ($prod = mysqli_fetch_assoc($r)) {
                  echo "
                    <li class=''>
                      <a href='detailproduct.php?id={$prod['id']}' title='{$prod['name']}'> 
                      {$prod['name']}
                      </a>
                    </li>
                  ";
                }
              ?>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="introduce.html">GIỚI THIỆU</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="blog.html">BLOG</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Contact.html">LIÊN HỆ</a>
          </li>
        </ul>
      </div>
      <div id="offcanvas-flip1" uk-offcanvas="flip: true; overlay: true">
        <div class="uk-offcanvas-bar" style="background: white;
          width: 100%;">

          <button class="uk-offcanvas-close" style="color:#272727" type="button" uk-close></button>
          <h3 style="font-size: 14px;
            color: #272727;
            text-transform: uppercase;
            margin: 3px 0 30px 0;
            font-weight: 500; letter-spacing: 2px;">MENU</h3>
          <div class="justify-content-md-center">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="index.html">TRANG CHỦ</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="Product.html">BỘ SƯU TẬP</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle aaaa" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <p>SẢN PHẨM</p>
                  <i class="fa fa-angle-double-right"></i>

                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="border:0;">
                  <a class="dropdown-item" href="detailproduct.html" title="Sản phẩm - Style 1">Sản phẩm - Style 1</a>
                  <a class="dropdown-item" href="detailproduct.html" title="Sản phẩm - Style 2">Sản phẩm - Style 2</a>
                  <a class="dropdown-item" href="detailproduct.html" title="Sản phẩm - Style 3">Sản phẩm - Style 3</a>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="introduce.html">GIỚI THIỆU</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="blog.html">BLOG</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="Contact.html">LIÊN HỆ</a>
              </li>
            </ul>
          </div>

        </div>
      </div>
      <div id="offcanvas-flip" uk-offcanvas="flip: true; overlay: true">
        <div class="uk-offcanvas-bar" style="    background: white;
              width: 350px;">

          <button class="uk-offcanvas-close" style="color:#272727" type="button" uk-close></button>

          <h3 style="font-size: 14px;
                  color: #272727;
                  text-transform: uppercase;
                  margin: 3px 0 30px 0;
                  font-weight: 500; letter-spacing: 2px;">Tìm kiếm</h3>
          <div class="search-box wpo-wrapper-search">
          <form action="product.php" class="searchform searchform-categoris ultimate-search">
              <div class="wpo-search-inner" style="display:inline">
                <input required="" id="inputSearchAuto" name="search" maxlength="40" autocomplete="off"
                  class="searchinput input-search search-input" type="text" size="20"
                  placeholder="Tìm kiếm sản phẩm...">
              </div>
              <button type="submit" class="btn-search btn" id="search-header-btn">
                <i style="font-weight:bold" class="fas fa-search"></i>
              </button>
            </form>
            <div id="ajaxSearchResults" class="smart-search-wrapper ajaxSearchResults" style="display: none">
              <div class="resultsContent"></div>
            </div>
          </div>
        </div>
      </div>
      <div id="offcanvas-flip2" uk-offcanvas="flip: true; overlay: true">
        <div class="uk-offcanvas-bar" style="    background: white;
              width: 350px;">

          <button class="uk-offcanvas-close" style="color:#272727" type="button" uk-close></button>


          <h3 style="font-size: 14px;
                  color: #272727;
                  text-transform: uppercase;
                  margin: 3px 0 30px 0;
                  font-weight: 500; letter-spacing: 2px;">Giỏ hàng</h3>
          <div class="site-nav-container-last" style="color:#272727">
            <div class="cart-view clearfix">
              <table id="cart-view">
                <tbody>
                  <?php
                  $cart->foreach_product(function ($is_error, $product, $quantity) {
                    if (!$is_error) {
                      $totalprice = Product::format_price($product['price'] * $quantity);
                      echo "<tr class=\"item_1\">
                        <td class=\"img\"><a href=\"detailproduct.php?id={$product['id']}\" title=\"{$product['name']}\"><img src=\"{$product['imgsrc1']}\" alt=\"{$product['name']}\"></a></td>
                        <td>
                          <a class=\"pro-title-view\" style=\"color: #272727\" href=\"javascript:void(0)\" title=\"{$product['name']}\">{$product['name']}</a>
                          <!-- <span class=\"variant\">Tím / 36</span> -->
                          <span class=\"pro-quantity-view\">$quantity</span>
                          <span class=\"pro-price-view\">{$totalprice}₫</span>
                          <form method='POST'>
                            <input type=\"hidden\" name=\"action\" value=\"remove\">
                            <input type=\"hidden\" name=\"id\" value=\"{$product['id']}\">
                            <span class=\"remove_link remove-cart\"><button style=\"background: none;border: none;\" type=\"submit\" name=\"submit_cart\" value=\"remove\"><i style=\"color: #272727;\" class=\"fas fa-times\"></i></button></span>
                          </form>
                          </td>
                      </tr>";
                    }
                  });
                  ?>
                </tbody>
              </table>
              <span class="line"></span>
              <table class="table-total">
                <tbody>
                  <tr>
                    <td class="text-left">TỔNG TIỀN:</td>
                    <td class="text-right" id="total-view-cart"><?= Product::format_price($cart->total()) ?></td>
                  </tr>
                  <tr>
                    <td class="distance-td"><a href="" class="linktocart button dark" style="color: #fff;">Xem giỏ hàng</a></td>
                    <td><a href="mail.php" class="linktocheckout button dark <?php echo empty($_SESSION['cart']) ? "disabled" : "" ?>" style="color: #fff;">Thanh toán</a></td>
                  </tr>
                </tbody>
              </table>

              <a href="" target="_blank" class="button btn-check" style="text-decoration:none;"><span>Click nhận mã giảm
                  giá ngay !</span></a>
            </div>
          </div>
        </div>
      </div>

      <div class="icon-ol">
        <a style="color: #272727" href="profile.php">
          <i class="fas fa-user-alt"></i>
        </a>
        <a href="#" class="" uk-toggle="target: #offcanvas-flip">
          <i class="fas fa-search" style="color: black"></i>
        </a>

        <a style="color: #272727" href="#" uk-toggle="target: #offcanvas-flip2">
          <i class="fas fa-shopping-cart"></i>
        </a>
        <button class="navbar-toggler" type="button" uk-toggle="target: #offcanvas-flip1" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
    </div>
    </div>

  </nav>
  <!--  detail product -->
  <main class="">

    <div id="product" class="productDetail-page">

      <!--  menu header seo -->
      <div class="breadcrumb-shop">
        <div class="container">
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pd5">
              <ol class="breadcrumb breadcrumb-arrows">
                <li>
                  <a href="index.php">
                    <span">Trang chủ</span>
                  </a>
                </li>
                <li>
                  <a href="product.php">
                    <span>Sản phẩm</span>
                  </a>
                </li>
                <li class="active">
                  <span>
                    <span itemprop="name"><?php echo $product['name']; ?></span>
                  </span>
                  <meta itemprop="position" content="3">
                </li>

              </ol>
            </div>
          </div>
        </div>
      </div>
      <!-- detail product chính -->
      <div class="container">
        <div class="row product-detail-wrapper">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="row product-detail-main pr_style_01">
              <div class="col-md-7 col-sm-12 col-xs-12">
                <div class="product-gallery">
                  <div class="product-gallery__thumbs-container hidden-sm
                    hidden-xs">
                    <div class="product-gallery__thumbs thumb-fix">

                      <?php
                      echo "<div class=\"product-gallery__thumb  active\" id=\"imgg1\">
                        <a class=\"product-gallery__thumb-placeholder\" href=\"javascript:void(0);\"
                          data-image=\"{$product['imgsrc1']}\" data-zoom-image=\"{$product['imgsrc1']}\">
                          <img src=\"{$product['imgsrc1']}\" data-image=\"{$product['imgsrc1']}\"
                            alt=\"{$product['name']}\" grape=\"\">
                        </a>
                      </div>
                      <div class=\"product-gallery__thumb \" id=\"imgg2\">
                        <a class=\"product-gallery__thumb-placeholder\" href=\"javascript:void(0);\"
                          data-image=\"{$product['imgsrc2']}\" data-zoom-image=\"{$product['imgsrc2']}\">
                          <img src=\"{$product['imgsrc2']}\" data-image=\"{$product['imgsrc2']}\"
                            alt=\"{$product['name']}\" grape=\"\">
                        </a>
                      </div>
                      ";
                      ?>
                    </div>
                  </div>
                  <div class="product-image-detail box__product-gallery
                    scroll hidden-xs">
                    <ul id="sliderproduct" class="site-box-content
                      slide_product">

                      <?php
                      echo "<li class=\"product-gallery-item gallery-item
                      current \" id=\"imgg1a\">
                      <img class=\"product-image-feature \" src=\"{$product['imgsrc1']}\"
                        alt=\"{$product['name']}\" grape=\"\">
                    </li>
                    <li class=\"product-gallery-item gallery-item
                      current \" id=\"imgg2a\">
                      <img class=\"product-image-feature \" src=\"{$product['imgsrc2']}\"
                        alt=\"{$product['name']}\" grape=\"\">
                    </li>
                    ";
                      ?>
                    </ul>
                    <div class="product-image__button">
                      <div id="product-zoom-in" class="product-zoom
                        icon-pr-fix" aria-label="Zoom in" title="Zoom in">
                        <span class="zoom-in" aria-hidden="true">
                          <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 36 36" style="enable-background:new 0 0 36 36; width:
                            30px; height: 30px;" xml:space="preserve">
                            <polyline points="6,14 9,11 14,16 16,14 11,9
                              14,6 6,6">
                            </polyline>
                            <polyline points="22,6 25,9 20,14 22,16 27,11
                              30,14 30,6">
                            </polyline>
                            <polyline points="30,22 27,25 22,20 20,22
                              25,27 22,30 30,30">
                            </polyline>
                            <polyline points="14,30 11,27 16,22 14,20 9,25
                              6,22 6,30">
                            </polyline>
                          </svg>
                        </span>
                      </div>
                      <div class="gallery-index icon-pr-fix"><span class="current">1</span>
                        / <span class="total">8</span></div>
                    </div>
                  </div>
                </div>
                <div class="product-gallery-slide">
                  <div class="owl-carousel owl-theme owl-product-gallery-slide"">
                    <div class=" item">
                    <div class="product-gallery__thumb  >
                      <a class=" product-gallery__thumb-placeholder" href="javascript:void(0);" data-image="images/detailproduct/1.jpg" data-zoom-image="images/detailproduct/1.jpg">
                      <img src="images/detailproduct/1.jpg" data-image="images/detailproduct/1.jpg" alt="Nike Air Max 90 Essential" grape="">
                      </a>
                    </div>
                  </div>
                  <div class="item">
                    <div class="product-gallery__thumb  >
                      <a class=" product-gallery__thumb-placeholder" href="javascript:void(0);" data-image="images/detailproduct/2.jpg" data-zoom-image="images/detailproduct/2.jpg">
                      <img src="images/detailproduct/2.jpg" data-image="images/detailproduct/2.jpg" alt="Nike Air Max 90 Essential" grape="">
                      </a>
                    </div>
                  </div>
                  <div class="item">
                    <div class="product-gallery__thumb  >
                      <a class=" product-gallery__thumb-placeholder" href="javascript:void(0);" data-image="images/detailproduct/3.jpg" data-zoom-image="images/detailproduct/3.jpg">
                      <img src="images/detailproduct/3.jpg" data-image="images/detailproduct/3.jpg" alt="Nike Air Max 90 Essential" grape="">
                      </a>
                    </div>
                  </div>
                  <div class="item">
                    <div class="product-gallery__thumb  >
                      <a class=" product-gallery__thumb-placeholder" href="javascript:void(0);" data-image="images/detailproduct/4.jpg" data-zoom-image="images/detailproduct/4.jpg">
                      <img src="images/detailproduct/4.jpg" data-image="images/detailproduct/4.jpg" alt="Nike Air Max 90 Essential" grape="">
                      </a>
                    </div>
                  </div>
                  <div class="item">
                    <div class="product-gallery__thumb  >
                      <a class=" product-gallery__thumb-placeholder" href="javascript:void(0);" data-image="images/detailproduct/5.jpg" data-zoom-image="images/detailproduct/5.jpg">
                      <img src="images/detailproduct/5.jpg" data-image="images/detailproduct/5.jpg" alt="Nike Air Max 90 Essential" grape="">
                      </a>
                    </div>
                  </div>
                  <div class="item">
                    <div class="product-gallery__thumb  " id="imgg1">
                      <a class="product-gallery__thumb-placeholder" href="javascript:void(0);" data-image="images/detailproduct/6.jpg" data-zoom-image="images/detailproduct/6.jpg">
                        <img src="images/detailproduct/6.jpg" data-image="images/detailproduct/6.jpg" alt="Nike Air Max 90 Essential" grape="">
                      </a>
                    </div>
                  </div>
                  <div class="item">
                    <div class="product-gallery__thumb  " id="imgg1">
                      <a class="product-gallery__thumb-placeholder" href="javascript:void(0);" data-image="images/detailproduct/7.jpg" data-zoom-image="images/detailproduct/7.jpg">
                        <img src="images/detailproduct/7.jpg" data-image="images/detailproduct/7.jpg" alt="Nike Air Max 90 Essential" grape="">
                      </a>
                    </div>
                  </div>
                  <div class="item">
                    <div class="product-gallery__thumb  " id="imgg1">
                      <a class="product-gallery__thumb-placeholder" href="javascript:void(0);" data-image="images/detailproduct/8.jpg" data-zoom-image="images/detailproduct/8.jpg">
                        <img src="images/detailproduct/8.jpg" data-image="images/detailproduct/8.jpg" alt="Nike Air Max 90 Essential" grape="">
                      </a>
                    </div>
                  </div>

                </div>
              </div>
              <!-- Flickity HTML init -->

              <!-- <div id="product-zoom-in" class="product-zoom icon-pr-fix
                  hidden-md hidden-sm" style="padding-top:2rem;"
                  aria-label="Zoom in" title="Zoom in">
                  <span class="zoom-in" aria-hidden="true">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                      xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
                      y="0px"
                      viewBox="0 0 36 36"
                      style="enable-background:new 0 0 36 36; width: 40px;
                      height: 40px;"
                      xml:space="preserve">
                      <polyline points="6,14 9,11 14,16 16,14 11,9 14,6
                        6,6">
                      </polyline>
                      <polyline points="22,6 25,9 20,14 22,16 27,11 30,14
                        30,6">
                      </polyline>
                      <polyline points="30,22 27,25 22,20 20,22 25,27
                        22,30 30,30">
                      </polyline>
                      <polyline points="14,30 11,27 16,22 14,20 9,25 6,22
                        6,30">
                      </polyline>
                    </svg>
                  </span>
                </div> -->
            </div>
            <div class="col-md-5 col-sm-12 col-xs-12
                product-content-desc" id="detail-product">
              <div class="product-content-desc-1">
                <div class="product-title">
                  <h1><?= $product['name'] ?></h1>
                  <span id="pro_sku">SKU: S-0015-<?php echo $product['id']; ?></span>
                </div>
                <div class="product-price" id="price-preview"><span class="pro-price"><?php echo Product::format_price($product['price']); ?>₫</span></div>
                <form id="add-item-form" method="POST" class="variants clearfix">
                  <!-- <div class="select clearfix">
                    <div class="selector-wrapper"><label for="product-select-option-0">Màu sắc</label><span
                        class="custom-dropdown custom-dropdown--white"><select class="single-option-selector
                            custom-dropdown__select
                            custom-dropdown__select--white" data-option="option1" id="product-select-option-0">
                          <option value="Tím">Tím</option>
                          <option value="Xanh">Xanh</option>
                        </select></span></div>
                    <div class="selector-wrapper"><label for="product-select-option-1">Kích thước</label><span
                        class="custom-dropdown custom-dropdown--white"><select class="single-option-selector
                            custom-dropdown__select
                            custom-dropdown__select--white" data-option="option2" id="product-select-option-1">
                          <option value="36">36</option>
                          <option value="37">37</option>
                          <option value="38">38</option>
                          <option value="35">35</option>
                        </select></span></div><select id="product-select" name="id" style="display:none;">

                      <option value="1040377813">Tím / 36 - 4,800,000₫</option>
                      <option value="1040377814">Tím / 37 - 4,800,000₫</option>
                      <option value="1040377815">Tím / 38 - 4,800,000₫</option>
                      <option value="1040409049">Xanh / 35 - 4,800,000₫</option>
                      <option value="1040409050">Xanh / 36 - 4,800,000₫</option>
                      <option value="1040409053">Xanh / 37 - 4,800,000₫</option>
                      <option value="1040409054">Xanh / 38 - 4,800,000₫</option>
                    </select>
                  </div> -->
                  <!-- <div class="select-swatch clearfix">
                    <div id="variant-swatch-0" class="swatch clearfix" data-option="option1" data-option-index="0">


                      <div class="header" style="background: white;
                          color: #272727;"><span>Tím</span></div>

                      <div class="select-swap">
                        <div data-value="Tím" class="n-sd swatch-element
                            color tim">
                          <input class="variant-0" id="swatch-0-tim" type="radio" name="option1" value="Tím"
                            data-vhandle="tim" checked="">
                          <label class="tim sd" for="swatch-0-tim">
                            <span>Tím</span>
                          </label>

                        </div>
                        <div data-value="Xanh" class="n-sd swatch-element
                            color xanh">
                          <input class="variant-0" id="swatch-0-xanh" type="radio" name="option1" value="Xanh"
                            data-vhandle="xanh">


                          <label class="xanh" for="swatch-0-xanh">
                            <span>Xanh</span>
                          </label>

                        </div>
                      </div>
                    </div>
                    <div id="variant-swatch-1" class="swatch clearfix" data-option="option2" data-option-index="1">


                      <div class="select-swap">
                        <div data-value="36" class="n-sd swatch-element
                            36">
                          <input class="variant-1" id="swatch-1-36" type="radio" name="option2" value="36"
                            data-vhandle="36" checked="">

                          <label for="swatch-1-36" class="sd">
                            <span>36</span>
                          </label>

                        </div>
                        <div data-value="37" class="n-sd swatch-element
                            37">
                          <input class="variant-1" id="swatch-1-37" type="radio" name="option2" value="37"
                            data-vhandle="37">

                          <label for="swatch-1-37">
                            <span>37</span>
                          </label>

                        </div>
                        <div data-value="38" class="n-sd swatch-element
                            38">
                          <input class="variant-1" id="swatch-1-38" type="radio" name="option2" value="38"
                            data-vhandle="38">

                          <label for="swatch-1-38">
                            <span>38</span>
                          </label>

                        </div>
                        <div data-value="35" class="n-sd swatch-element 35
                            soldout">
                          <input class="variant-1" id="swatch-1-35" type="radio" name="option2" value="35"
                            data-vhandle="35" disabled="">

                          <label for="swatch-1-35">
                            <span>35</span>
                          </label>

                        </div>
                      </div>
                    </div>
                  </div> -->
                  <!-- <div class="selector-actions">
                    <div class="quantity-area clearfix">
                      <input type="button" value="-" onclick="minusQuantity()" class="qty-btn">
                      <input type="text" id="quantity" name="quantity" value="1" min="1" class="quantity-selector">
                      <input type="button" value="+" onclick="plusQuantity()" class="qty-btn">
                    </div>
                    <div class="wrap-addcart clearfix">
                      <div class="row-flex">
                        <button type="button" class="button btn-addtocart addtocart-modal">Thêm
                          vào</button>
                        <button type="button" class="buy-now button" style="display: block;">Mua
                          ngay</button>

                      </div>

                      <a href="" target="_blank" class="button btn-check"
                        style="color: #ffffff;text-decoration:none;"><span>Click
                          nhận mã giảm giá ngay
                          !</span></a>

                    </div>
                  </div> -->
                  <div class="selector-actions">
                    <div class="quantity-area clearfix">
                      <input type="button" value="-" onclick="minusQuantity()" class="qty-btn">
                      <input type="text" id="quantity" name="quantity" value="1" min="1" class="quantity-selector">
                      <input type="button" value="+" onclick="plusQuantity()" class="qty-btn">
                    </div>
                    <input type="hidden" name="action" value="add">
                    <input type="hidden" name="id" value="<?= $product['id'] ?>">
                    <button type="submit" value="submit_cart" name="submit_cart" id="add-to-cartbottom" class="add-to-cartProduct add-cart-bottom button addtocart-modal" name="add">Thêm vào
                      giỏ</button>
                  </div>
                </form>
                <div class="product-description">
                  <div class="title-bl">
                    <h2>Mô tả</h2>
                  </div>
                  <div class="description-content">
                    <div class="description-productdetail">
                      <p><span>Hiện đại và thời trang khi diện item mới
                          của Nike. Màu sắc lạ mắt, chất liệu
                          thoáng mát, nhẹ nhàng, phù hợp với những chàng
                          trai yêu phong cách
                          sports.</span><br><br></p>
                      <ul>
                        <li>Chất liệu cao cấp EVA, PU, Cushlon, Phylon.</li>
                        <li>Bền, chống bám bẩn, dễ dàng lau chùi. Mũi giày
                          đầy đặn, form dáng chuẩn.</li>
                        <li>Bảo vệ đầu ngón chân khi hoạt động. Có lớp lót
                          đệm bên trong.</li>
                        <li>Êm, di chuyển nhiều không bị đau chân. Cổ giày
                          thiết kế đơn giản, vừa vặn.</li>
                        <li>Di chuyển dễ dàng, thoải mái.</li>
                        <li>Đế bằng chất liệu cao su<br></li>
                        <li>Êm ái, độ bám tốt, chống trơn trượt.</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="list-productRelated clearfix">
            <div class="heading-title text-center">
              <h2>Sản phẩm liên quan</h2>
            </div>
            <div class="container">
              <div class="row">
              <?php 
          $r = Product::query('SELECT * FROM products LIMIT 4');
          while ($prod = mysqli_fetch_assoc($r)) {
            $price = Product::format_price($prod['price']);
            echo "<div class=\"col-md-3 col-sm-6 col-xs-6 col-6\">
            <div class=\"product-block\">
              <div class=\"product-img fade-box\">
                <a href=\"detailproduct.php?id={$prod['id']}\" title=\"{$prod['name']}\" class=\"img-resize\">
                  <img
                    src=\"{$prod['imgsrc1']}\"
                    alt=\"{$prod['name']}\" class=\"lazyloaded\">
                  <img
                    src=\"{$prod['imgsrc2']}\"
                    alt=\"{$prod['name']}\" class=\"lazyloaded\">
                </a>
                
              </div>
              <div class=\"product-detail clearfix\">
                <div class=\"pro-text\">
                  <a style=\" color: black;
                                                          font-size: 14px;text-decoration: none;\" href=\"#\"
                    title=\"{$prod['name']}\" inspiration pack>
                    {$prod['name']}
                  </a>
                </div>
                <div class=\"pro-price\">
                  <p>{$price}₫</p>
                </div>
              </div>
            </div>
          </div>";
          }
          ?>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
    </div>


    <!-- show zoom detail product -->
    <!-- zoom -->
    <div class="product-zoom11">
      <div class="product-zom">
        <div class="divclose">
          <i class="fa fa-times-circle"></i>
        </div>
        <div class="owl-carousel owl-theme owl-product1">

          <div class="item"><img src="images/detailproduct/1.jpg" alt="">
          </div>
          <div class="item"><img src="images/detailproduct/2.jpg" alt="">
          </div>
          <div class="item"><img src="images/detailproduct/3.jpg" alt="">
          </div>
          <div class="item"><img src="images/detailproduct/4.jpg" alt="">
          </div>
          <div class="item"><img src="images/detailproduct/5.jpg" alt="">
          </div>
          <div class="item"><img src="images/detailproduct/6.jpg" alt="">
          </div>
          <div class="item"><img src="images/detailproduct/7.jpg" alt="">
          </div>
          <div class="item"><img src="images/detailproduct/8.jpg" alt="">
          </div>



        </div>
      </div>
    </div>

  </main>
  <!--gallery-->
  <section class="section section-gallery">
    <div class="">
      <div class="hot_sp" style="padding-top: 70px;padding-bottom: 50px;">
        <h2 style="text-align:center;padding-top: 10px">
          <a style="font-size: 28px;color: black;text-decoration: none" href="">Khách hàng và Runner Inn</a>
        </h2>
      </div>
      <div class="list-gallery clearfix">
        <ul class="shoes-gp">
          <li>
            <div class="gallery_item">
              <img class="img-resize" src="images/shoes/gallery_item_1.jpg" alt="">
            </div>
          </li>
          <li>
            <div class="gallery_item">
              <img class="img-resize" src="images/shoes/gallery_item_2.jpg" alt="">
            </div>
          </li>
          <li>
            <div class="gallery_item">
              <img class="img-resize" src="images/shoes/gallery_item_3.jpg" alt="">
            </div>
          </li>
          <li>
            <div class="gallery_item">
              <img class="img-resize" src="images/shoes/gallery_item_4.jpg" alt="">
            </div>
          </li>
          <li>
            <div class="gallery_item">
              <img class="img-resize" src="images/shoes/gallery_item_5.jpg" alt="">
            </div>
          </li>
          <li>
            <div class="gallery_item">
              <img class="img-resize" src="images/shoes/gallery_item_6.jpg" alt="">
            </div>
          </li>
        </ul>
      </div>
    </div>
  </section>



  <!-- footer -->

  <footer class="main-footer">
    
  </footer>
  <script async defer crossorigin="anonymous" src="plugins/sdk.js"></script>
  <script src="plugins/jquery-3.4.1/jquery-3.4.1.min.js"></script>
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
  <script src="plugins/bootstrap/popper.min.js"></script>
  <script src="plugins/bootstrap/bootstrap.min.js"></script>
  <script src="plugins/owl.carousel/owl.carousel.min.js"></script>
  <script src="plugins/uikit/uikit.min.js"></script>
  <script src="plugins/uikit/uikit-icons.min.js"></script>
  <script src="js/script.js"></script>
  <script src="js/home.js"></script>
  <!-- <script src="js/divzoom.js"></script> -->
</body>

</html>