<?php
if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = Cart::init();
}

class Cart {
  public function add(string $id, int $quantity = 1) {
    $result = Product::select("id='$id'");
    $num = mysqli_num_rows($result);
    if (!$num) {
      return false;
    }
    $is_exist = isset($_SESSION['cart'][$id]);
    if (!$is_exist) {
      $_SESSION['cart'][$id] = $quantity;
    } else {
      // $_SESSION['cart'][$id] += 1;
    }
    return $_SESSION['cart'];
  }
  public function total() {
    $total = 0;
    $this->foreach_product(function ($is_error, $product, $quantity) use(&$total) {
      if ($is_error) {
        return;
      }
      $total += $product['price'] * $quantity;
    });
    return $total;
  }
  public function foreach_product(callable $fn) {
    if (!isset($_SESSION['cart'])) {
      $fn(true, null, null);
    }
    foreach($_SESSION['cart'] as $id => $quantity) {
      $result = Product::select("id='$id'");
      $product = mysqli_fetch_array($result);
      $fn(false, $product, $quantity, $this);
    }
  }
  public function remove(string $id) {
      unset($_SESSION['cart'][$id]);
  }
  public function display_cart() {
    echo '<script>
    window.addEventListener(\'load\', () => {document.querySelector(\'a[uk-toggle="target: #offcanvas-flip2"]\').click()})
    </script>';
  }
  public static function init() {
    return [];
  }

  public function to_content_mail() {
    $totalprice = 0;
    $table = "<tr>
      <th>Sản phẩm</th>
      <th>Giá</th>
    </tr>";
    $this->foreach_product(function ($is_error, $product, $quantity) use (&$table, &$totalprice) {
    if (!$is_error) {
      $price = $product['price'] * $quantity;
      $formatedprice = Product::format_price($price);
      $totalprice += $price;
      $table .= "
              <tr>
                <td>{$product['name']} x $quantity</td>
                <td style='text-align:right;'>{$formatedprice}₫</td>
              </tr>
            ";
    }
  });

  $formatedtotalprice = Product::format_price($totalprice);

    $content = "

    <div style='padding: 5px;'>
      <div style='padding: 5px;'>
        <img src='images/logo.png' style='height: 50px;' alt='Logo'>
        <h2 style='text-align: center'>Xác nhận thanh toán</h2>
      </div>
      <div>
        <table style='margin: auto;border-collapse: collapse;' border='1' cellpadding='4' cellspacing='0'>
          $table
          <tr>
          <td colspan='2' style='text-align: center'>Tổng: {$formatedtotalprice}₫</td>
          </tr>
        </table>
      </div>

      <div style='text-align: center; margin-top: 16px'>
        <a href='#' type='button' style='text-decoration: none;display: inline-block; padding: 8px 15px; border-radius: 4px; border: none; cursor: pointer; color: #fff; background-color: #0d6efd;'>Xác nhận</a>
      </div>
    </div>
    ";
    return $content;
  }
}