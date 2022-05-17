<?php 
session_start();
include './src/connect.php';
include './src/control.php';
include './src/product.php';
include './src/cart.php';
if (isset($_POST['signup'])) {
  $data = new Data();
  $result = $data->register(
    $_POST['firstname'],
    $_POST['lastname'],
    $_POST['sex'],
    $_POST['birthday'],
    $_POST['email'],
    $_POST['password']
  );
  if ($result) {
    header('Location: signin.php', true, 303);
  } else {
    echo '<script>alert("Đăng kí thất bại! Email đã được sử dụng!")</script>';
  }
}
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

  <!-- UIkit CSS -->
  <link rel="stylesheet" href="plugins/uikit/uikit.min.css" />
  <link rel="stylesheet" href="css/sign.css">

  <title>Runner</title>

</head>

<body>

  <!--Navbar-->

  <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">

    <div class="container">
      <a class="navbar-brand" href="index.php">
        <img src="images/logo.png" class="logo-top" alt="">
      </a>
      <div class="desk-menu collapse navbar-collapse justify-content-md-center" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item ">
            <a class="nav-link" href="index.php">TRANG CHỦ</a>
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
                    <a class="dropdown-item" href="detailproduct.php" title="Sản phẩm - Style 1">Sản phẩm - Style 1</a>
                    <a class="dropdown-item" href="detailproduct.php" title="Sản phẩm - Style 2">Sản phẩm - Style 2</a>
                    <a class="dropdown-item" href="detailproduct.php" title="Sản phẩm - Style 3">Sản phẩm - Style 3</a>
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
                  $cart = new Cart();
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
        <a style="color: #272727" href="">
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

 
  <!--Content-->
  <div class="content">
    <section class="signup">
        <div class="container">
            <div class="signin-left">
                <div class="sign-title">
                    <h1>Tạo tài khoản</h1>
                </div>
            </div>
            <div class="signin-right ">
                <form method="POST">
                    <div class="firstname form-control1 ">
                        <input required type="text" name="firstname" placeholder="Họ">
                    </div>
                    <div class="lastname form-control1">
                        <input required type="text" name="lastname" placeholder="Tên">
                    </div>
                    <div class="sex form-control1">
                       <div class="female">
                          <input type="radio" id="female" checked value="female"  name="sex">
                          <label for="female">Nữ</label>
                       </div>
                       <div class="male">
                        
                        <input type="radio" id="male" value="male" name="sex">
                        <label for="male" >Nam</label>
                     </div>
                    </div>
                    <div class="birthday form-control1">
                        <input required type="text" name="birthday" placeholder="mm/dd/yyyy">
                    </div>
                    <div class="email form-control1">
                        <input required type="email"  name="email" placeholder="Email">
                    </div>
                    <div class="password form-control1">
                        <input required type="password"  name="password" placeholder="Password">
                    </div>
                    <div class="recaptcha form-control1">This site is protected by reCAPTCHA and the Google <a href="">Privacy Policy</a> and <a href="">Terms of Service</a> apply.</div>
                      <input class="btn btn-dark" type="submit" name="signup" value="Đăng kí">
                    <div class="backto">
                      <a href="index.php"><i class="fa fa-long-arrow-alt-left"></i> Quay lại trang chủ</a>
                    </div>
                </form>
                
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
      <!-- <div class="container">
        <div class="">
          <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-3">
              <div class="footer-col footer-block">
                <h4 class="footer-title">
                  Giới thiệu
                </h4>
                <div class="footer-content">
                  <p>Runner Inn trang mua sắm trực tuyến của thương hiệu giày, thời trang nam, nữ, phụ kiện, giúp bạn
                    tiếp
                    cận xu hướng thời trang mới nhất.</p>
                  <div class="logo-footer">
                    <img src="images/logo-bct.png" alt="Bộ Công Thương">
                  </div>
                  <div class="social-list">
                    <a href="#" class="fab fa-facebook"></a>
                    <a href="#" class="fab fa-google"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-youtube"></a>
                    <a href="#" class="fab fa-skype"></a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3">
              <div class="footer-col footer-link">
                <h4 class="footer-title">
                  PHÁP LÝ &amp; CÂU HỎI
                </h4>
                <div class="footer-content toggle-footer">
                  <ul>
                    <li class="item">
                      <a href="#" title="Tìm kiếm">Tìm kiếm</a>
                    </li>
                    <li class="item">
                      <a href="#" title="Giới thiệu">Giới thiệu</a>
                    </li>
                    <li class="item">
                      <a href="#" title="Chính sách đổi trả">Chính sách đổi trả</a>
                    </li>
                    <li class="item">
                      <a href="#" title="Chính sách bảo mật">Chính sách bảo mật</a>
                    </li>
                    <li class="item">
                      <a href="#" title="Điều khoản dịch vụ">Điều khoản dịch vụ</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3">
              <div class="footer-col footer-block">
                <h4 class="footer-title">
                  Thông tin liên hệ
                </h4>
                <div class="footer-content toggle-footer">
                  <ul>
                    <li><span>Địa chỉ:</span> 117-119 Lý Chính Thắng, Phường 7, Quận 3, TP. Hồ Chí Minh, Vietnam</li>
                    <li><span>Điện thoại:</span> +84 (028) 38800659</li>
                    <li><span>Fax:</span> +84 (028) 38800659</li>
                    <li><span>Mail:</span> contact@aziworld.com</li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3">
              <div class="footer-col footer-block">
                <h4 class="footer-title">
                  FANPAGE
                </h4>
                <div class="footer-content">
                  <div id="fb-root">
                    <div class="footer-static-content">
                      <div class="fb-page" data-href="https://www.facebook.com/AziWorld-Viet-Nam-908555669481794/"
                        data-tabs="timeline" data-width="" data-height="215" data-small-header="false"
                        data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                        <blockquote cite="https://www.facebook.com/AziWorld-Viet-Nam-908555669481794/"
                          class="fb-xfbml-parse-ignore"><a
                            href="https://www.facebook.com/AziWorld-Viet-Nam-908555669481794/">AziWorld Viet Nam</a>
                        </blockquote>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="main-footer--copyright">
        <div class="container">
          <hr>
          <div class="main-footer--border" style="text-align:center;padding-bottom: 15px;">
            <p>Copyright © 2019 <a href="https://runner-inn.myharavan.com"> Runner Inn</a>. <a target="_blank"
                href="https://www.facebook.com/henrynguyen202">Powered by HuniBlue</a></p>
          </div>
        </div>
      </div> -->
    </footer>
  </div>
 
  <script async defer crossorigin="anonymous" src="plugins/sdk.js"></script>
  <script src="plugins/jquery-3.4.1/jquery-3.4.1.min.js"></script>
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
  <script src="plugins/bootstrap/popper.min.js"></script>
  <script src="plugins/bootstrap/bootstrap.min.js"></script>
  <script src="plugins/owl.carousel/owl.carousel.min.js"></script>
  <script src="js/home.js"></script>
  <script src="js/script.js"></script>
  <script src="plugins/uikit/uikit.min.js"></script>
  <script src="plugins/uikit/uikit-icons.min.js"></script>
</body>

</html>
