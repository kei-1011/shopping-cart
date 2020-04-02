<?php
session_start();

/*
セッションハイジャック対策
固定のセッションIDではなく、毎回セッションIDを変更する
*/
session_regenerate_id(true);

if (isset($_SESSION['login']) == false) {
  print 'ログインされていません<br>';
  print '<a href="../staff_login/staff_login.php">ログイン画面へ</a>';
  exit();
} else {
  $login_name = $_SESSION['staff_name'] . 'さんログイン中';
}
