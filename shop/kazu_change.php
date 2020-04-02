<?php
/*
このファイルは数量の変更だけ（ロジック部分）

商品の数量の変更

セッションを開始
共通関数を読み込み
$_POSTをエスケープ処理して$postに代入
商品の種類の数を$postから$maxに代入
商品の数だけforループ

ループの数だけ入力された数量を配列に入れる

セッションに$kazuを代入
shop_cartlookに戻る

*/


session_start();
session_regenerate_id(true);

require_once('../common/common.php');

$post = e($_POST);

$max = $post['max'];
for ($i = 0; $i < $max; $i++) {

  /*
  もし半角数字でなければ、数量に誤りがあると表示
  */
  if (preg_match("/^[0-9]+$/", $post['kazu' . $i]) == 0) {
    print '数量に誤りがあります';
    print '<a href="shop_cartlook.php">カートに入れる</a>';
    exit();
  }
  if ($post['kazu' . $i] < 1 || 10 < $post['kazu' . $i]) {
    print '数量は必ず１個以上10個までです。';
    print '<a href="shop_cartlook.php">カートに戻る</a>';
    exit();
  }
  $kazu[] = $post['kazu' . $i];
}

$cart = $_SESSION['cart'];

for ($i = $max; 0 <= $i; $i--) {
  if (isset($_POST['sakujo' . $i]) == true) {
    array_splice($cart, $i, 1);
    array_splice($kazu, $i, 1);
  }
}

$_SESSION['cart'] = $cart;
$_SESSION['kazu'] = $kazu;

header('Location:shop_cartlook.php');