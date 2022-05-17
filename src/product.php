<?php

class Product {
  public static function query(string $sql) {
    global $conn;
    $result = mysqli_query($conn, $sql);
    return $result;
  }
  public static function is_exist(string $id) {
    $result = self::select("id='$id'");
    if ($result && !mysqli_num_rows($result)) {
      return false;
    }
    return true;
  }
  public static function select(string $query = '') {
    $sql = "SELECT * FROM products";
    if (!empty($query)) {
      $sql .= " WHERE $query";
    }
    $result = self::query($sql);
    return $result;
  }
  public static function format_price(int $price) {
    $array_number = str_split((string) $price);
    $result = [];
    $len = count($array_number);
    foreach (array_reverse($array_number) as $index => $value) {
      array_unshift($result, $value);
      if (($index + 1) % 3 == 0 && $index != $len - 1) {
        array_unshift($result, ',');
      }
    }
    return join("", $result);
  }
}