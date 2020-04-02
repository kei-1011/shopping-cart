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
}


//参照画面
if (isset($_POST['disp']) == true) {
  if (isset($_POST['procode']) == false) {  //　修正ボタンが押され、procodeが選択されてなかった時
    header('Location:pro_ng.php');
  }
}
if ((isset($_POST['disp']) == true) && (isset($_POST['procode']) == true)) {
  $pro_code = $_POST['procode'];
  header('Location:pro_disp.php?procode=' . $pro_code);
}


//追加画面
if (isset($_POST['add']) == true) {
  $pro_code = $_POST['procode'];
  header('Location:pro_add.php?procode=' . $pro_code);
}

//修正画面
if (isset($_POST['edit']) == true) {  //修正ボタンが押された時
  if (isset($_POST['procode']) == false) {  //　修正ボタンが押され、procodeが選択されてなかった時
    header('Location:pro_ng.php');
  }
}
if ((isset($_POST['edit']) == true) && (isset($_POST['procode']) == true)) {  //　スタッフが選択され、修正ボタンが押された時
  $pro_code = $_POST['procode'];
  header('Location:pro_edit.php?procode=' . $pro_code);
}

//削除画面
if (isset($_POST['delete']) == true) {

  if (isset($_POST['procode']) == false) {
    header('Location:pro_ng.php');
  }
}
if ((isset($_POST['delete']) == true) && (isset($_POST['procode']) == true)) {
  $pro_code = $_POST['procode'];
  header('Location:pro_delete.php?procode=' . $pro_code);
}
