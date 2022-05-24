<?php 
session_start();
include './src/connect.php';
include './src/control.php';
include './src/cart.php';
include './src/product.php';
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
$_SESSION['mail_success'] = 0;

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="plugins/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="plugins/animate/animate.min.css">
  <link rel="stylesheet" href="plugins/fontawesome/all.css">
  <link rel="stylesheet" href="plugins/webfonts/font.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css" type="text/css">
  <link rel="stylesheet" type="text/css" href="css/style.css">

  
  <link rel="stylesheet" href="plugins/uikit/uikit.min.css" />

  <title>Runner</title>

</head>

<body>
  

  <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">

    <div class="container">
      <a class="navbar-brand" href="index.php">
        <img src="images/logo.png" class="logo-top" alt="">
      </a>
      <div class="desk-menu collapse navbar-collapse justify-content-md-center" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="#">TRANG CHỦ</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="product.php">BỘ SƯU TẬP</a>
          </li>
          <li class="nav-item lisanpham">
            <a class="nav-link" href="detailproduct.php">SẢN PHẨM
              <i class="fa fa-chevron-down" aria-hidden="true"></i>
            </a>
            <ul class="sub_menu">
              <?php 
                $result = Product::query('SELECT * FROM products LIMIT 3');
                while ($product = mysqli_fetch_assoc($result)) {
                  echo "
                    <li class=''>
                      <a href='detailproduct.php?id={$product['id']}' title='{$product['name']}'> 
                      {$product['name']}
                      </a>
                    </li>
                  ";
                }
              ?>
            </ul>
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
                  <a class="nav-link" href="index.php">TRANG CHỦ</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="product.php">BỘ SƯU TẬP</a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle aaaa"  href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false" >
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
        <button class="navbar-toggler" type="button" uk-toggle="target: #offcanvas-flip1" data-target="#navbarNav"
          aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
    </div>
    </div>

  </nav>
  
  <div class="owl-carousel owl-theme owl-carousel-setting">
    <div class="item"><img src="images/slideshow_1.jpg" class="d-block w-100" alt="..."></div>
    <div class="item"><img src="images/slideshow_2.jpg" class="d-block w-100" alt="..."></div>
</div>
 
  
  <div class="content">
    <div class="container">
      <div class="hot_sp" style="padding-bottom: 10px;">
        <h2 style="text-align:center;padding-top: 10px">
          <a style="font-size: 28px;color: black;text-decoration: none" href="">Sản phẩm bán chạy</a>
        </h2>
        <div class="view-all" style="text-align:center;padding-top: -10px;">
          <a style="color: black;text-decoration: none" href="">Xem thêm</a>
        </div>
      </div>
    </div>
    
    <div class="container" style="padding-bottom: 50px;">
      <div class="row">
        <?php 
        $result = Product::query('SELECT * FROM products LIMIT 4');
          while ($row = mysqli_fetch_assoc($result)) {
            $price = Product::format_price($row['price']);
            echo "<div class=\"col-md-3 col-sm-6 col-xs-6 col-6\">
            <div class=\"product-block\">
              <div class=\"product-img fade-box\">
                <a href=\"detailproduct.php?id={$row['id']}\" title=\"{$row['name']}\" class=\"img-resize\">
                  <img
                    src=\"{$row['imgsrc1']}\"
                    alt=\"{$row['name']}\" class=\"lazyloaded\">
                  <img
                    src=\"{$row['imgsrc2']}\"
                    alt=\"{$row['name']}\" class=\"lazyloaded\">
                </a>
                
              </div>
              <div class=\"product-detail clearfix\">
                <div class=\"pro-text\">
                  <a style=\" color: black;
                                                          font-size: 14px;text-decoration: none;\" href=\"#\"
                    title=\"{$row['name']}\" inspiration pack>
                    {$row['name']}
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
      <div class="row">
        <?php 
        $result = Product::query('SELECT * FROM products LIMIT 4, 4');
        while ($row = mysqli_fetch_assoc($result)) {
          $price = Product::format_price($row['price']);
          echo "<div class=\"col-md-3 col-sm-6 col-xs-6 col-6\">
          <div class=\"product-block\">
            <div class=\"product-img fade-box\">
              <a href=\"detailproduct.php?id={$row['id']}\" title=\"{$row['name']}\" class=\"img-resize\">
                <img
                  src=\"{$row['imgsrc1']}\"
                  alt=\"{$row['name']}\" class=\"lazyloaded\">
                <img
                  src=\"{$row['imgsrc2']}\"
                  alt=\"{$row['name']}\" class=\"lazyloaded\">
              </a>
              
            </div>
            <div class=\"product-detail clearfix\">
              <div class=\"pro-text\">
                <a style=\" color: black;
                                                        font-size: 14px;text-decoration: none;\" href=\"#\"
                  title=\"{$row['name']}\" inspiration pack>
                  {$row['name']}
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
    <section class="section wrapper-home-banner">
      <div class="container-fluid" style="padding-bottom: 50px;">
        <div class="row">
          <div class="col-xs-12 col-sm-4 home-banner-pd">
            <div class="block-banner-category">
              <a href="#" class="link-banner wrap-flex-align flex-column">
                <div class="fg-image fade-box">
                  <img class="lazyloaded" src="images/shoes/block_home_category1_grande.jpg" alt="Shoes">
                </div>
                <figcaption class="caption_banner site-animation">
                  <p>Bộ sưu tập</p>
                  <h2>
                    Đại sứ thương hiệu
                  </h2>
                </figcaption>
              </a>
            </div>
          </div>
          <div class="col-xs-12 col-sm-4 home-banner-pd">
            <div class="block-banner-category">
              <a href="#" class="link-banner wrap-flex-align flex-column">
                <div class="fg-image fade-box">
                  <img class="lazyloaded" src="images/shoes/block_home_category2_grande.jpg" alt="Shoes">
                </div>
                <figcaption class="caption_banner site-animation">
                  <p>Bộ sưu tập</p>
                  <h2>
                    Thương hiệu
                  </h2>
                </figcaption>
              </a>
            </div>
          </div>
          <div class="col-xs-12 col-sm-4 home-banner-pd">
            <div class="block-banner-category">
              <a href="#" class="link-banner wrap-flex-align flex-column">
                <div class="fg-image">
                  <img class="lazyloaded" src="images/shoes/block_home_category3_grande.jpg" alt="Shoes">
                </div>
                <figcaption class="caption_banner site-animation">
                  <p></p>
                  <h2>
                    Blog
                  </h2>
                </figcaption>
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section>
      <div class="content">
        <div class="container">
          <div class="hot_sp">
            <h2 style="text-align:center;">
              <a style="font-size: 28px;color: black;text-decoration: none" href="">Sản phẩm mới</a>
            </h2>
            <div class="view-all" style="text-align:center;">
              <a style="color: black;text-decoration: none" href="">Xem thêm</a>
            </div>
          </div>
        </div>
        <!--Product-->
      </div>
      <div class="container product" style="width: 100%;margin: auto;">
        <div class="owl-carousel owl-theme owl-product-setting">
          <?php 
          $result = Product::query('SELECT * FROM products LIMIT 6');
          while ($row = mysqli_fetch_assoc($result)) {
            $price = Product::format_price($row['price']);
            echo "
            <div class=\"item\">
              <div class=\"\">
                <div class=\"product-block\">
                  <div class=\"product-img fade-box\">
                    <a href=\"detailproduct.php?id={$row['id']}\" title=\"{$row['name']}\" class=\"img-resize\">
                      <img
                        src=\"{$row['imgsrc1']}\"
                        alt=\"{$row['name']}\" class=\"lazyloaded\">
                      <img
                        src=\"{$row['imgsrc2']}\"
                        alt=\"{$row['name']}\" class=\"lazyloaded\">
                    </a>
                    
                  </div>
                  <div class=\"product-detail clearfix\">
                    <div class=\"pro-text\">
                      <a style=\" color: black;
                                                              font-size: 14px;text-decoration: none;\" href=\"#\"
                        title=\"{$row['name']}\" inspiration pack>
                        {$row['name']}
                      </a>
                    </div>
                    <div class=\"pro-price\">
                      <p>{$price}₫</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          ";
          }
          ?>
      </div>
      </div>
    </section>
    
    <section class="section wrapper-home-newsletter">
      <div class="container-fluid">
        <div class="content-newsletter">
          <h2>Đăng ký</h2>
          <p>Đăng ký nhận bản tin của Runner Inn để cập nhật những sản phẩm mới, nhận thông tin ưu đãi đặc biệt và thông
            tin
            giảm giá khác.</p>
          <div class="form-newsletter">
            <form action="" accept-charset="UTF-8" class="">
              <div class="form-group">
                <input type="hidden" id="contact_tags">
                <input required="" type="email" value="" placeholder="Nhập email của bạn" aria-label="Email Address"
                  class="">
                <button type="submit" class=""><span>Gửi</span></button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
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
    <footer class="main-footer">
      
    </footer>
  </div>
  <div class="registratior_custom">
    <form action="">
        <div class="content">
          <div class="x-close">
            <i class="fa fa-times"></i>
          </div>
          <h3>Nhận các ưu đãi cùng Runner</h3>
          <p>Chúng tôi sẽ cập nhật các chương trình khuyến mãi mới đến bạn</p>
          <ul>
            <li>
              <span>Giảm giá sản phẩm</span>
            </li>
            <li>
              <span>Sản phẩm mới</span>
            </li>
            <li>
              <span>Sản phẩm bán chạy</span>
            </li>
          </ul>
          <input type="text" placeholder="Đăng kí nhận thông tin">
          <button class="button_register"><p>ĐĂNG KÍ</p></button>
        </div>
    </form>
  </div>
  <script async defer crossorigin="anonymous" src="plugins/sdk.js"></script>
  <script src="plugins/jquery-3.4.1/jquery-3.4.1.min.js"></script>
  
  <script src="plugins/bootstrap/popper.min.js"></script>
  <script src="plugins/bootstrap/bootstrap.min.js"></script>
  <script src="plugins/owl.carousel/owl.carousel.min.js"></script>
  <script src="js/home.js"></script>
  <script src="js/script.js"></script>
  <script src="plugins/uikit/uikit.min.js"></script>
  <script src="plugins/uikit/uikit-icons.min.js"></script>
</body>

</html>
