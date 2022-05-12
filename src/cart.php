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
}