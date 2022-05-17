<?php
class Data
{
  public function register($ho, $ten, $gioitinh, $ngaysinh, $email, $pass)
  {
    global $conn;
    $result = $this->select_user($email);
    if (mysqli_num_rows($result) != 0) {
      return false;
    }
    $sql = "INSERT INTO users(ho,ten,gioitinh,ngaysinh,email,pass) VALUES ('$ho', '$ten', '$gioitinh', '$ngaysinh','$email', '$pass')";
    $result = mysqli_query($conn, $sql);
    return $result;
  }
  private function select_user($email)
  {
    global $conn;
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    return $result;
  }
  public function login($email, $password) {
    $result = $this->select_user($email);
    $num = mysqli_num_rows($result);
    if ($num != 0) {
      $user = mysqli_fetch_assoc($result);
      if ($user['pass'] == $password) {
        return 0;
      } else {
        return 11; // Sai pass
      }
    }
    else {
      return 12; //Sai Tai khoan
    }
  }
  public function getStatusMessage($statusCode) {
    switch ($statusCode) {
      case 0: 
        return 'Thanh cong';
      case 11: 
        return 'Mật khẩu không chính xác';
      case 12:
        return 'Tài khoản không tồn tại';
      default:
        return '';
    }
  }
}
